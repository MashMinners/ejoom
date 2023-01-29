<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\EJournal\EJournal;
use Application\Models\EJournal\Record;
use Application\Models\EJournal\Search;
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
        $json = file_get_contents('php://input');
        $recordId = $this->ejournal->insert(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $recordId = $this->ejournal->update(new Record($json));
        $response = (new JsonResponse($recordId));
        return $response;
    }

    public function remove(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $result = $this->ejournal->delete($json);
        $response = (new JsonResponse($result));
        return $response;
    }

}