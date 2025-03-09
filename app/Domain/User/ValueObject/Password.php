<?php

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\WeakPasswordException;

final class Password {
    private string $hash;
    const MIN_LENGHT = 8;

    public function __construct(string $plainPassword) {
        $this->validatePassword($plainPassword);
        $this->hash = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    private function validatePassword(string $plainPassword): void {
        if (strlen($plainPassword) < self :: MIN_LENGHT) {
            throw new WeakPasswordException();
        }

        if (!preg_match('/[A-Z]/', $plainPassword)) {
            throw new WeakPasswordException();
        }

        if (!preg_match('/[0-9]/', $plainPassword)) {
            throw new WeakPasswordException();
        }

        if (!preg_match('/[\W]/', $plainPassword)) {
            throw new WeakPasswordException();
        }
    }

    public function getHash(): string {
        return $this->hash;
    }

    public function verify(string $plainPassword): bool {
        return password_verify($plainPassword, $this->hash);
    }

    public function __toString(): string {
        return $this->hash;
    }
    
}
