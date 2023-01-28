<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\DTO\ResponseDTO;
use Application\Models\EJournal;
use Application\Models\Record;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EJournalController
{
    public function __construct(private EJournal $ejournal) {
    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $search = $request->getQueryParams()['search'];
        $collection = $this->ejournal->get($search);
        return new JsonResponse($collection);
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = $request->getParsedBody()['DTO'];
        $recordId = $this->ejournal->insert(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = $request->getParsedBody()['DTO'];
        $recordId = $this->ejournal->insert(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function delete(ServerRequestInterface $request) : ResponseInterface {

    }

}