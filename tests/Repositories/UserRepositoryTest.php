<?php

declare(strict_types=1);

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase
{
    private ?PDO $pdo;
    private UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        $this->pdo = new PDO("sqlite::memory:");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("CREATE TEMPORARY TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            firstname TEXT NOT NULL,
            lastname TEXT NOT NULL,
            email TEXT NOT NULL)");
        $this->userRepository = new UserRepository($this->pdo);
    }

    protected function tearDown(): void
    {
        $this->pdo = null;
    }

    public function createUser(): User
    {
        return $this->userRepository->save(new User("Thiago", "Machado", "thiago@email.com"));
    }

    public function testFindAllEmpty(): void
    {
        $users = $this->userRepository->findAll();
        $this->assertCount(0, $users);
    }

    public function testFindAll(): void
    {
        $this->createUser();
        $users = $this->userRepository->findAll();
        $this->assertCount(1, $users);
        $this->assertEquals("Machado", $users[0]->getLastname());
    }

    public function testFindByIdNotFound(): void
    {
        $this->assertNull($this->userRepository->findById(1));
    }

    public function testFindById(): void
    {
        $this->createUser();
        $user = $this->userRepository->findById(1);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals("thiago@email.com", $user->getEmail());
    }

    public function testSave(): void
    {
        $user = $this->createUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getId());
    }

    public function testUpdateNotFound(): void
    {
        $this->assertNull($this->userRepository->update([
            "firstname" => "Thiago",
            "lastname" => "Machado",
            "email" => "thiago@email.com"
        ], 1));
    }

    public function testUpdate(): void
    {
        $user = $this->createUser();
        $userUpdated = $this->userRepository->update([
            "firstname" => "Thiago2",
            "lastname" => "Machado2",
            "email" => "thiago2@email.com"
        ], $user->getId());

        $this->assertInstanceOf(User::class, $userUpdated);
        $this->assertEquals("Thiago2", $userUpdated->getFirstname());
        $this->assertEquals("thiago2@email.com", $userUpdated->getEmail());
    }

    public function testDeleteNotFound(): void
    {
        $this->assertFalse($this->userRepository->delete(1));
    }

    public function testDelete(): void
    {
        $user = $this->createUser();
        $this->assertTrue($this->userRepository->delete($user->getId()));
    }
}