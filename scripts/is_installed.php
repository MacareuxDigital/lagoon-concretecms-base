<?php

declare(strict_types=1);

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Support\Facade\Application;

return static function (): int {
    $app = Application::getFacadeApplication();
    $connection = $app->make(Connection::class);

    if ($connection->query('SHOW TABLES')->rowCount() > 0) {
        // Concrete is installed
        return 0;
    }

    // Concrete is not installed
    return 1;
};
