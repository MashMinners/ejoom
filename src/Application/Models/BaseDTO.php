<?php

declare(strict_types=1);

namespace Application\Models;

use Engine\Utilities\StringFormatter;

class BaseDTO
{
    protected function init(array|string $data) : void {
        if (is_string($data)){
            $data = json_decode($data);
        }
        foreach ($data as $key=>$value){
            $camelizedKey = StringFormatter::camelize($key);
            $this->$camelizedKey = $value;
        }
    }

}