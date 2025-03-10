<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function testValidName()
    {
        $name = new Name('John Doe');
        $this->assertEquals('John Doe', $name->getValue());
    }

    public function testEmptyName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('');
    }

    public function testNotValidName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('12234');
    }

    public function testNameEquality()
    {
        $name1 = new Name('John Doe');
        $name2 = new Name('John Doe');
        $name3 = new Name('Jane Doe');

        $this->assertTrue($name1->equals($name2));
        $this->assertFalse($name1->equals($name3));
    }
}