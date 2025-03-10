<?php

namespace Tests\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

abstract class DoctrineTestCase extends TestCase
{
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        // $config = Setup::createXMLMetadataConfiguration(
        //     [__DIR__ . '/../../../app/Infrastructure/Doctrine/Mapping'],
        //     true
        // );

        // $connection = [
        //     'driver' => 'pdo_mysql',
        //     'host' => 'mysql',
        //     'dbname' => 'app_db',
        //     'user' => 'user',
        //     'password' => 'password',
        //     'charset' => 'utf8mb4'
        // ];

        $this->entityManager = require __DIR__ . '/../../../config/doctrine.php';

        // Crear esquema de base de datos para las pruebas
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        // $this->entityManager = null;
    }
}
