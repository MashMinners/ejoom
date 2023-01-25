<?php

return [
    #Factories
    'Application' => \DI\factory('\Engine\Core\ApplicationFactory::create'),
    \Engine\Router\IRouter::class => DI\factory('\Engine\Router\RouterFactory::create'),
    #Dependencies
    \Engine\Database\IConnector::class => DI\get('\Engine\Database\MySQLDbConnector'),
    'Emitter' => DI\get(\Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter::class)
];