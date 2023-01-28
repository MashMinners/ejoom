<?php

declare(strict_types=1);

namespace Application\Models;

class SearchResult implements \JsonSerializable
{
    //Записи в журнале
    private string $record_id;
    private int $letterNumber;
    private string $letterHeader;
    private string $registrationDate;
    private string $additionally;

    //Контрагенты
    private int $counterpartyId;
    private string $counterpartyName;
    private int $counterpartyTypeId;
    private string $counterpartyTypeName;

    //Сотрудники организации
    private int $employeeId;
    private string $employeeName;
    private string $employeePhoneNumber;
    private string $employeeEmail;
    private int $employeeTypeId;
    private string $employeeTypeName;

    //Тип записи: 1. email - входящее 2. email - исходящее 3. письмо - входящее 4. письмо исходящее
    private int $correspondenceTypeId;
    private string $correspondenceTypeName;

    public function __construct(array $array){

    }

    private function fill(array $data) : void {

    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }




}