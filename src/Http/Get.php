<?php

declare(strict_types=1);

namespace App\Http;

class Get
{
    public function get(string $key): string
    {
        $input = $_GET[$key] ?? "";
        return htmlspecialchars($input);
    }

    public function filterGet(string $key): string
    {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? "";
    }
}