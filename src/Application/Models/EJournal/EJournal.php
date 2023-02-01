<?php

declare(strict_types=1);

namespace Application\Models\EJournal;

use Engine\Database\IConnector;
use Ramsey\Uuid\Uuid;

class EJournal
{
    private \PDO $pdo;
    const LIMIT = 10;

    /**
     * @param IConnector $connector
     */
    public function __construct(IConnector $connector){
        $this->pdo = $connector::connect();
    }

    /**
     * @param Search $search
     * @return ResultCollection
     */
    private function getRecordsByFastSearch(Search $search) : ResultCollection {
        $query = ("SELECT * FROM ejournal
                   INNER JOIN counterparties ON counterparties.counterparty_id = ejournal.counterparty_id
                   INNER JOIN employees ON employees.employee_id = ejournal.employee_id
                   INNER JOIN correspondence_types ON correspondence_types.correspondence_type_id = ejournal.correspondence_type_id
                   WHERE (letter_number LIKE '%$search->searchString%' OR letter_header LIKE '%$search->searchString%') 
                   AND (ejournal.correspondence_type_id = :correspondenceTypeId) LIMIT ").$this::LIMIT;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'correspondenceTypeId' => $search->correspondenceTypeId,
        ]);
        $results = $stmt->fetchAll();
        $collection = new ResultCollection();
        foreach ($results as $result){
            $collection->add(new SearchResult($result));
        }
        return $collection;
    }

    /**
     * Будет использоваться для кнопок "Сегодня", "Вчера", "Неделя" для быстрого поиска писем по этим периодам
     * @param Search $search
     * @return ResultCollection
     */
    private function getRecordsByDate(Search $search) : ResultCollection {
        $query = ("SELECT * FROM ejournal
                   INNER JOIN counterparties ON counterparties.counterparty_id = ejournal.counterparty_id
                   INNER JOIN employees ON employees.employee_id = ejournal.employee_id
                   INNER JOIN correspondence_types ON correspondence_types.correspondence_type_id = ejournal.correspondence_type_id
                   WHERE (registration_date BETWEEN :startDate AND :endDate) AND (ejournal.correspondence_type_id = :correspondenceTypeId)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'startDate' => $search->startDate,
            'endDate' => $search->endDate ?? $search->startDate,
            'correspondenceTypeId' => $search->correspondenceTypeId
        ]);
        $results = $stmt->fetchAll();
        $collection = new ResultCollection();
        foreach ($results as $result){
            $collection->add(new SearchResult($result));
        }
        return $collection;
    }

    private function getRecordsByParams(Search $search) : ResultCollection {
        //Первоначальный
        $query = ("SELECT * FROM ejournal
                   INNER JOIN counterparties ON counterparties.counterparty_id = ejournal.counterparty_id
                   INNER JOIN employees ON employees.employee_id = ejournal.employee_id
                   INNER JOIN correspondence_types ON correspondence_types.correspondence_type_id = ejournal.correspondence_type_id
                   WHERE (letter_number LIKE '%$search->searchString%' OR letter_header LIKE '%$search->searchString%')
                   AND (ejournal.correspondence_type_id = :correspondenceTypeId) ");
        $queryBuilder = new \Engine\Database\QueryBuilder\QueryBuilder($query);
        $queryBuilder->addKey('correspondenceTypeId', $search->correspondenceTypeId);
        if (!is_null($search->startDate)){
            $queryBuilder->add('AND (registration_date BETWEEN :startDate AND :endDate) ');
            $queryBuilder->addKey('startDate', $search->startDate);
            $queryBuilder->addKey('endDate', $search->endDate ?? $search->startDate);
        }
        if (!is_null($search->employeeId)){
            $queryBuilder->add('AND (ejournal.employee_id = :employeeId) ');
            $queryBuilder->addKey('employeeId', $search->employeeId);
        }
        if (!is_null($search->counterpartyId)){
            $queryBuilder->add('AND (ejournal.counterparty_id = :counterpartyId) ');
            $queryBuilder->addKey('counterpartyId', $search->counterpartyId);
        }
        $queryBuilder->limit($this::LIMIT);
        $query = $queryBuilder->query();
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($queryBuilder->keys());
        $results = $stmt->fetchAll();
        $collection = new ResultCollection();
        foreach ($results as $result){
            $collection->add(new SearchResult($result));
        }
        return $collection;
    }

    public function get(Search $search) : ResultCollection {
        switch ($search->searchType) {
            case SearchType::Fast : return $this->getRecordsByFastSearch($search);
            case SearchType::ByDate : return $this->getRecordsByDate($search);
            case SearchType::ByParams : return $this->getRecordsByParams($search);
        }
    }

    public function insert(Record $record) : string {
        $query = ("INSERT INTO ejournal (record_id, letter_number, letter_header, counterparty_id,
                               employee_id, registration_date, correspondence_type_id, additionally)
                   VALUES (:recordId, :letterNumber, :letterHeader, :counterpartyId, :employeeId, :registrationDate, 
                            :correspondenceTypeId, :additionally)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'recordId'=>$recordId = Uuid::uuid4()->toString(),
            'letterNumber'=>$record->letterNumber,
            'letterHeader'=>$record->letterHeader,
            'counterpartyId'=>$record->counterpartyId,
            'employeeId'=>$record->employeeId,
            'registrationDate'=>$record->registrationDate,
            'correspondenceTypeId'=>$record->correspondenceTypeId,
            'additionally'=>$record->additionally,
        ]);
        return $recordId;
    }

    public function update(Record $record) : string {
        $query = ("UPDATE ejournal 
                   SET letter_number = :letterNumber,
                       letter_header = :letterHeader,
                       counterparty_id = :counterpartyId,
                       employee_id = :employeeId,
                       registration_date = :registrationDate,
                       correspondence_type_id = :correspondenceTypeId,
                       additionally = :additionally
                   WHERE record_id = :recordId
                  ");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'recordId'=>$record->recordId,
            'letterNumber'=>$record->letterNumber,
            'letterHeader'=>$record->letterHeader,
            'counterpartyId'=>$record->counterpartyId,
            'employeeId'=>$record->employeeId,
            'registrationDate'=>$record->registrationDate,
            'correspondenceTypeId'=>$record->correspondenceTypeId,
            'additionally'=>$record->additionally
        ]);
        return $record->recordId;
    }

    public function delete(array $data) : bool {
        //$std = json_decode($json);
        $query = ("DELETE FROM ejournal WHERE record_id = :recordId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['recordId'=>$data['recordId']]);
        return true;
    }

}