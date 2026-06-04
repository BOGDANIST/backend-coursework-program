<?php
declare(strict_types=1);

namespace App\Modules\Specialties\Models;

use App\Core\Model;

class SpecialtyModel extends Model
{
    protected string $table = 'spec';

    /**
     * Знайти спеціальність за її ID (id_sp)
     */
    public function findById(string $idSp): ?array
    {
        return $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE id_sp = ? LIMIT 1",
            's',
            [$idSp]
        );
    }

    /**
     * Отримати всі спеціальності
     */
    public function getAll(): array
    {
        return $this->fetchAll("SELECT * FROM {$this->table} ORDER BY im_galuz ASC, id_spec ASC");
    }

    /**
     * Створити нову спеціальність
     */
    public function create(array $data): bool
    {
        $query = "INSERT INTO {$this->table} (
            id_sp, id_galuz, im_galuz, id_spec, im_spec, im_specializ
        ) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->execute(
            $query,
            'ssssss',
            [
                $data['id_sp'] ?? '',
                $data['id_galuz'] ?? '',
                $data['im_galuz'] ?? '',
                $data['id_spec'] ?? '',
                $data['im_spec'] ?? '',
                $data['im_specializ'] ?? ''
            ]
        );
        
        return $stmt !== false;
    }

    /**
     * Оновити існуючу спеціальність
     */
    public function update(string $idSp, array $data): bool
    {
        $query = "UPDATE {$this->table} SET 
            id_galuz = ?, im_galuz = ?, id_spec = ?, im_spec = ?, im_specializ = ? 
            WHERE id_sp = ?";
            
        $stmt = $this->execute(
            $query,
            'ssssss',
            [
                $data['id_galuz'] ?? '',
                $data['im_galuz'] ?? '',
                $data['id_spec'] ?? '',
                $data['im_spec'] ?? '',
                $data['im_specializ'] ?? '',
                $idSp
            ]
        );
        
        return $stmt !== false;
    }

    /**
     * Видалити спеціальність
     */
    public function delete(string $idSp): bool
    {
        $stmt = $this->execute(
            "DELETE FROM {$this->table} WHERE id_sp = ?",
            's',
            [$idSp]
        );
        
        return $stmt !== false;
    }
}