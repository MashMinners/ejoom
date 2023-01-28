<?php

declare(strict_types=1);

namespace Application\Models;

use Ramsey\Uuid\Uuid;

/**
 *  DTO объект содержащий информацию об одной записи.
 *  Операции: 1. добавление, создание записи в журнал, 2. обновление, редактирование записи.
 */
class Record
{
    public function __construct(string $json){
        $this->create($json);
    }

    private string $id;
    private int $letterNumber;
    private string $letterHeader;
    private int $counterparty;
    private int $counterpartyType;
    private int $employee;
    private int $employeeType;
    private string $registrationDate;
    private int $correspondenceType;
    private string $additionally;

    public function __get(string $name) : string|int {
        return $this->$name;
    }

    private function create(string $json) {
        $DTO = json_decode($json);
        $this->letterNumber = (int) $DTO['letterNumber'];
        $this->letterHeader = $DTO['letterHeader'];
        $this->counterparty = (int) $DTO['counterparty'];
        $this->counterpartyType = (int) $DTO['counterpartyType'];
        $this->employee = (int) $DTO['employee'];
        $this->employeeType = (int) $DTO['employeeType'];
        $this->registrationDate = $DTO['registrationDate'];
        $this->correspondenceType = (int) $DTO['correspondence_type'];
        $this->additionally = $DTO['additionally'];
        $this->id = $DTO['id'] ?? Uuid::uuid4();
    }
}