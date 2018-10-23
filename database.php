<?php

return [
    //...
    'connections' => [
        //...
        'tests' => [
            'driver'    => 'mysql',
            'host'      => env('DB_TEST_HOST', '127.0.0.1'),
            'port'      => env('DB_TEST_PORT', '3306'),
            'database'  => env('DB_TEST_DATABASE', 'tests'),
            'username'  => env('DB_TEST_USERNAME', 'root'),
            'password'  => env('DB_TEST_PASSWORD', 'root'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'engine' => null,
        ],
    ],
    //...
];
