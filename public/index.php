<?php
// public/index.php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/doctrine.php';

use App\Infrastructure\Http\Controller\RegisterUserController;
use App\Application\User\UserService;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use App\Application\User\Event\UserRegisteredEventHandler;
use App\Application\User\RegisterUserUseCase;

// Configuración del contenedor (simplificada)
$repository = new DoctrineUserRepository($entityManager);
$eventHandler = new UserRegisteredEventHandler();
$useCase = new RegisterUserUseCase($repository, $eventHandler);
$service = new UserService($useCase);
$controller = new RegisterUserController($service);

// Enrutamiento básico
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $path === '/register') {
    $controller->__invoke($_POST);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}