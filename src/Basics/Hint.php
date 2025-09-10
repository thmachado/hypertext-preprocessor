<?php

declare(strict_types=1);

namespace App\Basics;

class Hint
{
    public function match(int $code): string
    {
        return match ($code) {
            200 => "Get users",
            201 => "Insert a user",
            400 => "User not found",
            204 => "Delete a user",
            default => 'MATCH!'
        };
    }

    public function named(string $firstname, string $lastname, string $email): string
    {
        return "{$firstname} {$lastname} {$email}";
    }
}
