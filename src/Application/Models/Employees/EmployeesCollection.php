<?php

declare(strict_types=1);

namespace Application\Models\Employees;

class EmployeesCollection implements \JsonSerializable
{
    private array $employees;

    public function add(Employee $employee){
        $this->employees[] = $employee;
    }

    public function remove(){

    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}