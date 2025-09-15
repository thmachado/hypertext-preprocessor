<?php

declare(strict_types=1);

namespace App\Files;

class Json
{
    /**
     * Summary of __construct
     * @param array<string> $data
     */
    public function __construct(
        private array $data = ["Palmeiras", "Corinthians", "Santos", "São Paulo"]
    ) {
    }

    /**
     * Summary of readJson
     * @param bool $associative
     * @return array<string>
     */
    public function readJson(bool $associative = true): array
    {
        return json_decode($this->toJson(), $associative);
    }

    public function toJson(): string
    {
        $json = json_encode($this->data);
        if ($json === false) {
            return "";
        }

        return $json;
    }
}