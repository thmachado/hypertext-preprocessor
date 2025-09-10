<?php

declare(strict_types=1);

namespace App\Basics;

class Arrays
{
    public function __construct(
        public array $data = ["Palmeiras", "Corinthians", "Santos", "São Paulo"]
    ) {}

    public function push(string $content): int
    {
        return array_push($this->data, $content);
    }

    public function merge(array $data): array
    {
        return array_merge($this->data, $data);
    }

    public function pop(): mixed
    {
        return array_pop($this->data);
    }

    public function shift(): mixed
    {
        return array_shift($this->data);
    }

    public function map(): array
    {
        return array_map(function ($value) {
            return strtoupper($value);
        }, $this->data);
    }

    public function filter(): array
    {
        return array_filter($this->data, function ($value) {
            return strlen($value) > 6;
        });
    }
}
