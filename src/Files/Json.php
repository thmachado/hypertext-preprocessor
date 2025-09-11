<?php

declare(strict_types=1);

namespace App\Files;

class Json
{
    public function __construct(
        private array $data = ["Palmeiras", "Corinthians", "Santos", "São Paulo"]
    ) {
    }

    public function readJson(bool $associative = true): array
    {
        return json_decode($this->toJson(), $associative);
    }

    public function toJson(): string
    {
        return json_encode($this->data);
    }
}