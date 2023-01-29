<?php

declare(strict_types=1);

namespace Application\Models\Employees;

use Engine\Database\IConnector;

class EmployeesManager
{
    private \PDO $pdo;

    public function __construct(IConnector $connector){
        $this->pdo = $connector::connect();
    }

    public function get(string $json) : EmployeesCollection{
        $std = json_decode($json);
        $search = $std->search;
        $query = ("SELECT * FROM employees 
                   WHERE CONCAT(employee_surname, ' ', employee_first_name) LIKE '%$search%'");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $collection = new EmployeesCollection();
        foreach ($results as $result){
            $collection->add(new Employee($result));
        }
        return $collection;
    }

    public function insert(Employee $employee){

    }

    public function update(Employee $employee){

    }

    public function delete(string $json) : bool {

    }

}