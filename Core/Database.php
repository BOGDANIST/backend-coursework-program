<?php
declare(strict_types=1);

namespace App\Core;

use mysqli;

/**
 * Database connection handler - PHP 8 strict singleton
 */
final class Database
{
    private static ?self $instance = null;
    private mysqli $connection;

    private function __construct(
        string $host,
        string $user,
        string $password,
        string $database,
        string $charset = 'utf8mb4'
    ) {
        $this->connection = new mysqli($host, $user, $password, $database);

        if ($this->connection->connect_error) {
            throw new \RuntimeException(
                "Помилка підключення до БД: " . $this->connection->connect_error
            );
        }

        $this->connection->set_charset($charset);
    }

    public static function getInstance(
        string $host = 'localhost',
        string $user = 'root',
        string $password = '',
        string $database = 'college',
        string $charset = 'utf8mb4'
    ): self {
        if (self::$instance === null) {
            self::$instance = new self($host, $user, $password, $database, $charset);
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    private function __clone(): void {}
public function __wakeup(): void 
{
    throw new \Exception("Cannot unserialize singleton");
}
}
