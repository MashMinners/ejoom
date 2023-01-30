<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\Counterparties\CounterpartiesManager;
use Application\Models\Counterparties\Counterparty;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CounterpartiesController
{
    public function __construct(private CounterpartiesManager $counterpartiesManager){

    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $collection = $this->counterpartiesManager->get($json);
        return (new JsonResponse($collection));
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $counterpartyId = $this->counterpartiesManager->insert(new Counterparty($json));
        $response = (new JsonResponse($counterpartyId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $counterpartyId = $this->counterpartiesManager->update(new Counterparty($json));
        $response = (new JsonResponse($counterpartyId));
        return $response;
    }

    public function remove(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $result = $this->counterpartiesManager->delete($json);
        $response = (new JsonResponse($result));
        return $response;
    }

}