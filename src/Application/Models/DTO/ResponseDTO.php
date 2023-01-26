<?php

declare(strict_types=1);

namespace Application\Models\DTO;

class ResponseDTO implements \JsonSerializable
{
    private string $mailNumber;
    private string $mailDate;
    private string $mailHeader;
    private string $mailExecutor;
    private string $additionally;

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