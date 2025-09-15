<?php

declare(strict_types=1);

namespace App\System;

class Linux
{
    public function ls(string $args = ""): array
    {
        exec("ls {$args}", $result);
        return $result;
    }

    public function pwd(): string
    {
        return shell_exec("pwd");
    }

    public function ps(): array
    {
        exec("ps", $result);
        return $result;
    }

    public function uptime(): string
    {
        return shell_exec("uptime");
    }
}