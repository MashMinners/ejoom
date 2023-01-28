<?php

declare(strict_types=1);

namespace Application\Models;

class SearchResult extends BaseDTO implements \JsonSerializable
{
    //Записи в журнале
    protected string $recordId;
    protected string $letterNumber;
    protected string $letterHeader;
    protected string $registrationDate;
    protected string $additionally;

    //Контрагенты
    protected string $counterpartyId;
    protected string $counterpartyName;
    protected string $counterpartyTypeId;
    protected string $counterpartyTypeName;

    //Сотрудники организации
    protected string $employeeId;
    protected string $employeeName;
    protected string $employeePhoneNumber;
    protected string $employeeEmail;
    protected string $employeeTypeId;
    protected string $employeeTypeName;

    //Тип записи: 1. email - входящее 2. email - исходящее 3. письмо - входящее 4. письмо исходящее
    protected string $correspondenceTypeId;
    protected string $correspondenceTypeName;

    public function __construct(array $data){
        $this->init($data);
    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }




}