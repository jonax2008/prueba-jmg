<?php

declare(strict_types=1);

namespace Tests\Domain\User\ValueObject;

use App\Domain\User\ValueObject\UserId;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class UserIdTest extends TestCase
{
    public function testItCreatesValidUserId(): void
    {
        $uuid = uniqid();
        $userId = new UserId($uuid);

        $this->assertSame($uuid, (string) $userId->getValue());
    }

    public function testItThrowsExceptionForInvalidUuid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new UserId('invalid-uuid');
    }
}
