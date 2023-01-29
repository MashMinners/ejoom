<?php

declare(strict_types=1);

namespace Application\Models\EJournal;

use Application\Models\BaseDTO;

class Search extends BaseDTO
{
    //Переключатели параметра поиска
    protected SearchType|null $searchType;
    protected int|null $correspondenceTypeId;
    //Быстрый поиск по номеру или заголовку записи
    protected string|null $searchString;
    //Усиленный поиск по параметрам
    protected string|null $startDate;
    protected string|null $endDate;
    protected string|null $employeeId;
    protected string|null $counterpartyId;

    public function __construct(string $json){
        $this->make($json);
    }

    private function make(string $json) : void {
        //Установка всех значений в null
        $properties = get_class_vars(self::class);
        foreach ($properties as $name => $value){
            $this->$name = $value;
        }
        //Заполнение свойств
        $data = json_decode($json);
        $searchType = SearchType::from($data->searchType);
        $array = (array) $data;
        unset($array['searchType']);
        $this->init($array);
        $this->searchType = $searchType;
    }

    public function __get(string $name) : string|SearchType|null|int {
        return $this->$name;
    }

}