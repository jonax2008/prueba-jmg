<?php

namespace App\Domain\User\Exception;

use Exception;

class WeakPasswordException extends Exception {
    public function __construct() {
        parent::__construct("Password does not meet security requirements");
    }
}
