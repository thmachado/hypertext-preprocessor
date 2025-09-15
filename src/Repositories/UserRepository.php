<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function findAll(): array
    {
        $userList = [];
        $usersQuery = $this->pdo->query("SELECT id, firstname, lastname, email FROM users ORDER BY firstname, lastname ASC");
        if ($usersQuery === false) {
            return [];
        }

        $users = $usersQuery->fetchAll();
        foreach ($users as $user) {
            $userModel = new User($user["firstname"], $user["lastname"], $user["email"]);
            $userModel->setId($user["id"]);
            $userList[] = $userModel;
        }

        return $userList;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare("SELECT id, firstname, lastname, email FROM users WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === false) {
            return null;
        }

        $userModel = new User($user["firstname"], $user["lastname"], $user["email"]);
        $userModel->setId($user["id"]);
        return $userModel;
    }

    public function save(User $user): User
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
        $stmt->bindValue(":firstname", $user->getFirstname(), PDO::PARAM_STR);
        $stmt->bindValue(":lastname", $user->getLastname(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();

        $user->setId((int) $this->pdo->lastInsertId());
        return $user;
    }

    public function update(array $data, int $id): ?User
    {
        $stmt = $this->pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id");
        $stmt->bindValue(":firstname", $data["firstname"], PDO::PARAM_STR);
        $stmt->bindValue(":lastname", $data["lastname"], PDO::PARAM_STR);
        $stmt->bindValue(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return null;
        }

        $userModel = new User($data["firstname"], $data["lastname"], $data["email"]);
        $userModel->setId($id);
        return $userModel;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        return true;
    }
}