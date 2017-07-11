<?php

$routes = [

    'GET' => [
        'Home' => [
            '_controller' => 'App\Controllers\HomeController',
            'index' => 'indexAction',
        ],
        'Database' => [
            '_controller' => 'App\Controllers\DatabaseController',
            'read' => 'readAction',
        ],
    ],
    'POST' => [
        'Database' => [
            '_controller' => 'App\Controllers\DatabaseController',
            'create' => 'createAction',
            'update' => 'updateAction',
            'delete' => 'deleteAction',
        ],
    ]
];

return $routes;