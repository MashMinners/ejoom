<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\Employees\Employee;
use Application\Models\Employees\EmployeesManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EmployeesController
{
    public function __construct(private EmployeesManager $employeesManager){

    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $query = $request->getQueryParams()['search'];
        $collection = $this->employeesManager->get($query);
        return (new JsonResponse($collection));
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $employeeId = $this->employeesManager->insert(new Employee($json));
        $response = (new JsonResponse($employeeId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $employeeId = $this->employeesManager->update(new Employee($json));
        $response = (new JsonResponse($employeeId));
        return $response;
    }

    public function remove(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $result = $this->employeesManager->delete($json);
        $response = (new JsonResponse($result));
        return $response;
    }

}