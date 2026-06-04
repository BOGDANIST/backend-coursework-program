<?php
declare(strict_types=1);

namespace App\Core;

use mysqli;
use mysqli_stmt;

/**
 * Base Model class for all database models
 * Provides common database operations with prepared statements
 */
abstract class Model
{
    protected mysqli $db;
    protected string $table = '';

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Execute a prepared statement safely
     */
    protected function execute(
        string $query,
        string $types,
        array $params = []
    ): mysqli_stmt|false {
        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            throw new \RuntimeException(
                "Помилка підготовки запиту: " . $this->db->error
            );
        }

        if (!empty($params)) {
            // Ensure types and params match
            if (strlen($types) !== count($params)) {
                throw new \RuntimeException(
                    "Помилка bind_param: кількість типів (" . strlen($types) . 
                    ") не збігається з кількістю параметрів (" . count($params) . ")"
                );
            }

            // Convert null values for integer types to appropriate value
            $i = 0;
            foreach ($params as &$param) {
                if ($i < strlen($types)) {
                    $type = $types[$i];
                    if ($type === 'i' && $param === null) {
                        $param = 0; // Convert null to 0 for integer fields
                    } elseif ($type === 'd' && $param === null) {
                        $param = 0.0; // Convert null to 0.0 for double fields
                    }
                }
                $i++;
            }

            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new \RuntimeException(
                "Помилка виконання запиту: " . $stmt->error
            );
        }

        return $stmt;
    }

    /**
     * Fetch one row as associative array
     */
    protected function fetchOne(
        string $query,
        string $types = '',
        array $params = []
    ): ?array {
        $stmt = $this->execute($query, $types, $params);
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }

    /**
     * Fetch all rows as associative array
     */
    protected function fetchAll(
        string $query,
        string $types = '',
        array $params = []
    ): array {
        $stmt = $this->execute($query, $types, $params);
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get number of affected rows from last operation
     */
    protected function getAffectedRows(): int
    {
        return $this->db->affected_rows;
    }

    /**
     * Get last insert ID
     */
    protected function getLastInsertId(): int
    {
        return (int) $this->db->insert_id;
    }
}
