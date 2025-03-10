<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Password;
use App\Domain\User\Exception\WeakPasswordException;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testValidPassword()
    {
        $password = new Password('StrongP@ssw0rd');
        $this->assertTrue(password_verify('StrongP@ssw0rd', $password->getHash()));
    }

    public function testWeakPasswordTooShort()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('Short1!');
    }

    public function testWeakPasswordNoUppercase()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('weakpassword1!');
    }

    public function testWeakPasswordNoNumber()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('WeakPassword!');
    }

    public function testWeakPasswordNoSpecialCharacter()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('WeakPassword1');
    }

    public function testPasswordVerification()
    {
        $password = new Password('StrongP@ssw0rd');
        $this->assertTrue($password->verify('StrongP@ssw0rd'));
        $this->assertFalse($password->verify('WrongPassword'));
    }

    public function testPasswordToString()
    {
        $password = new Password('StrongP@ssw0rd');
        $this->assertEquals($password->getHash(), (string) $password);
    }
}