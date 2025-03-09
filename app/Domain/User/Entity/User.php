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
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

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
        $this->id = (string) $id->getValue();
        $this->name = $name->getValue();
        $this->email = $email->getValue();
        $this->password = $password->getHash();
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): UserId {
        return new UserId($this->id);
    }

    public function getName(): Name {
        return new Name($this->name);
    }

    public function getEmail(): Email {
        return new Email($this->email);
    }

    public function getPassword(): Password {
        return new Password($this->password);
    }

    public function getCreatedAt(): DateTimeImmutable {
        return $this->createdAt;
    }

    // public function verifyPassword(string $plainPassword): bool {
    //     return $this->password->verify($plainPassword);
    // }
}
