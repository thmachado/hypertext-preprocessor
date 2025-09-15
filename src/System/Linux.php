<?php

declare(strict_types=1);

namespace App\System;

class Linux
{
    /**
     * Summary of ls
     * @param string $args
     * @return array<string>
     */
    public function ls(string $args = ""): array
    {
        exec("ls {$args}", $result);
        return $result;
    }

    public function pwd(): bool|string|null
    {
        return shell_exec("pwd");
    }

    /**
     * Summary of ps
     * @return array<string>
     */
    public function ps(): array
    {
        exec("ps", $result);
        return $result;
    }

    public function uptime(): bool|string|null
    {
        return shell_exec("uptime");
    }
}