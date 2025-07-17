<?php

return [
    /*
     * ------------------------------------------------------------------------
     * Cache settings
     * ------------------------------------------------------------------------
     */
    'cache' => [
        'levels' => [
            'overrides' => [
                'preferred_driver' => 'redis',
                'drivers' => [
                    'redis' => [
                        'options' => [
                            'database' => 0,
                            'prefix' => 'myapp:overrides',
                            'servers' => [
                                [
                                    'host' => 'redis',
                                    'port' => 6379,
                                    'ttl' => 5,
                                    'password' => null,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'expensive' => [
                'preferred_driver' => 'redis',
                'drivers' => [
                    'redis' => [
                        'options' => [
                            'database' => 0,
                            'prefix' => 'myapp:expensive',
                            'servers' => [
                                [
                                    'host' => 'redis',
                                    'port' => 6379,
                                    'ttl' => 5,
                                    'password' => null,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'object' => [
                'preferred_driver' => 'redis',
                'drivers' => [
                    'redis' => [
                        'options' => [
                            'database' => 0,
                            'prefix' => 'myapp:object',
                            'servers' => [
                                [
                                    'host' => 'redis',
                                    'port' => 6379,
                                    'ttl' => 5,
                                    'password' => null,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'page' => [
                'adapter' => 'redis',
                'redis' => [
                    'prefix' => 'myapp:page-cache',
                    'database' => 0,
                    'servers' => [
                        [
                            'host' => 'redis',
                            'port' => 6379,
                            'ttl' => 5,
                            'password' => null,
                        ],
                    ],
                ],
            ],
        ],
    ],

    'session' => [
        'handler' => 'redis',
        'redis' => [
            'database' => 0,
            'prefix' => 'myapp:session',
            'servers' => [
                [
                    'host' => 'redis',
                    'port' => 6379,
                    'ttl' => 5,
                    'password' => null,
                ],
            ],
        ],
    ],

    /*
     * ------------------------------------------------------------------------
     * Sitemap.xml settings
     * ------------------------------------------------------------------------
     */
    'sitemap_xml' => [
        'file' => 'application/files/sitemap.xml',
    ],
    /*
     * ------------------------------------------------------------------------
     * Queue/Command/Messenger settings
     * ------------------------------------------------------------------------
     */
    'messenger' => [
        'consume' => [
            'method' => 'worker',
        ],
    ],
    'processes' => [
        'scheduler' => [
            'enable' => true,
        ],
    ],
    /*
     * ------------------------------------------------------------------------
     * Update settings
     * ------------------------------------------------------------------------
     */
    'updates' => [
        // Skip the automatic check of new Concrete versions availability
        'skip_core' => true,
    ],
    /*
     * ------------------------------------------------------------------------
     * Debug settings
     * ------------------------------------------------------------------------
     */
    'debug' => [
        'hide_keys' => [
            // Hide database password and hostname in whoops output if supported
            '_ENV' => ['MARIADB_PASSWORD', 'MARIADB_HOST'],
            '_SERVER' => ['MARIADB_PASSWORD', 'MARIADB_HOST'],
        ]
    ],
];
