<?php

namespace App\Domain\User\ValueObject;

final class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function generate(): self
    {
        return new self(uniqid());
    }

    // ✅ Permitir comparación entre objetos
    public function equals(UserId $other): bool
    {
        return $this->value === $other->getValue();
    }
}
