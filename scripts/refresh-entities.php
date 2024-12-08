<?php

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Database\DatabaseStructureManager;
use Concrete\Core\Package\Event\PackageEntities;
use Doctrine\ORM\EntityManagerInterface;

$connection = app(Connection::class);
/**
 * Refresh entities if there are tables in the database
 * We can't use c5:is-installed because we have live.database.php
 */
if ($connection->query('show tables')->rowCount()) {
    $pev = new PackageEntities();
    app('director')->dispatch('on_refresh_package_entities', $pev);
    $entityManagers = array_merge([app(EntityManagerInterface::class)], $pev->getEntityManagers());
    foreach ($entityManagers as $em) {
        $manager = new DatabaseStructureManager($em);
        $manager->refreshEntities();
    }
}
