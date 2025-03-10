<?php

namespace Tests\Application\User;

use PHPUnit\Framework\TestCase;
use App\Application\User\RegisterUserUseCase;
use App\Application\User\RegisterUserRequest;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Shared\Domain\Event\EventHandlerInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserId;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\Exception\UserAlreadyExistsException;

class RegisterUserUseCaseTest extends TestCase
{
    private $userRepository;
    private $eventHandler;
    private RegisterUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->eventHandler = $this->createMock(EventHandlerInterface::class);
        $this->useCase = new RegisterUserUseCase($this->userRepository, $this->eventHandler);
    }

    public function testExecuteSuccessfullyRegistersUser()
    {
        $request = new RegisterUserRequest('Juan', 'juan@example.com', 'SecurePass1!');

        // Simula que el email no existe (findByEmail debe devolver null)
        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($this->equalTo('juan@example.com'))
            ->willReturn(null);

        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($user) {
                return $user instanceof User &&
                    $user->getEmail()->getValue() === 'juan@example.com';
            }));

        $this->eventHandler->expects($this->once())
            ->method('handle')
            ->with($this->callback(function ($event) {
                return $event->getUser()->getEmail()->getValue() === 'juan@example.com';
            }));

        $user = $this->useCase->execute($request);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('juan@example.com', $user->getEmail()->getValue());
    }

    public function testExecuteThrowsExceptionIfEmailExists()
    {
        $request = new RegisterUserRequest('Juan', 'juan@example.com', 'SecurePass1!');

        // Simula que el email ya existe (findByEmail devuelve una instancia de User)
        $existingUser = new User(
            new UserId(uniqid()),
            new Name('Juan'),
            new Email('juan@example.com'),
            new Password('SecurePass1!'),
            new \DateTimeImmutable()
        );

        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($this->equalTo('juan@example.com'))
            ->willReturn($existingUser);

        $this->expectException(UserAlreadyExistsException::class);

        $this->useCase->execute($request);
    }
}
