<?php

use App\Application\User\RegisterUserUseCase;
use App\Application\User\Event\UserRegisteredEventHandler;
use App\Application\User\RegisterUserRequest;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/doctrine.php';

$repository = new DoctrineUserRepository($entityManager);
$eventHandler = new UserRegisteredEventHandler();

$useCase = new RegisterUserUseCase($repository, $eventHandler);

// ✅ Recibe argumentos desde la línea de comandos
$request = new RegisterUserRequest($argv[1], $argv[2], $argv[3]);
$useCase->execute($request);

echo "Usuario registrado correctamente!\n";
