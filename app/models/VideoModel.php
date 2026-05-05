<?php
/**
 * VideoModel - Модель для работы с видео
 */

require_once __DIR__ . '/../../core/Model.php';

class VideoModel extends Model
{
    protected $table = 'videos';

    /**
     * Получить последние видео
     */
    public function getLatest($lang, $limit = 6)
    {
        $sql = "SELECT id, 
                       title_kz, 
                       title_ru, 
                       youtube_url, 
                       image, 
                       published_at
                FROM {$this->table}
                ORDER BY published_at DESC
                LIMIT {$limit}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Получить видео с пагинацией
     */
    public function getPaginated($lang, $limit = 12, $offset = 0)
    {
        $sql = "SELECT id, 
                       title_kz, 
                       title_ru, 
                       youtube_url, 
                       image, 
                       published_at
                FROM {$this->table}
                ORDER BY published_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Подсчитать общее количество видео
     */
    public function countAll()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $result = $this->db->fetchOne($sql);
        return (int) ($result['count'] ?? 0);
    }

    /**
     * Получить видео по ID
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * Получить все видео (для админки)
     */
    public function getAllAdmin()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY published_at DESC";
        return $this->db->fetchAll($sql);
    }

    /**
     * Создать запись (Alias для insert)
     */
    public function create($data)
    {
        return $this->insert($data);
    }
}
