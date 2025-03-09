<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// Ruta a las entidades (DONDE ESTÁ User.php)
$paths = [__DIR__ . '/../app/Domain']; // ⬅️ Cambiado a la carpeta de dominio
$isDevMode = true;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'user',
    'password' => 'password',
    'dbname'   => 'app_db',
    'host'     => 'mysql',
    'port'     => '3306',
];

// Usar ANOTACIONES en lugar de XML ⬇️
$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$entityManager = EntityManager::create($dbParams, $config);

return $entityManager;