<?php

declare(strict_types=1);

namespace App\Basics;

class Type
{
    public function integer(int $number): int
    {
        return $number ?? 1914;
    }

    public function float(float $amount): float
    {
        return $amount ?? 19.14;
    }

    public function string(string $string): string
    {
        return $string ?? "";
    }

    public function boolean(bool $boolean): bool
    {
        return $boolean ?? true;
    }

    public function array(array $array): array
    {
        return $array ?? [];
    }

    public function object(object $object): object
    {
        return $object ?? (object) [];
    }

    public function null(null $null): null
    {
        return $null ?? null;
    }

    public function callable(callable $callback): mixed
    {
        return call_user_func($callback);
    }

    public function union(array|string|int $variable): mixed
    {
        return $variable;
    }

    public function void(): void
    {
        echo "When you will not return a explicit value";
    }
}
