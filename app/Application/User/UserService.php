<?php

namespace App\Application\User;

use App\Application\User\RegisterUserRequest;
use App\Application\User\RegisterUserUseCase;
use App\Domain\User\Entity\User;

class UserService {
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase) {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function registerUser(RegisterUserRequest $request): User {
        return $this->registerUserUseCase->execute($request);
    }
}
