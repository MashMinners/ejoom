<?php

declare(strict_types=1);

namespace Application\Models;

class Search extends BaseDTO
{
    protected SearchType $searchType;
    //Быстрый поиск по номеру или заголовку записи
    protected string|null $searchString;
    //Усиленный поиск по параметрам
    protected string|null $startDate;
    protected string|null $endDate;
    private string|null $employeeId; //Будет браться из фронта. Во фронт из MySQL и ID и Name. Так что лучше выбрать?
    private string|null $employeeTypeId; //1. отправитель 2. исполнитель
    private string|null $counterpartyId;
    private string|null $counterpartyTypeId; //1. отправитель письма 2. получатель письма
    private string|null $correspondenceTypeId;

    public function __construct(string $json){
        $this->make($json);
    }

    private function make(string $json) : void {
        $data = json_decode($json);
        $searchType = SearchType::from($data->searchType);
        $data = (array) $data;
        unset($data['searchType']);
        $this->init($data);
        $this->searchType = $searchType;
    }

    /*private function init(string $json){
        //Значит так. Убираем через unset трудные поля
        //Далее прогоняем через init наследуемый все свойства
        //Потом напрямую устанавливаем сложные поля например так: $this->searchType = SearchType::from($DTO->searchType);
        $DTO = json_decode($json);
        $this->searchType = SearchType::from($DTO->searchType);
        $this->searchString = $DTO->searchString ?? null;
        $this->startDate = $DTO->startDate ?? null;
        $this->endDate = $DTO->endDate ?? null;
        $this->employeeId = $DTO->employeeId ?? null;
        $this->employeeTypeId = $DTO->employeeTypeId ?? null;
        $this->counterpartyId = $DTO->counterpartyId ?? null;
        $this->counterpartyTypeId = $DTO->counterpartyTypeId ?? null;
        $this->correspondenceTypeId = $DTO->correspondenceTypeId ?? null;
    }*/

    public function __get(string $name) : string|SearchType|null {
        return $this->$name;
    }

}