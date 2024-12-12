<?php

return [
    /*
     * ------------------------------------------------------------------------
     * Cache settings
     * ------------------------------------------------------------------------
     */
    'cache' => [
        'directory' => '/app/cache',
        'page' => [
            'directory' => '/app/cache/pages',
        ],
        'levels' => [
            'overrides' => [
                'drivers' => [
                    'core_filesystem' => [
                        'options' => [
                            'path' => '/app/cache/overrides',
                        ],
                    ],
                ],
            ],
            'expensive' => [
                'drivers' => [
                    'core_filesystem' => [
                        'options' => [
                            'path' =>  '/app/cache/expensive',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'updates' => [
        // Skip the automatic check of new Concrete versions availability
        'skip_core' => true,
    ],
    'debug' => [
        'hide_keys' => [
            // Hide database password and hostname in whoops output if supported
            '_ENV' => ['MARIADB_PASSWORD', 'MARIADB_HOST'],
            '_SERVER' => ['MARIADB_PASSWORD', 'MARIADB_HOST'],
        ]
    ]
];
