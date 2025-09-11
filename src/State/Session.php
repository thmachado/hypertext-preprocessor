<?php

declare(strict_types=1);

namespace App\State;

class Session
{
    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function save(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function unsetSession(string $key): void
    {
        unset($_SESSION[$key]);
    }
    public function unsetAll(): void
    {
        session_unset();
    }

    public function regenerate(): bool
    {
        return session_regenerate_id(true);
    }

    public function destroy(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}