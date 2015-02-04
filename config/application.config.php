<?php

return [
    'modules' => [
        'DoctrineModule',
        'ZfcBase',
        'ZfcUser',
        'Application',
    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
