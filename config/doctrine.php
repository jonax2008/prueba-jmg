<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../vendor/autoload.php';

$paths = [__DIR__ . '/../src/Domain']; // Directorio donde están las entidades
$isDevMode = true;

// Configuración de Doctrine
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

// Parámetros de conexión a MySQL
$dbParams = [
    'dbname'   => 'app_db',
    'user'     => 'user',
    'password' => 'password',
    'host'     => 'mysql',
    'driver'   => 'pdo_mysql',
];

// Crear conexión y EntityManager
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;