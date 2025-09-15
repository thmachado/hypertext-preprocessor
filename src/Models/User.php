<?php

declare(strict_types=1);

namespace App\Models;

use RuntimeException;

class User
{
    private int $id;

    public function __construct(
        private string $firstname,
        private string $lastname,
        private string $email
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException("Invalid email address");
        }

        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Summary of toArray
     * @return array<string>
     */
    public function toArray(): array
    {
        return [
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "email" => $this->getEmail()
        ];
    }
}