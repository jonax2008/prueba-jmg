<?php

namespace Tests\Infrastructure\Doctrine\Repository;

use Tests\Infrastructure\Doctrine\DoctrineTestCase;
use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;

class DoctrineUserRepositoryTest extends DoctrineTestCase
{
    private DoctrineUserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new DoctrineUserRepository($this->entityManager);
    }

    public function testSaveAndFindById()
    {
        $userId = new UserId(uniqid());
        $name = new Name('Juan');
        $email = new Email('juan@example.com');
        $password = new Password('SecurePass1!');

        $user = new User(
            $userId,
            $name,
            $email,
            $password,
            new \DateTimeImmutable()
        );

        // Guardar usuario
        $this->userRepository->save($user);
        $this->entityManager->flush();

        // Buscar por ID
        $foundUser = $this->userRepository->findById($userId);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($userId->getValue(), $foundUser->getId()->getValue());
        $this->assertEquals($email->getValue(), $foundUser->getEmail()->getValue());
    }

    public function testDeleteUser()
    {
        $userId = new UserId(uniqid());
        $name = new Name('Juan');
        $email = new Email('juan@example.com');
        $password = new Password('SecurePass1!');

        $user = new User(
            $userId,
            $name,
            $email,
            $password,
            new \DateTimeImmutable()
        );

        $this->userRepository->save($user);
        $this->entityManager->flush();

        // Eliminar usuario
        $this->userRepository->delete($userId);
        $this->entityManager->flush();

        $foundUser = $this->userRepository->findById($userId);
        $this->assertNull($foundUser);
    }
}
