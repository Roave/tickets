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
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ]
    ]
];
