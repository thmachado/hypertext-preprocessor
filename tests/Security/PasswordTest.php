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
        $this->assertNotEmpty($this->password->setPassword("Thiago"));
    }

    public function testCreateHash(): void
    {
        $this->assertNotEmpty($this->password->createHash("Thiago"));
    }

    public function testSetValidPassword(): void
    {
        $passwordString = "Thiago";
        $hash = $this->password->setPassword($passwordString);
        $this->assertNotEmpty($hash);
        $this->assertTrue($this->password->validPassword($passwordString, $hash));
    }

    public function testSetWrongPassword(): void
    {
        $passwordString = "Thiago";
        $hash = $this->password->setPassword($passwordString);
        $this->assertNotEmpty($hash);
        $this->assertFalse($this->password->validPassword("Wrong password", $hash));
    }
}