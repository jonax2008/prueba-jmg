<?php

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use DateTimeImmutable;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {
    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     */
    private UserId $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private Name $name;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private Email $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private Password $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    public function __construct(
        UserId $id,
        Name $name,
        Email $email,
        Password $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): UserId {
        return $this->id;
    }

    public function getName(): Name {
        return $this->name;
    }

    public function getEmail(): Email {
        return $this->email;
    }

    public function getPassword(): Password {
        return $this->password;
    }

    public function getCreatedAt(): DateTimeImmutable {
        return $this->createdAt;
    }

    public function verifyPassword(string $plainPassword): bool {
        return $this->password->verify($plainPassword);
    }
}
