<?php

namespace App\Domain\User\Exception;

use Exception;

class UserAlreadyExistsException extends Exception {
    public function __construct(string $email) {
        parent::__construct("User $email already exists");
    }
}
