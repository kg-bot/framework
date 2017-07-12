<?php

$database = [
    /**
     * Default database used in application
     */
    'default' => 'localhost',
    
    'db' => [
        'localhost' => [
            'driver'   => 'mysql',
            'database' => 'framework',
            'hostname' => '127.0.0.1',
            'username' => 'framework',
            'password' => 'temp123',
        ],
    ],
];

return $database;