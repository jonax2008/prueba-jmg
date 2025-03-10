<?php

namespace App\Application\User\DTO;

use App\Domain\User\Entity\User;

class UserResponseDTO {
    public string $id;
    public string $name;
    public string $email;
    public string $createdAt;

    public function __construct(User $user) {
        $this->id = $user->getId()->getValue();
        $this->name = $user->getName()->getValue();
        $this->email = $user->getEmail()->getValue();
        $this->createdAt = $user->getCreatedAt()->format('Y-m-d H:i:s');
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->createdAt,
        ];
    }
}
