<?php
declare(strict_types=1);

namespace App\Modules\Students\Models;

use App\Core\Model;
use DateTime;

/**
 * Student Model - handles all database operations for students
 * PHP 8 with strict types and proper prepared statements
 */
class StudentModel extends Model
{
    protected string $table = 'student';

    /**
     * Find student by ID
     */
    public function findById(int $id): ?array
    {
        return $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE s_id = ? LIMIT 1",
            'i',
            [&$id]
        );
    }

    public function findByGroup(string $groupName): array
    {
        return $this->fetchAll(
            "SELECT * FROM {$this->table} WHERE s_group = ?",
            's',
            [&$groupName]
        );
    }

    /**
     * Get group data by group name
     */
    public function getGroupByName(string $groupName): ?array
    {
        return $this->fetchOne(
            "SELECT g_galuz, g_spec, g_specz, g_formnavch, g_course 
             FROM st_group WHERE g_im = ? LIMIT 1",
            's',
            [&$groupName]
        );
    }

    /**
     * Calculate age from birth date
     */
    public static function calculateAge(string $birthDate): ?int
    {
        try {
            $birthday = new DateTime($birthDate);
            $today = new DateTime();
            $interval = $birthday->diff($today);
            return (int) $interval->y;
        } catch (\Exception) {
            return null;
        }
    }

    /**
     * Convert checkbox value to 'Так' or 'Ні'
     */
    public static function boolToYesNo(bool $value): string
    {
        return $value ? 'Так' : 'Ні';
    }

    /**
     * Update student data
     */
    public function update(int $id, array $data): bool
    {
        $query = "UPDATE {$this->table} SET
            s_group = ?,
            s_pr = ?,
            s_im = ?,
            s_bat = ?,
            s_stat = ?,
            s_contract = ?,
            s_dnar = ?,
            s_vik = ?,
            s_adresa = ?,
            s_tels = ?,
            s_telb = ?,
            s_telm = ?,
            s_osvita_type = ?,
            s_rik_zaver = ?,
            s_region_type = ?,
            s_region = ?,
            s_galuz = ?,
            s_spec = ?,
            s_specz = ?,
            s_sirota = ?,
            s_peresel = ?,
            s_inval = ?,
            s_malozab = ?,
            s_war_act = ?,
            s_chernob = ?,
            s_ato = ?,
            s_ditzag = ?,
            s_rada = ?,
            s_shahter = ?,
            s_vip = ?,
            s_cours = ?,
            s_form_navch = ?
            WHERE s_id = ?";

        // Ensure all array keys exist and are set
        $keys = ['s_group', 's_pr', 's_im', 's_bat', 's_stat', 's_contract', 
                 's_dnar', 's_vik', 's_adresa', 's_tels', 's_telb', 's_telm',
                 's_osvita_type', 's_rik_zaver', 's_region_type', 's_region',
                 's_galuz', 's_spec', 's_specz', 's_sirota', 's_peresel', 's_inval',
                 's_malozab', 's_war_act', 's_chernob', 's_ato', 's_ditzag',
                 's_rada', 's_shahter', 's_vip', 's_cours', 's_form_navch'];
        
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                $data[$key] = null;
            }
        }

        $stmt = $this->execute(
            $query,
            'sssssssissssssssssssssssssssssisi',
            [
                &$data['s_group'],
                &$data['s_pr'],
                &$data['s_im'],
                &$data['s_bat'],
                &$data['s_stat'],
                &$data['s_contract'],
                &$data['s_dnar'],
                &$data['s_vik'],
                &$data['s_adresa'],
                &$data['s_tels'],
                &$data['s_telb'],
                &$data['s_telm'],
                &$data['s_osvita_type'],
                &$data['s_rik_zaver'],
                &$data['s_region_type'],
                &$data['s_region'],
                &$data['s_galuz'],
                &$data['s_spec'],
                &$data['s_specz'],
                &$data['s_sirota'],
                &$data['s_peresel'],
                &$data['s_inval'],
                &$data['s_malozab'],
                &$data['s_war_act'],
                &$data['s_chernob'],
                &$data['s_ato'],
                &$data['s_ditzag'],
                &$data['s_rada'],
                &$data['s_shahter'],
                &$data['s_vip'],
                &$data['s_cours'],
                &$data['s_form_navch'],
                &$id
            ]
        );

        $affected = $this->getAffectedRows();
        $stmt->close();

        return $affected > 0;
    }

    /**
     * Get all students by group
     */
    public function getByGroup(string $groupName): array
    {
        return $this->fetchAll(
            "SELECT * FROM {$this->table} WHERE s_group = ?",
            's',
            [&$groupName]
        );
    }

    /**
     * Check if student exists
     */
    public function exists(int $id): bool
    {
        $student = $this->fetchOne(
            "SELECT s_id FROM {$this->table} WHERE s_id = ? LIMIT 1",
            'i',
            [&$id]
        );
        return $student !== null;
    }

    /**
     * Create new student
     */
    public function create(array $data): int
    {
        $query = "INSERT INTO {$this->table} (
            s_group, s_pr, s_im, s_bat, s_stat, s_contract, s_dnar, s_vik,
            s_adresa, s_tels, s_telb, s_telm, s_osvita_type, s_rik_zaver,
            s_region_type, s_region, s_galuz, s_spec, s_specz, s_sirota, 
            s_peresel, s_inval, s_malozab, s_war_act, s_chernob, s_ato, 
            s_ditzag, s_rada, s_shahter, s_vip, s_cours, s_form_navch
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

        $stmt = $this->execute(
            $query,
            'sssssssissssssssssssssssssssssis',
            [
                &$data['s_group'],
                &$data['s_pr'],
                &$data['s_im'],
                &$data['s_bat'],
                &$data['s_stat'],
                &$data['s_contract'],
                &$data['s_dnar'],
                &$data['s_vik'],
                &$data['s_adresa'],
                &$data['s_tels'],
                &$data['s_telb'],
                &$data['s_telm'],
                &$data['s_osvita_type'],
                &$data['s_rik_zaver'],
                &$data['s_region_type'],
                &$data['s_region'],
                &$data['s_galuz'],
                &$data['s_spec'],
                &$data['s_specz'],
                &$data['s_sirota'],
                &$data['s_peresel'],
                &$data['s_inval'],
                &$data['s_malozab'],
                &$data['s_war_act'],
                &$data['s_chernob'],
                &$data['s_ato'],
                &$data['s_ditzag'],
                &$data['s_rada'],
                &$data['s_shahter'],
                &$data['s_vip'],
                &$data['s_cours'],
                &$data['s_form_navch']
            ]
        );

        $lastId = $this->getLastInsertId();
        $stmt->close();

        return $lastId;
    }

    /**
     * Filter students based on various criteria with pagination
     */
    public function filter(array $filters, string|int $limit, int $offset, &$total): array
    {
        $whereClauses = [];
        $params = [];
        $types = '';

        // PIB
        if (!empty($filters['s_pib'])) {
            $pib = '%' . $filters['s_pib'] . '%';
            $whereClauses[] = "CONCAT(s_pr, ' ', s_im, ' ', s_bat) LIKE ?";
            $params[] = $pib;
            $types .= 's';
        }

        // Contract type
        $vz_values = [];
        if (!empty($filters['check_vz0'])) $vz_values[] = $filters['check_vz0'];
        if (!empty($filters['check_vz1'])) $vz_values[] = $filters['check_vz1'];
        if (!empty($vz_values)) {
            $placeholders = implode(',', array_fill(0, count($vz_values), '?'));
            $whereClauses[] = "s_contract IN ($placeholders)";
            foreach ($vz_values as $value) {
                $params[] = $value;
                $types .= 's';
            }
        }

        // Fields of knowledge
        if (!empty($filters['check_gz']) && is_array($filters['check_gz'])) {
            $placeholders = implode(',', array_fill(0, count($filters['check_gz']), '?'));
            $whereClauses[] = "s_galuz IN ($placeholders)";
            foreach ($filters['check_gz'] as $value) {
                $params[] = $value;
                $types .= 's';
            }
        }

        // Specialties
        if (!empty($filters['check_sp']) && is_array($filters['check_sp'])) {
            $placeholders = implode(',', array_fill(0, count($filters['check_sp']), '?'));
            $whereClauses[] = "s_spec IN ($placeholders)";
            foreach ($filters['check_sp'] as $value) {
                $params[] = $value;
                $types .= 's';
            }
        }

        // Courses
        $courses = [];
        if (!empty($filters['check_kurs1'])) $courses[] = '1';
        if (!empty($filters['check_kurs2'])) $courses[] = '2';
        if (!empty($filters['check_kurs3'])) $courses[] = '3';
        if (!empty($filters['check_kurs4'])) $courses[] = '4';
        if (!empty($courses)) {
            $placeholders = implode(',', array_fill(0, count($courses), '?'));
            $whereClauses[] = "s_cours IN ($placeholders)";
            foreach ($courses as $value) {
                $params[] = $value;
                $types .= 's';
            }
        }

        // Graduation group
        if (!empty($filters['check_vg'])) {
            $whereClauses[] = "s_vip = ?";
            $params[] = 'Так';
            $types .= 's';
        }

        // Gender
        $genders = [];
        if (!empty($filters['check_men'])) $genders[] = 'Чоловік';
        if (!empty($filters['check_women'])) $genders[] = 'Жінка';
        if (!empty($genders)) {
            $placeholders = implode(',', array_fill(0, count($genders), '?'));
            $whereClauses[] = "s_stat IN ($placeholders)";
            foreach ($genders as $value) {
                $params[] = $value;
                $types .= 's';
            }
        }

        // Age range
        if (!empty($filters['vik_from']) && !empty($filters['vik_to'])) {
            $whereClauses[] = "s_vik BETWEEN ? AND ?";
            $params[] = (int)$filters['vik_from'];
            $params[] = (int)$filters['vik_to'];
            $types .= 'ii';
        } elseif (!empty($filters['vik_from'])) {
            $whereClauses[] = "s_vik >= ?";
            $params[] = (int)$filters['vik_from'];
            $types .= 'i';
        } elseif (!empty($filters['vik_to'])) {
            $whereClauses[] = "s_vik <= ?";
            $params[] = (int)$filters['vik_to'];
            $types .= 'i';
        }

        // Group
        if (!empty($filters['form_group'])) {
            $whereClauses[] = "s_group = ?";
            $params[] = $filters['form_group'];
            $types .= 's';
        }

        // Social categories (using OR logic)
        $social_conditions = [];
        if (!empty($filters['check_sirot'])) $social_conditions[] = "s_sirota = 'Так'";
        if (!empty($filters['check_peres'])) $social_conditions[] = "s_peresel = 'Так'";
        if (!empty($filters['check_chernob'])) $social_conditions[] = "s_chernob = 'Так'";
        if (!empty($filters['check_ivalid'])) $social_conditions[] = "s_inval = 'Так'";
        if (!empty($filters['check_malozab'])) $social_conditions[] = "s_malozab = 'Так'";
        if (!empty($filters['check_ato'])) $social_conditions[] = "s_ato = 'Так'";
        if (!empty($filters['check_uchbd'])) $social_conditions[] = "s_war_act = 'Так'";
        if (!empty($filters['check_ditzag'])) $social_conditions[] = "s_ditzag = 'Так'";
        if (!empty($filters['check_stepver'])) $social_conditions[] = "s_rada = 'Так'";
        if (!empty($filters['check_shaht'])) $social_conditions[] = "s_shahter = 'Так'";
        if (!empty($social_conditions)) {
            $whereClauses[] = "(" . implode(" OR ", $social_conditions) . ")";
        }

        $whereSql = empty($whereClauses) ? '' : 'WHERE ' . implode(' AND ', $whereClauses);

        // Get total count
        $countQuery = "SELECT COUNT(*) as total FROM {$this->table} {$whereSql}";
        $countResult = $this->fetchOne($countQuery, $types, $params);
        $total = $countResult['total'] ?? 0;

        // Sorting
        $sort_by = $filters['sort_by'] ?? 's_pr';
        $sort_dir = strtoupper($filters['sort_dir'] ?? 'ASC');
        $allowed_sorts = ['s_pr', 's_group', 's_cours', 's_dnar'];
        $order_clause = in_array($sort_by, $allowed_sorts) ? "ORDER BY {$sort_by} COLLATE utf8_unicode_ci {$sort_dir}" : "ORDER BY s_pr ASC";

        // Pagination
        $limitSql = '';
        if ($limit !== 'all') {
            $limitSql = "LIMIT ?, ?";
            $params[] = $offset;
            $params[] = (int)$limit;
            $types .= 'ii';
        }

        $dataQuery = "SELECT * FROM {$this->table} {$whereSql} {$order_clause} {$limitSql}";

        return $this->fetchAll($dataQuery, $types, $params);
    }
}
