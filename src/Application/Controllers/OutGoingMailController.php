<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\DTO\ResponseDTO;
use Application\Models\ElectronicMail;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OutGoingMailController
{
    public function __construct(private ElectronicMail $electronicMail) {
    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        //$dto = $request->getQueryParams()['DTO'];
        //$responseDTO = $this->electronicMail->get($dto);//тут тоже в идеале настроить одно типовое DTO с кодом ответа и телом
        $responseDTO = new ResponseDTO();
        $responseDTO->mailNumber = '1';
        $responseDTO->mailDate = '01.01.2023';
        $response = (new JsonResponse($responseDTO));
        return $response;

    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $dto = $request->getParsedBody()['DTO'];
        $responseDTO = $this->electronicMail->insert($dto);
        $response = (new JsonResponse($responseDTO));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $responseDTO = $this->outgoingMail->update();
        $response = (new JsonResponse($responseDTO));
        return $response;
    }

    public function delete(ServerRequestInterface $request) : ResponseInterface {
        $responseDTO = $this->outgoingMail->delete();
        $response = (new JsonResponse($responseDTO));
        return $response;
    }

}