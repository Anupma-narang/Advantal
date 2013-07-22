<?php // initializes testing framework

// initialize database manager
require_once('unit.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);

new sfDatabaseManager($configuration);
//Descomentar para cargar los fixtures

Doctrine_Core::dropDatabases();
Doctrine_Core::createDatabases();
Doctrine_Core::createTablesFromModels(__DIR__ . '/../../lib/model');
Doctrine_Core::loadData(__DIR__ . '/../data/');
