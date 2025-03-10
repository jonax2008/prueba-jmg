<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface {
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): ?User {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function findById(UserId $id): ?User {
        return $this->entityManager->find(User::class, $id->getValue());
    }

    public function delete(UserId $id): void {
        $user = $this->findById($id);
        if ($user !== null) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }

    public function findByEmail(string $email): ?User {
        return $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => $email]);
    }
}
