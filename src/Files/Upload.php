<?php

declare(strict_types=1);

namespace App\Files;

use RuntimeException;

class Upload
{
    private int $maxSize = 100000;
    /**
     * Summary of disallowedFileExtensions
     * @var array<string> $disallowedFileExtensions
     */
    private $disallowedFileExtensions = [
        "exe",
        "sh",
        "bat",
        "js",
        "jar",
        "php",
        "phtml",
        "pl",
        "cgi",
        "asp",
        "py"
    ];
    /**
     * Summary of disallowedMimeTypes
     * @var array<string> $disallowedMimeTypes
     */
    private $disallowedMimeTypes = [
        "application/x-msdownload",
        "application/x-sh",
        "application/x-bat",
        "application/javascript",
        "application/java-archive",
        "application/x-php",
        "text/x-script.perl",
        "text/x-script.python"
    ];
    private string $path = __DIR__ . "/../../storage/";

    /**
     * Summary of __construct
     * @param array<mixed> $file
     */
    public function __construct(
        private array $file = []
    ) {
    }

    public function uploadFile(): string
    {
        try {
            $this->validateUploadTemp();
            $this->validateFileSize();
            $this->validateFileExtension();
            $this->validateMimeTypeFileExtension();
            return $this->validateUploadFile();
        } catch (RuntimeException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
    }

    private function validateUploadTemp(): void
    {
        if ($this->file["error"] !== UPLOAD_ERR_OK) {
            throw new RuntimeException("Upload error: " . $this->file["error"]);
        }
    }

    private function validateFileSize(): void
    {
        if ($this->file["size"] > $this->maxSize) {
            throw new RuntimeException("File exceeds size limit");
        }
    }

    private function validateFileExtension(): void
    {
        $extension = pathinfo($this->file["name"], PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $this->disallowedFileExtensions)) {
            throw new RuntimeException("File extension disallowed");
        }
    }

    private function validateMimeTypeFileExtension(): void
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($this->file['tmp_name']);

        if (in_array($mimeType, $this->disallowedMimeTypes)) {
            throw new RuntimeException("File mimetype extension disallowed");
        }
    }

    private function validateUploadFile(): string
    {
        $extension = pathinfo($this->file["name"], PATHINFO_EXTENSION);
        $fileName = bin2hex(random_bytes(16)) . "." . $extension;
        $arq_path = $this->path . $fileName;
        if (move_uploaded_file($this->file['tmp_name'], $arq_path) === false) {
            throw new RuntimeException("Upload error!");
        }

        return str_replace($this->path, "", $arq_path);
    }
}