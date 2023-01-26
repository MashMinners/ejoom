<?php

declare(strict_types=1);

namespace Application\Models;

use Application\Models\DTO\RequestDTO;
use Application\Models\DTO\ResponseDTO;
use Engine\Database\IConnector;

class ElectronicMail
{
    private \PDO $pdo;

    public function __construct(){//IConnector $connector){
        //$this->pdo = $connector::connect();
    }

    private function getMailByFastSearch(string $searchString) : array {
        //Возвращает значения которые были введены в строку быстрого поиска
    }

    /**
     * Возвращает результат за период между началом и концом, либо на дату указанную в $startDate
     * Будет исопльзоваться для кнопок "Сегодня", "Вчера", "Неделя" для быстрого поиска писем по этим периодам
     * @param RequestDTO $DTO
     * @return ResponseDTO
     */
    private function getMailByDate(RequestDTO $DTO) : ResponseDTO {
        $query = ("SELECT * FROM table WHERE regdate BETWEEN :startDate AND :endDate");
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'startDate' => $DTO->startDate,
            'endDate' => $DTO->endDate
        ]);
        $result = $stmt->fetchAll();
        $output = new ResponseDTO();
        $output->mailNumber = $result['mailNumber'];
        $output->mailDate = $result['mailDate'];
        $output->mailHeader = $result['mailHeader'];
        $output->mailExecutor = $result['mailExecutor'];
        $output->additionally = $result['additionally'];
        return $output;
    }

    private function getMailByParams(array $params) : array {
        //Более серьезный поиск по большему количеству параметров, например за перод для исполнителя
        //Либо просто для поиск аза больший кастомный период
    }

    public function get(RequestDTO $DTO) : string {
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