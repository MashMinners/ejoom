<?php

declare(strict_types=1);

namespace Application\Models\Counterparties;

class CounterpartiesCollection implements \JsonSerializable
{
    private array $counterparties;

    public function add(Counterparty $counterparty){
        $this->counterparties[] = $counterparty;
    }

    public function remove(){

    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}