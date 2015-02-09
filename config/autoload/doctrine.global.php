<?php

use Doctrine\DBAL\Driver\PDOMySql\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'tickets',
                    'driverOptions' => [
                        'encoding' => 'utf8',
                    ]
                ]
            ]
        ]
    ]
];
