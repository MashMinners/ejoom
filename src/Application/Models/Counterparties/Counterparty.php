<?php

declare(strict_types=1);

namespace Application\Models\Counterparties;

use Application\Models\BaseDTO;

class Counterparty extends BaseDTO implements \JsonSerializable
{
    protected string|null $counterpartyId;
    protected string|null $counterpartyName;
    protected string|null $counterpartyDescription;

    public function __construct(array|string $data){
        $properties = get_class_vars(self::class);
        foreach ($properties as $name => $value){
            $this->$name = $value;
        }
        $this->init($data);
    }

    public function __get(string $name) : string|int|null {
        return $this->$name;
    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}