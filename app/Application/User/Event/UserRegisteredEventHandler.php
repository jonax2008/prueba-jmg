<?php

namespace App\Application\User\Event;

use App\Application\User\Event\UserRegisteredEvent;

class UserRegisteredEventHandler
{
    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $email = $user->getEmail()->getValue();
        $name = $user->getName()->getValue();

        // Acción simulada (enviar email de bienvenida)
        echo "Bienvenido, {$name}! Se ha enviado un correo de bienvenida a {$email}.\n";
    }
}
