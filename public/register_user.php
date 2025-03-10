<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/doctrine.php';

use App\Infrastructure\Http\Controller\RegisterUserController;
// use App\Application\User\RegisterUserRequest;
use App\Application\User\UserService;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use App\Application\User\RegisterUserUseCase;
use App\Application\User\Event\UserRegisteredEventHandler;


$repository = $entityManager->getRepository(App\Domain\User\Entity\User::class);
$userRepository = new DoctrineUserRepository($entityManager);
$eventHandler = new UserRegisteredEventHandler();
$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventHandler);
$userService = new UserService($registerUserUseCase);
$controller = new RegisterUserController($userService);
// $request = new RegisterUserRequest($_POST['name'], $_POST['email'], $_POST['password']);

$controller->__invoke($_POST);;
