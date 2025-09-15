<?php

declare(strict_types=1);

namespace App\Basics;

class Arrays
{
    /**
     * Summary of __construct
     * @param array<string> $data
     */
    public function __construct(
        public array $data = ["Palmeiras", "Corinthians", "Santos", "São Paulo"]
    ) {}

    public function push(string $content): int
    {
        return array_push($this->data, $content);
    }

    /**
     * Summary of merge
     * @param array<string> $data
     * @return array<string>
     */
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

    /**
     * Summary of map
     * @return array<string>
     */
    public function map(): array
    {
        return array_map(function ($value) {
            return strtoupper($value);
        }, $this->data);
    }

    /**
     * Summary of filter
     * @return array<string>
     */
    public function filter(): array
    {
        return array_filter($this->data, function ($value) {
            return strlen($value) > 6;
        });
    }
}
