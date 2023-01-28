<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\EJournal;
use Application\Models\Record;
use Application\Models\Search;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EJournalController
{
    public function __construct(private EJournal $ejournal) {
    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $collection = $this->ejournal->get(new Search($json));
        return new JsonResponse($collection);
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = $request->getParsedBody()['BaseDTO'];
        $recordId = $this->ejournal->insert(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = $request->getParsedBody()['BaseDTO'];
        $recordId = $this->ejournal->insert(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function delete(ServerRequestInterface $request) : ResponseInterface {

    }

}