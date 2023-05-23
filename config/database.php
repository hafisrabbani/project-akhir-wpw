<?php

use App\Helpers\Env;


return [
    'default' => Env::get('DB_CONNECTION', 'mysql'),



    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => Env::get('DB_HOST', 'localhost'),
            'port' => Env::get('DB_PORT', '3306'),
            'database' => Env::get('DB_DATABASE', 'windz'),
            'username' => Env::get('DB_USERNAME', 'root'),
            'password' => '    ', '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ]
];
