<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO("sqlite::memory:");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("CREATE TEMPORARY TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            firstname TEXT NOT NULL,
            lastname TEXT NOT NULL,
            email TEXT NOT NULL)");
    }

    public function testDatabaseSelectEmpty(): void
    {
        $usersQuery = $this->pdo->query("SELECT id, firstname, lastname, email FROM users ORDER BY firstname, lastname ASC");
        if ($usersQuery === false) {
            throw new RuntimeException("Query is failed");
        }

        $this->assertCount(0, $usersQuery->fetchAll());
    }

    public function testDatabaseSelectContent(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", "Thiago", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email.com", PDO::PARAM_STR);
        $stmt->execute();

        $usersQuery = $this->pdo->query("SELECT lastname FROM users ORDER BY firstname, lastname ASC");
        if ($usersQuery === false) {
            throw new RuntimeException("Query is failed");
        }

        /**
         * @var array<int, array<string>> $users
         */
        $users = $usersQuery->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $users);
        $this->assertEquals("Machado", $users[0]["lastname"]);
    }

    public function testDatabaseSelectContentById(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", "Thiago", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email.com", PDO::PARAM_STR);
        $stmt->execute();
        $userid = (int) $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("SELECT firstname, email FROM users WHERE id = :id");
        $stmt->bindValue(":id", $userid, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertIsArray($user);
        $this->assertEquals("Thiago", $user["firstname"]);
        $this->assertEquals("thiago@email.com", $user["email"]);
    }


    public function testDatabaseInsert(): void
    {
        $countInitialQuery = $this->pdo->query("SELECT COUNT(id) FROM users");
        if ($countInitialQuery === false) {
            throw new RuntimeException("Query is failed");
        }

        $countInitial = $countInitialQuery->fetchColumn();

        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", "Thiago", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email.com", PDO::PARAM_STR);
        $result = $stmt->execute();

        $countFinalQuery = $this->pdo->query("SELECT COUNT(id) FROM users");
        if ($countFinalQuery === false) {
            throw new RuntimeException("Query is failed");
        }

        $countFinal = $countFinalQuery->fetchColumn();

        $this->assertEquals(0, $countInitial);
        $this->assertEquals(1, $countFinal);
        $this->assertTrue($result);
    }

    public function testDatabaseUpdate(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", "Thiago", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email.com", PDO::PARAM_STR);
        $stmt->execute();
        $userid = (int) $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
        $stmt->bindValue(":firstname", "Thiago2", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado2", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email2.com", PDO::PARAM_STR);
        $stmt->bindValue(":id", $userid, PDO::PARAM_INT);
        $stmt->execute();
        $rowCount = $stmt->rowCount();

        $stmt = $this->pdo->prepare("SELECT id, firstname, lastname, email FROM users WHERE id = :id");
        $stmt->bindValue(":id", $userid, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertIsArray($user);
        $this->assertEquals(1, $rowCount);
        $this->assertEquals("Machado2", $user["lastname"]);
        $this->assertEquals("thiago@email2.com", $user["email"]);
    }

    public function testDatabaseDelete(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", "Thiago", PDO::PARAM_STR);
        $stmt->bindValue(":lastname", "Machado", PDO::PARAM_STR);
        $stmt->bindValue(":email", "thiago@email.com", PDO::PARAM_STR);
        $stmt->execute();
        $userid = (int) $this->pdo->lastInsertId();

        $countInitialQuery = $this->pdo->query("SELECT COUNT(id) FROM users");
        if ($countInitialQuery === false) {
            throw new RuntimeException("Query is failed");
        }

        $countInitial = $countInitialQuery->fetchColumn();

        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(":id", $userid, PDO::PARAM_INT);
        $result = $stmt->execute();
        $rowCount = $stmt->rowCount();

        $countFinalQuery = $this->pdo->query("SELECT COUNT(id) FROM users");
        if ($countFinalQuery === false) {
            throw new RuntimeException("Query failed");
        }

        $countFinal = $countFinalQuery->fetchColumn();

        $this->assertEquals(1, $rowCount);
        $this->assertEquals(1, $countInitial);
        $this->assertEquals(0, $countFinal);
        $this->assertTrue($result);
    }
}