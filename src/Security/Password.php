<?php

declare(strict_types=1);

namespace App\Security;

class Password
{
    public function __construct(
        private string $secret = "secret"
    ) {
    }

    public function setPassword(string $password): string
    {
        return password_hash($this->createHash($password), PASSWORD_ARGON2ID);
    }

    public function validPassword(string $password, string $savedPassword): bool
    {
        return password_verify($this->createHash($password), $savedPassword);
    }

    public function createHash(string $password): string
    {
        return hash_hmac("sha256", $password, $this->secret);
    }
}