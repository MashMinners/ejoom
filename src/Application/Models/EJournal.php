<?php

declare(strict_types=1);

namespace Application\Models;

use Engine\Database\IConnector;

class EJournal
{
    private \PDO $pdo;
    const LIMIT = 10;

    public function __construct(IConnector $connector){
        $this->pdo = $connector::connect();
    }

    private function getRecordsByFastSearch(Search $search) : ResultCollection {
        $query = ("SELECT * FROM ejournal
                   INNER JOIN counterparties ON counterparties.counterparty_id = ejournal.counterparty_id
                   INNER JOIN counterparty_types ON counterparty_types.counterparty_type_id = ejournal.counterparty_type_id
                   INNER JOIN employees ON employees.employee_id = ejournal.employee_id
                   INNER JOIN employee_types ON employee_types.employee_type_id = ejournal.employee_type_id
                   INNER JOIN correspondence_types ON correspondence_types.correspondence_type_id = ejournal.correspondence_type_id
                   WHERE letter_number LIKE '%$search->searchString%' OR letter_header LIKE '%$search->searchString%' LIMIT ").$this::LIMIT;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $collection = new ResultCollection();
        foreach ($results as $result){
            $collection->add(new SearchResult($result));
        }
        return $collection;
    }

    /**
     * Возвращает результат за период между началом и концом, либо на дату указанную в $startDate
     * Будет исопльзоваться для кнопок "Сегодня", "Вчера", "Неделя" для быстрого поиска писем по этим периодам
     * @param Search $search
     * @return ResultCollection
     */
    private function getRecordsByDate(Search $search) : ResultCollection {
        $query = ("SELECT * FROM ejournal
                   INNER JOIN counterparties ON counterparties.counterparty_id = ejournal.counterparty_id
                   INNER JOIN counterparty_types ON counterparty_types.counterparty_type_id = ejournal.counterparty_type_id
                   INNER JOIN employees ON employees.employee_id = ejournal.employee_id
                   INNER JOIN employee_types ON employee_types.employee_type_id = ejournal.employee_type_id
                   INNER JOIN correspondence_types ON correspondence_types.correspondence_type_id = ejournal.correspondence_type_id
                   WHERE registration_date BETWEEN :startDate AND :endDate");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'startDate' => $search->startDate,
            'endDate' => $search->endDate
        ]);
        $results = $stmt->fetchAll();
        $collection = new ResultCollection();
        foreach ($results as $result){
            $collection->add(new SearchResult($result));
        }
        return $collection;
    }

    private function getRecordsByParams(Search $search) : ResultCollection {
        //Более серьезный поиск по большему количеству параметров, например за перод для исполнителя
        //Либо просто для поиск аза больший кастомный период
    }

    public function get(Search $search) : ResultCollection {
        switch ($search->searchType) {
            case SearchType::Fast : return $this->getRecordsByFastSearch($search);
            case SearchType::ByDate : return $this->getRecordsByDate($search);
            case SearchType::ByParams : return $this->getRecordsByParams($search);
        }
    }

    public function insert(Record $record) : string {
        $query = ("INSERT INTO ejournal (id, letter_number, letter_header, counterparty
                                employee, registration_date, correspondence_type, additionally, counterparty_type, 
                                employee_type)
                   VALUES (:id, :letterNumber, :letterHeader, :counterparty, :employee, :registrationDate, 
                            :correspondenceType, :additionally, :counterpartyType, :employeeType)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'id'=>$record->id,
            'letterNumber'=>$record->letterNumber,
            'letterHeader'=>$record->letterHEader,
            'counterparty'=>$record->counterparty,
            'employee'=>$record->employee,
            'registrationDate'=>$record->registrationDate,
            'correspondenceType'=>$record->correspondenceType,
            'additionally'=>$record->additionally,
            'counterpartyType'=>$record->counterpartyType,
            'employeeType'=>$record->employeeType
        ]);
        return $record->id;
    }

    public function update(Record $record) : string {
        return $record->id;
    }

    public function delete(array $ids) {

    }

}