<?php
/**
 * AdModel - Модель для работы с рекламой
 */

require_once __DIR__ . '/../../core/Model.php';

class AdModel extends Model
{
    protected $table = 'ads';

    /**
     * Получить запись по ID (Alias для find)
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * Получить активную рекламу по позиции
     */
    public function getActiveByPosition($position)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE position = ? AND status = 'active' 
                ORDER BY created_at DESC";
        return $this->db->fetchAll($sql, [$position]);
    }

    /**
     * Получить все записи (для админки)
     */
    public function getAllAdmin()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->db->fetchAll($sql);
    }

    /**
     * Создать запись
     */
    public function create($data)
    {
        return $this->insert($data);
    }
}
