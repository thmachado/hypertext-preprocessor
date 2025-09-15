<?php

declare(strict_types=1);

namespace App\Http;

class Server
{
    /**
     * Summary of __construct
     * @param array<string> $server
     */
    public function __construct(
        private array $server
    ) {
    }

    public function method(): string
    {
        return $this->server["REQUEST_METHOD"] ?? "GET";
    }

    public function uri(): string
    {
        return $this->server["REQUEST_URI"] ?? "/";
    }
}