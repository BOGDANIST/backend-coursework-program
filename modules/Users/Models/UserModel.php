<?php
declare(strict_types=1);

namespace App\Modules\Users\Models;

use App\Core\Model;

/**
 * User Model - handles all database operations for users
 * PHP 8 with strict types and proper prepared statements
 * Supports role mapping: user(1), viewer(8), editor(9), admin(10)
 */
class UserModel extends Model
{
    protected string $table = 'users';

    /**
     * Role to status code mapping
     */
    private const ROLE_STATUS_MAP = [
        'user' => '1',
        'viewer' => '8',
        'editor' => '9',
        'admin' => '10'
    ];

    /**
     * Status to role mapping (inverse)
     */
    private const STATUS_ROLE_MAP = [
        '1' => 'user',
        '8' => 'viewer',
        '9' => 'editor',
        '10' => 'admin'
    ];

    /**
     * Find user by ID
     */
    public function findById(int $id): ?array
    {
        return $this->fetchOne(
            "SELECT user_id, login, status FROM {$this->table} WHERE user_id = ? LIMIT 1",
            'i',
            [&$id]
        );
    }

    /**
     * Find user by login
     */
    public function findByLogin(string $login): ?array
    {
        return $this->fetchOne(
            "SELECT user_id, login, password, status FROM {$this->table} WHERE login = ? LIMIT 1",
            's',
            [&$login]
        );
    }

    /**
     * Get all users
     */
    public function getAll(): array
    {
        return $this->fetchAll(
            "SELECT user_id, login, status FROM {$this->table} ORDER BY user_id"
        );
    }

    public function create(string $login, string $passwordHash, string $status): int
    {
        $query = "INSERT INTO {$this->table} (login, password, status) VALUES (?, ?, ?)";

        $stmt = $this->execute(
            $query,
            'sss',
            [&$login, &$passwordHash, &$status]
        );

        $insertedId = $stmt->insert_id;
        $stmt->close();

        return $insertedId;
    }

    /**
     * Convert role name to status code
     * @throws \InvalidArgumentException
     */
    public static function roleToStatus(string $role): string
    {
        if (!isset(self::ROLE_STATUS_MAP[$role])) {
            throw new \InvalidArgumentException(
                "Невідома роль: {$role}. Доступні: " . implode(', ', array_keys(self::ROLE_STATUS_MAP))
            );
        }
        return self::ROLE_STATUS_MAP[$role];
    }

    /**
     * Convert status code to role name
     */
    public static function statusToRole(string $status): string
    {
        return self::STATUS_ROLE_MAP[$status] ?? 'user';
    }

    /**
     * Hash password using MD5 (legacy - consider using bcrypt in production)
     * 
     * @deprecated Use bcrypt instead: password_hash($password, PASSWORD_BCRYPT)
     */
    public static function hashPassword(string $password): string
    {
        // Using MD5 for backward compatibility with existing database
        // In production, consider migrating to bcrypt: password_hash($password, PASSWORD_BCRYPT)
        return md5($password);
    }

    /**
     * Update user password and status
     */
    /**
     * Update user password and status
     */
    public function updateWithPassword(int $id, string $passwordHash, string $status): bool
    {
        $query = "UPDATE {$this->table} SET password = ?, status = ? WHERE user_id = ?";

        $stmt = $this->execute(
            $query,
            'ssi',
            [&$passwordHash, &$status, &$id]
        );

        $stmt->close();

        // Якщо код дійшов сюди без помилок від $this->execute(), значить все добре
        return true; 
    }

    /**
     * Update user status only
     */
    public function updateStatus(int $id, string $status): bool
    {
        $query = "UPDATE {$this->table} SET status = ? WHERE user_id = ?";

        $stmt = $this->execute(
            $query,
            'si',
            [&$status, &$id]
        );

        $stmt->close();

        // Жодних $affected > 0 або повторних execute()
        return true;
    }

    /**
     * Check if user exists
     */
    public function exists(int $id): bool
    {
        $result = $this->fetchOne(
            "SELECT COUNT(*) as count FROM {$this->table} WHERE user_id = ?",
            'i',
            [&$id]
        );
        return ($result['count'] ?? 0) > 0;
    }

    /**
     * Check if login already exists (for another user)
     */
    public function loginExists(string $login, ?int $excludeId = null): bool
    {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE login = ?";
        $params = [&$login];
        $types = 's';

        if ($excludeId !== null) {
            $query .= " AND user_id != ?";
            $excludeIdRef = &$excludeId;
            $params[] = $excludeIdRef;
            $types .= 'i';
        }

        $result = $this->fetchOne($query, $types, $params);
        return ($result['count'] ?? 0) > 0;
    }
}
