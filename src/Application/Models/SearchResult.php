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

    //Сотрудники организации
    protected string $employeeId;
    protected string $employeeSurname;
    protected string $employeeFirstName;
    protected string $employeeSecondName;
    protected string $employeePhoneNumber;
    protected string $employeeEmail;

    //Тип записи: 1. email - входящее 2. email - исходящее 3. письмо - входящее 4. письмо исходящее
    protected int $correspondenceTypeId;
    protected string $correspondenceTypeName;

    public function __construct(array $data){
        $this->init($data);
    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }




}