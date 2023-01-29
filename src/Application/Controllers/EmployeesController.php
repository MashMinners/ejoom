<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\Employees\EmployeesManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class EmployeesController
{
    public function __construct(private EmployeesManager $employeesManager){

    }

    public function get(ServerRequestInterface $request){
        $json = file_get_contents('php://input');
        $collection = $this->employeesManager->get($json);
        return (new JsonResponse($collection));
    }

}