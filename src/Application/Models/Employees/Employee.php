<?php

declare(strict_types=1);

namespace Application\Models\Employees;

use Application\Models\BaseDTO;

class Employee extends BaseDTO implements \JsonSerializable
{
    protected string $employeeId;
    protected string $employeeSurname;
    protected string $employeeFirstName;
    protected string $employeeSecondName;
    protected string $employeePhoneNumber;
    protected string $employeeEmail;

    public function __construct(array $data){
        $this->init($data);
    }

    public function __get(string $name) : string|int {
        return $this->$name;
    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }


}