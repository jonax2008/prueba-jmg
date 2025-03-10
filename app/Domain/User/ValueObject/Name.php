<?php

namespace App\Domain\User\ValueObject;

use InvalidArgumentException;

final class Name {
    private string $value;
    const MIN_LENGHT = 3;

    public function __construct(string $value) {
        $this->validate($value);
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function validate($value): void {
        $this->validateMinLength($value);
        $this->validateChars($value);
    }

    public function validateMinLength($value): void {
        if (strlen($value) < self::MIN_LENGHT) {
            throw new InvalidArgumentException('Invalid length. Minimun required is ' . self::MIN_LENGHT);
        }
    }

    public function validateChars($value): void {
        if (!preg_match('/^[a-zA-Z\sáéíóúÁÉÍÓÚ]+$/', $value)) {
            throw new InvalidArgumentException('Invalid characters. Only letters, spaces, and accented characters are allowed.');
        }
    }

    public function equals(Name $other): bool {
        return $this->value === $other->getValue();
    }
}
