<?php
declare(strict_types=1);

namespace App\Modules\Groups\Models;

use App\Core\Model;

/**
 * Group Model - handles all database operations for groups
 * PHP 8 with strict types and proper prepared statements
 */
class GroupModel extends Model
{
    protected string $table = 'st_group';

    /**
     * Find group by name (im)
     */
    public function findByName(string $name): ?array
    {
        return $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE g_im = ? LIMIT 1",
            's',
            [&$name]
        );
    }

    /**
     * Find group by ID
     */
    public function findById(int $id): ?array
    {
        return $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1",
            'i',
            [&$id]
        );
    }

    /**
     * Get all groups
     */
    public function getAll(): array
    {
        return $this->fetchAll("SELECT * FROM {$this->table}");
    }

    /**
     * Update group data
     */
    public function update(
        string $oldName,
        array $data
    ): bool {
        $query = "UPDATE {$this->table} SET
            g_im = ?,
            g_galuz = ?,
            g_spec = ?,
            g_specz = ?,
            g_course = ?,
            g_vipusc = ?,
            g_count_stud = ?,
            g_count_derg = ?,
            g_count_comerc = ?,
            g_nastav = ?,
            g_formnavch = ?
            WHERE g_im = ?";

        $stmt = $this->execute(
            $query,
            'sssssiiiisss',
            [
                &$data['g_im'],
                &$data['g_galuz'],
                &$data['g_spec'],
                &$data['g_specz'],
                &$data['g_course'],
                &$data['g_vipusc'],
                &$data['g_count_stud'],
                &$data['g_count_derg'],
                &$data['g_count_comerc'],
                &$data['g_nastav'],
                &$data['g_formnavch'],
                &$oldName
            ]
        );

        $affected = $this->getAffectedRows();
        $stmt->close();

        return $affected > 0;
    }

    /**
     * Update all students of a group
     */
    public function updateStudents(
        string $oldGroupName,
        array $groupData
    ): bool {
        $query = "UPDATE student SET
            s_group = ?,
            s_galuz = ?,
            s_spec = ?,
            s_specz = ?,
            s_cours = ?,
            s_vip = ?,
            s_form_navch = ?
            WHERE s_group = ?";

        $stmt = $this->execute(
            $query,
            'ssssisss',
            [
                &$groupData['g_im'],
                &$groupData['g_galuz'],
                &$groupData['g_spec'],
                &$groupData['g_specz'],
                &$groupData['g_course'],
                &$groupData['g_vipusc'],
                &$groupData['g_formnavch'],
                &$oldGroupName
            ]
        );

        $affected = $this->getAffectedRows();
        $stmt->close();

        return true;
    }

    /**
     * Check if group name exists
     */
    public function nameExists(string $name, ?string $excludeName = null): bool
    {
        $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE g_im = ?";
        $params = [&$name];
        $types = 's';

        if ($excludeName !== null) {
            $query .= " AND g_im != ?";
            $types .= 's';
            $params[] = &$excludeName;
        }

        $result = $this->fetchOne($query, $types, $params);
        return ($result['count'] ?? 0) > 0;
    }


        /**
        * Create new group
        */
public function create(array $data): bool
    {
        $query = "INSERT INTO {$this->table} (
            g_im,
            g_galuz,
            g_spec,
            g_specz,
            g_course,
            g_vipusc,
            g_count_stud,
            g_count_derg,
            g_count_comerc,
            g_nastav,
            g_formnavch
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // ВИПРАВЛЕНО: Рядок типів змінено на 'ssssssiiiss'
        // (6 рядків 's', 3 числа 'i', 2 рядки 's')
        $stmt = $this->execute(
            $query,
            'ssssssiiiss',
            [
                &$data['g_im'],
                &$data['g_galuz'],
                &$data['g_spec'],
                &$data['g_specz'],
                &$data['g_course'],
                &$data['g_vipusc'],
                &$data['g_count_stud'],
                &$data['g_count_derg'],
                &$data['g_count_comerc'],
                &$data['g_nastav'],
                &$data['g_formnavch']
             ]
        );

        $stmt->close();

        // Оскільки $this->execute() викине помилку (Exception) у разі провалу,
        // якщо код дійшов сюди — значить група 100% успішно додана в базу.
        return true;
    }
}
