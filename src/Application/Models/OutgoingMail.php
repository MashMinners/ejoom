<?php

declare(strict_types=1);

namespace Application\Models;

use Engine\Database\IConnector;

class OutgoingMail
{
    private \PDO $pdo;

    public function __construct(IConnector $connector){
        $this->pdo = $connector::connect();
    }

    private function getMailByFastSearch(string $searchString) : array {

    }

    private function getMailByDate(string $startDate, string $endDate = null) : array {

    }

    private function getMailByParams(array $params) : array {

    }

    public function get($dto) {
        //Суда будет приходить DTO. По полю SearchType будет определятся какой из приватных поисков будет
        //использоваться, а соответсвенно внутри каждого поиска из DTO будут браться только нужные данные
    }

    public function insert($dto) {

    }

    public function update() {

    }

    public function delete() {

    }

}