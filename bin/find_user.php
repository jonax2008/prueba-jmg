<?php

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/doctrine.php';

$userRepo = new DoctrineUserRepository($entityManager);

// 🔍 Buscar por ID
$id = new UserId('67ce02c31d32f'); // Reemplaza con un ID real
$user = $userRepo->findById($id);
if ($user) {
    echo "Usuario encontrado: " . $user->getName()->getValue() . "\n";
} else {
    echo "Usuario no encontrado\n";
}