<?php

use Zend\Db\Adapter\Adapter;

return [
    'zfcuser' => [
        'enable_registration'               => true,
        'enable_username'                   => true,
        'enable_display_name'               => true,
        'auth_identity_fields'              => ['username', 'email'],
        'login_after_registration'          => true,
        'use_redirect_parameter_if_present' => true,
        'login_redirect_route'              => 'zfcuser',
        'logout_redirect_route'             => 'zfcuser/login',
        'table_name'                        => 'user',
    ],

    'service_manager' => [
        'aliases' => [
            'zfcuser_zend_db_adapter' => Adapter::class,
        ],
    ],
];
