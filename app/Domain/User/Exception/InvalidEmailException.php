<?php

namespace App\Domain\User\Exception;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Invalid email format: $email");
    }
}
