<?php

declare(strict_types=1);

namespace Application\Models\EJournal;

use Application\Models\BaseDTO;

/**
 *  BaseDTO объект содержащий информацию об одной записи.
 *  Операции: 1. добавление, создание записи в журнал, 2. обновление, редактирование записи.
 */
class Record extends BaseDTO
{
    protected string|null $recordId;
    protected string|null $letterNumber;
    protected string|null $letterHeader;
    protected string|null $counterpartyId;
    protected string|null $employeeId;
    protected string|null $registrationDate;
    protected int|null $correspondenceTypeId;
    protected string|null $additionally;

    /**
     * @param string $json
     */
    public function __construct(string $json){
        $properties = get_class_vars(self::class);
        foreach ($properties as $name => $value){
            $this->$name = $value;
        }
        $this->init($json);
    }

    /**
     * @param string $name
     * @return string|int
     */
    public function __get(string $name) : string|int|null {
        return $this->$name;
    }

}