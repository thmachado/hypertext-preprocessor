<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define("LANGUAGE", "PHP - Hypertext-Preprocessor ♥");
echo "My interpretation about " . LANGUAGE;