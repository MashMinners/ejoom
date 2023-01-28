<?php

declare(strict_types=1);

namespace Application\Models\DTO;

/**
 * DTO для ответа на все get запросы
 */
class ResponseDTO implements \JsonSerializable
{
    private string $mailNumber;
    private string $mailDate;
    private string $mailHeader;
    private string $mailExecutor;
    private string $additionally;

    private string $id;

    public function __set(string $key, string $value){
        $this->$key = $value;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}