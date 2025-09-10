<?php

declare(strict_types=1);

namespace App\Basics;

class Functions
{
    public function anonymous(string $string): string
    {
        $function = function ($value): string {
            return $value;
        };

        return $function($string);
    }

    public function arrow(int $number): int | float
    {
        $result = fn($number) => $number * 5;
        return $result($number);
    }

    public function variadic(...$data): array
    {
        return array_merge($data);
    }
}
