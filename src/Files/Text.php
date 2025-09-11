<?php

declare(strict_types=1);

namespace App\Files;

class Text 
{
    public string $file = "";
    public string $filepath = __DIR__ . '/../../storage/';

    public function __construct(private string $filename)
    {
        $this->file = $this->filepath . $this->filename;
        $this->processFile();
    }

    public function processFile(): void
    {
        if (is_dir($this->filepath) === false) {
            mkdir($this->filepath);
        }

        if (is_file($this->file) === false) {
            touch($this->file);
        }
    }

    public function readFile(): string
    {
        return file_get_contents($this->file) ?: "";
    }

    public function writeFile(string $text): void
    {
        file_put_contents($this->file, $text, FILE_APPEND);
    }

    public function cleanFile(): void
    {
        file_put_contents($this->file, "");
    }

    public function deleteFile(): bool
    {
        return unlink($this->file);
    }
}