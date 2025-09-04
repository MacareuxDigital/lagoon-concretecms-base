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
                            'prefix' => getenv('REDIS_CACHE_PREFIX') ?: 'myapp:overrides',
                            'servers' => [
                                [
                                    'host' => getenv('REDIS_HOST') ?: 'redis',
                                    'port' => getenv('REDIS_SERVICE_PORT') ?: 6379,
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
                            'prefix' => getenv('REDIS_CACHE_PREFIX') ?: 'myapp:expensive',
                            'servers' => [
                                [
                                    'host' => getenv('REDIS_HOST') ?: 'redis',
                                    'port' => getenv('REDIS_SERVICE_PORT') ?: 6379,
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
                            'prefix' => getenv('REDIS_CACHE_PREFIX') ?: 'myapp:object',
                            'servers' => [
                                [
                                    'host' => getenv('REDIS_HOST') ?: 'redis',
                                    'port' => getenv('REDIS_SERVICE_PORT') ?: 6379,
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
                    'prefix' => getenv('REDIS_CACHE_PREFIX') ?: 'myapp:page-cache',
                    'database' => 0,
                    'servers' => [
                        [
                            'host' => getenv('REDIS_HOST') ?: 'redis',
                            'port' => getenv('REDIS_SERVICE_PORT') ?: 6379,
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
            'prefix' => getenv('REDIS_SESSION_PREFIX') ?: 'myapp:session',
            'servers' => [
                [
                    'host' => getenv('REDIS_HOST') ?: 'redis',
                    'port' => getenv('REDIS_SERVICE_PORT') ?: 6379,
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
        // List of package handles that shouldn't be checked for new versions in marketplace (useful for example if the core is upgraded via composer)
        // Set to true to skip all the packages
        'skip_packages' => true,
    ],
    /*
     * ------------------------------------------------------------------------
     * Marketplace settings
     * ------------------------------------------------------------------------
     */
    'marketplace' => [
        /*
         * Enable marketplace integration
         *
         * @var bool concrete.marketplace.enabled
         */
        'enabled' => false,
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
