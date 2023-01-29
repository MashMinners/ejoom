<?php

declare(strict_types=1);

namespace Application\Models\EJournal;

class ResultCollection implements \JsonSerializable
{
    private array $results;

    public function add(SearchResult $searchResult){
        $this->results[] = $searchResult;
    }

    public function remove(){

    }

    public function jsonSerialize() : mixed {
        $properties = get_object_vars($this);
        return $properties;
    }

}