<?php

declare(strict_types=1);

namespace App\Basics;

class Type
{
    public function integer(int $number): int
    {
        return $number;
    }

    public function float(float $amount): float
    {
        return $amount;
    }

    public function string(string $string): string
    {
        return $string;
    }

    public function boolean(bool $boolean): bool
    {
        return $boolean;
    }

    /**
     * Summary of array
     * @param array<mixed> $array
     * @return array<mixed>
     */
    public function array(array $array): array
    {
        return $array;
    }

    public function object(object $object): object
    {
        return $object;
    }

    public function null(null $null): null
    {
        return $null;
    }

    public function callable(callable $callback): mixed
    {
        return call_user_func($callback);
    }
    
    /**
     * Summary of union
     * @param array<int|string>|string|int $variable
     * @return array<int|string>|string|int
     */
    public function union(array|string|int $variable): mixed
    {
        return $variable;
    }
}
