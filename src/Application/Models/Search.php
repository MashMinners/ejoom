<?php

declare(strict_types=1);

namespace Application\Models;

class Search
{
    private SearchType $searchType;
    //Быстрый поиск по номеру или заголовку записи
    private $searchString;
    //Усиленный поиск по параметрам
    private $startDate;
    private $endDate;
    private $employeeId; //Будет браться из фронта. Во фронт из MySQL и ID и Name. Так что лучше выбрать?
    private $counterpartyId;

    public function __construct(){

    }

    public function __get(string $name) : string|int {
        return $this->$name;
    }

}