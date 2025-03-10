<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\Exception\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testValidEmail()
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->getValue());
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalid-email');
    }

    public function testEmailIsLowercased()
    {
        $email = new Email('Test@Example.com');
        $this->assertEquals('test@example.com', $email->getValue());
    }

    public function testEmailEquality()
    {
        $email1 = new Email('test@example.com');
        $email2 = new Email('test@example.com');
        $email3 = new Email('different@example.com');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }
}