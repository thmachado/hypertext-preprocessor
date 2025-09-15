<?php

declare(strict_types=1);

namespace App\Http;

class Post
{
    public function post(string $key): string
    {
        $input = $_POST[$key] ?? "";
        return htmlspecialchars($input);
    }

    public function filterPost(string $key): string
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? "";
    }
}