<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\OutgoingMail;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OutGoingMailController
{
    public function __construct(private OutgoingMail $outgoingMail) {
    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $dto = $request->getQueryParams()['DTO'];
        $responseDTO = $this->outgoingMail->get($dto);//тут тоже в идеале настроить одно типовое DTO с кодом ответа и телом
        $response = (new JsonResponse($responseDTO));
        return $response;

    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $dto = $request->getParsedBody()['DTO'];
        $responseDTO = $this->outgoingMail->insert($dto);
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