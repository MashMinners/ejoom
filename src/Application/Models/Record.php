<?php

declare(strict_types=1);

namespace Application\Models;

use Ramsey\Uuid\Uuid;

/**
 *  BaseDTO объект содержащий информацию об одной записи.
 *  Операции: 1. добавление, создание записи в журнал, 2. обновление, редактирование записи.
 */
class Record
{
    public function __construct(string $json){
        $this->init($json);
    }

    private string $recordId;
    private int $letterNumber;
    private string $letterHeader;
    private int $counterpartyId;
    private int $employeeId;
    private string $registrationDate;
    private int $correspondenceTypeId;
    private string $additionally;

    public function __get(string $name) : string|int {
        return $this->$name;
    }

    private function init(string $json) {
        $DTO = json_decode($json);
        $this->letterNumber = $DTO['letterNumber'];
        $this->letterHeader = $DTO['letterHeader'];
        $this->counterpartyId = $DTO['counterpartyId'];
        $this->employeeId = $DTO['employeeId'];
        $this->registrationDate = $DTO['registrationDate'];
        $this->correspondenceTypeId = $DTO['correspondenceTypeId'];
        $this->additionally = $DTO['additionally'];
        $this->recordId = $DTO['id'] ?? Uuid::uuid4();
    }
}