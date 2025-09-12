<?php

declare(strict_types=1);

use App\Models\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User("Thiago", "Machado", "thiago@email.com");
    }

    public function testSetId(): void
    {
        $this->user->setId(1);
        $this->assertIsNumeric($this->user->getId());
        $this->assertEquals(1, $this->user->getId());
    }

    public function testSetFirstname(): void
    {
        $this->user->setFirstname("Thiago2");
        $this->assertIsString($this->user->getFirstname());
        $this->assertEquals("Thiago2", $this->user->getFirstname());
    }

    public function testSetLastname(): void
    {
        $this->user->setLastname("Machado2");
        $this->assertIsString($this->user->getLastname());
        $this->assertEquals("Machado2", $this->user->getLastname());
    }

    public function testSetEmail(): void
    {
        $this->user->setEmail("thiago@gmail.com");
        $this->assertIsString($this->user->getEmail());
        $this->assertEquals("thiago@gmail.com", $this->user->getEmail());
    }

    public function testSetInvalidEmail(): void
    {
        $this->expectExceptionMessage("Invalid email address");
        $this->expectException(RuntimeException::class);
        $this->user->setEmail("thiago");
    }

    public function testGetFirstname(): void
    {
        $firstname = $this->user->getFirstname();
        $this->assertIsString($firstname);
        $this->assertEquals("Thiago", $firstname);
    }

    public function testGetLastname(): void
    {
        $lastname = $this->user->getLastname();
        $this->assertIsString($lastname);
        $this->assertEquals("Machado", $lastname);
    }

    public function testGetEmail(): void
    {
        $email = $this->user->getEmail();
        $this->assertIsString($email);
        $this->assertEquals("thiago@email.com", $email);
    }

    public function testGetUserArray(): void
    {
        $user = $this->user->toArray();
        $this->assertIsArray($user);
        $this->assertCount(3, $user);
        $this->assertEquals("Machado", $user["lastname"]);
        $this->assertEquals("thiago@email.com", $user["email"]);
    }
}