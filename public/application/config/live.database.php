<?php

return [
    'default-connection' => 'concrete',
    'connections' => [
        'concrete' => [
            'driver' => 'concrete_pdo_mysql',
            'server' => getenv('MARIADB_HOST') ?: 'mariadb',
            'database' => getenv('MARIADB_DATABASE') ?: 'lagoon',
            'username' => getenv('MARIADB_USERNAME') ?: 'lagoon',
            'password' => getenv('MARIADB_PASSWORD') ?: 'lagoon',
            'character_set' => getenv('MARIADB_CHARSET') ?: 'utf8mb4',
            'collation' => getenv('MARIADB_COLLATION') ?: 'utf8mb4_unicode_ci',
        ],
    ],
];
