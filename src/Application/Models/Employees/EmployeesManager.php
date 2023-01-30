<?php

declare(strict_types=1);

namespace Application\Models\Employees;

use Engine\Database\IConnector;
use Ramsey\Uuid\Uuid;

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

    public function insert(Employee $employee) : string {
        $query = ("INSERT INTO employees (employee_id, employee_surname, employee_first_name, employee_second_name,
                               employee_phone_number, employee_email)
                   VALUES (:employeeId, :employeeSurname, :employeeFirstName, :employeeSecondName, :employeePhoneNumber,
                            :employeeEmail)");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'employeeId'=>$employeeId = Uuid::uuid4()->toString(),
            'employeeSurname'=>$employee->employeeSurname,
            'employeeFirstName'=>$employee->employeeFirstName,
            'employeeSecondName'=>$employee->employeeSecondName,
            'employeePhoneNumber'=>$employee->employeePhoneNumber,
            'employeeEmail'=>$employee->employeeEmail
        ]);
        return $employeeId;
    }

    public function update(Employee $employee) : string {
        $query = ("UPDATE employees 
                   SET employee_surname= :employeeSurname,
                       employee_first_name= :employeeFirstName,
                       employee_second_name= :employeeSecondName,
                       employee_phone_number= :employeePhoneNumber,
                        employee_email = :employeeEmail
                   WHERE employee_id = :employeeId
                  ");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'employeeId'=>$employee->employeeId,
            'employeeSurname'=>$employee->employeeSurname,
            'employeeFirstName'=>$employee->employeeFirstName,
            'employeeSecondName'=>$employee->employeeSecondName,
            'employeePhoneNumber'=>$employee->employeePhoneNumber,
            'employeeEmail'=>$employee->employeeEmail
        ]);
        return $employee->employeeId;
    }

    public function delete(string $json) : bool {
        $std = json_decode($json);
        $query = ("DELETE FROM employees WHERE employee_id = :employeeId");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['employeeId'=>$std->employeeId]);
        return true;
    }

}