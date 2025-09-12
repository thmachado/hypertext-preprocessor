<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): ?PDO
    {
        $sqlitePath = __DIR__ . '/../../users.sqlite';

        if (self::$instance === null) {
            try {
                self::$instance = new PDO("sqlite:{$sqlitePath}");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$instance->exec("CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    firstname TEXT NOT NULL,
                    lastname TEXT NOT NULL,
                    email TEXT NOT NULL
                )");
            } catch (PDOException $e) {
                throw new RuntimeException($e->getMessage());
            }
        }

        return self::$instance;
    }
}