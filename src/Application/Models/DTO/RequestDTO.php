<?php

declare(strict_types=1);

namespace Application\Models\DTO;

class RequestDTO
{
    private string $startDate;
    private string$endDate;

    public function __get(string $name){
        return $this->$name;
    }

}