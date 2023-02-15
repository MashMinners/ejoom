<?php

declare(strict_types=1);

namespace Application\Models\Counterparties;

use Engine\Database\IConnector;
use Ramsey\Uuid\Uuid;

class CounterpartiesManager
{
    public function __construct(IConnector $connector){
        $this->pdo = $connector::connect();
    }

    public function get(string $search) : CounterpartiesCollection{
        $query = ("SELECT * FROM counterparties 
                   WHERE counterparties.counterparty_name LIKE '%$search%'");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $collection = new CounterpartiesCollection();
        foreach ($results as $result){
            $collection->add(new Counterparty($result));
        }
        return $collection;
    }

    public function insert(Counterparty $counterparty) : string{
        $query = ("INSERT INTO counterparties (counterparty_id, counterparty_name, counterparty_description)
                   VALUES (:counterpartyId, :counterpartyName, :counterpartyDescription)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'counterpartyId'=>$counterpartyId = Uuid::uuid4()->toString(),
            'counterpartyName'=>$counterparty->counterpartyName,
            'counterpartyDescription'=>$counterparty->counterpartyDescription
        ]);
        return $counterpartyId;
    }

    public function update(Counterparty $counterparty) : string{
        $query = ("UPDATE counterparties 
                   SET counterparty_name = :counterpartyName,
                       counterparty_description = :counterpartyDescription
                   WHERE counterparty_id = :counterpartyId
                  ");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'counterpartyId'=>$counterparty->counterpartyId,
            'counterpartyName'=>$counterparty->counterpartyName,
            'counterpartyDescription'=>$counterparty->counterpartyDescription,
        ]);
        return $counterparty->counterpartyId;
    }

    public function delete(string $json) : bool{
        $std = json_decode($json);
        $query = ("DELETE FROM counterparties WHERE counterparty_id = :counterpartyId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['counterpartyId'=>$std->counterpartyId]);
        return true;
    }

}