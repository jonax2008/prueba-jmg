<?php

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidEmailException;

final class Email {
    private string $value;

    public function __construct(string $value) {
        $this->validate($value);
        $this->value = strtolower($value);
    }

    public function getValue(): string {
        return $this->value;
    }

    public function validate(string $value): void {
        $this->validateEmailFormat($value);
    }

    public function validateEmailFormat($value): void {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($value);
        }
    }

    public function equals(Email $other): bool {
        return $this->value === $other->getValue();
    }
}
