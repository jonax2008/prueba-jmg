<?php

namespace App\Application\User;

use App\Infrastructure\Doctrine\Repository\DoctrineUserRepository;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\Entity\User;
use App\Application\User\Event\UserRegisteredEvent;
use App\Domain\User\Exception\UserAlreadyExistsException;

class RegisterUserUseCase {
    private UserRepositoryInterface  $userRepository;
    private $eventHandler;

    public function __construct(UserRepositoryInterface $userRepository, $eventHandler) {
        $this->userRepository = $userRepository;
        $this->eventHandler = $eventHandler;
    }

    public function execute(RegisterUserRequest $request): User {
        $id = new UserId(uniqid());
        $name = new Name($request->getName());
        $email = new Email($request->getEmail());
        $password = new Password($request->getPassword());

        // Validar que el email no esté registrado
        if ($this->userRepository->findByEmail($email->getValue())) {
            throw new UserAlreadyExistsException($email->getValue());
        }

        $user = new User($id, $name, $email, $password, new \DateTimeImmutable());
        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->eventHandler->handle($event);

        return $user;
    }
}
