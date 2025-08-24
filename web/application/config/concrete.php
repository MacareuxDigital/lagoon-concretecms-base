<?php

return [
    /*
     * ------------------------------------------------------------------------
     * Cache settings
     * ------------------------------------------------------------------------
     */
    'cache' => [
        'directory' => '/app/web/application/cache',
        'directory_relative' => '/application/cache',
        'page' => [
            'directory' => '/app/web/application/cache/pages',
        ],
        'levels' => [
            'overrides' => [
                'drivers' => [
                    'core_filesystem' => [
                        'options' => [
                            'path' => '/app/web/application/cache/overrides',
                        ],
                    ],
                ],
            ],
            'expensive' => [
                'drivers' => [
                    'core_filesystem' => [
                        'options' => [
                            'path' => '/app/web/application/cache/expensive',
                        ],
                    ],
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
