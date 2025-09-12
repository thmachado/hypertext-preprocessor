<?php

declare(strict_types=1);

use App\Security\Password;
use PHPUnit\Framework\TestCase;

final class PasswordTest extends TestCase
{
    private Password $password;

    protected function setUp(): void
    {
        $this->password = new Password();
    }

    public function testPasswordHash(): void
    {
        $this->assertIsString($this->password->setPassword("Thiago"));
    }

    public function testCreateHash(): void
    {
        $this->assertIsString($this->password->createHash("Thiago"));
    }

    public function testSetValidPassword(): void
    {
        $passwordString = "Thiago";
        $hash = $this->password->setPassword($passwordString);

        $this->assertIsString($hash);
        $this->assertIsBool($this->password->validPassword($passwordString, $hash));
        $this->assertTrue($this->password->validPassword($passwordString, $hash));
    }

    public function testSetWrongPassword(): void
    {
        $passwordString = "Thiago";
        $hash = $this->password->setPassword($passwordString);

        $this->assertIsString($hash);
        $this->assertIsBool($this->password->validPassword("Wrong password", $hash));
        $this->assertFalse($this->password->validPassword("Wrong password", $hash));
    }
}