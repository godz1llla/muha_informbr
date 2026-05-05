<?php
/**
 * PostModel - Модель для работы с постами/новостями
 */

require_once __DIR__ . '/../../core/Model.php';

class PostModel extends Model
{
    protected $table = 'posts';

    /**
     * Получить опубликованные посты с пагинацией
     */
    public function getPublished($lang, $limit = 15, $offset = 0)
    {
        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE p.status = 'published' AND p.published_at <= NOW()
                ORDER BY p.published_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Получить избранную новость (hero)
     */
    public function getFeatured($lang)
    {
        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE p.status = 'published' AND p.is_featured = 1 AND p.published_at <= NOW()
                ORDER BY p.published_at DESC
                LIMIT 1";

        return $this->db->fetchOne($sql);
    }

    /**
     * Получить анонсы
     */
    public function getAnnouncements($lang, $limit = 5)
    {
        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.status = 'published' AND p.is_announcement = 1 AND p.published_at <= NOW()
                ORDER BY p.published_at DESC
                LIMIT {$limit}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Получить пост по slug
     */
    public function getBySlug($slug, $lang)
    {
        $slugColumn = "slug_{$lang}";

        $sql = "SELECT p.*, 
                       p.slug_kz, p.slug_ru,
                       c.name_{$lang} as category_name, 
                       c.slug_{$lang} as category_slug,
                       c.slug_kz as category_slug_kz,
                       c.slug_ru as category_slug_ru,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE p.{$slugColumn} = ? AND p.status = 'published'
                LIMIT 1";

        return $this->db->fetchOne($sql, [$slug]);
    }

    /**
     * Получить популярные посты
     */
    public function getPopular($lang, $limit = 10)
    {
        $sql = "SELECT p.*, c.name_{$lang} as category_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.status = 'published' AND p.published_at <= NOW()
                ORDER BY p.views DESC
                LIMIT {$limit}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Получить посты по категории
     */
    public function getByCategory($categorySlug, $lang, $limit = 15, $offset = 0)
    {
        $slugColumn = "c.slug_{$lang}";

        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE {$slugColumn} = ? AND p.status = 'published' AND p.published_at <= NOW()
                ORDER BY p.published_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql, [$categorySlug]);
    }

    /**
     * Увеличить счетчик просмотров
     */
    public function incrementViews($id)
    {
        $sql = "UPDATE {$this->table} SET views = views + 1 WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }

    /**
     * Получить последние посты для админки
     */
    public function getLatestForAdmin($limit = 10)
    {
        $sql = "SELECT p.*, c.name_kz as category_name, u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Создать новый пост
     */
    public function createPost($data)
    {
        // Проверка и генерация slug если не указан
        if (empty($data['slug_kz']) && !empty($data['title_kz'])) {
            $slugGenerator = new SlugGenerator();
            $data['slug_kz'] = $slugGenerator->generate($data['title_kz'], 'kz');
        }

        if (empty($data['slug_ru']) && !empty($data['title_ru'])) {
            $slugGenerator = new SlugGenerator();
            $data['slug_ru'] = $slugGenerator->generate($data['title_ru'], 'ru');
        }

        // Дата публикации по умолчанию - сейчас
        if (empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        return $this->insert($data);
    }

    /**
     * Генерировать slug из заголовка
     */
    private function generateSlug($title, $lang)
    {
        require_once __DIR__ . '/../helpers/SlugGenerator.php';
        $generator = new SlugGenerator();
        return $generator->generate($title, $lang);
    }

    /**
     * Генерировать excerpt из контента
     */
    private function generateExcerpt($content, $length = 200)
    {
        $text = strip_tags($content);
        if (mb_strlen($text) > $length) {
            return mb_substr($text, 0, $length) . '...';
        }
        return $text;
    }

    /**
     * Подсчитать все опубликованные посты
     */
    public function countPublished()
    {
        return $this->count("status = 'published'");
    }

    /**
     * Подсчитать просмотры за сегодня
     */
    public function getTodayViews()
    {
        $sql = "SELECT SUM(views) as total_views 
                FROM {$this->table} 
                WHERE DATE(published_at) = CURDATE()";

        $result = $this->db->fetchOne($sql);
        return $result['total_views'] ?? 0;
    }

    /**
     * Получить все посты для админки (включая черновики) с пагинацией
     */
    public function getAllForAdmin($limit = 20, $offset = 0)
    {
        $sql = "SELECT p.*, c.name_kz as category_name, u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                ORDER BY p.created_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql);
    }

    /**
     * Поиск по новостям
     */
    public function search($query, $lang, $limit = 20, $offset = 0)
    {
        $searchTerm = '%' . $query . '%';

        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE p.status = 'published' 
                  AND p.published_at <= NOW()
                  AND (
                      p.title_{$lang} LIKE ? OR
                      p.content_{$lang} LIKE ? OR
                      p.excerpt_{$lang} LIKE ?
                  )
                ORDER BY p.published_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql, [$searchTerm, $searchTerm, $searchTerm]);
    }

    /**
     * Подсчет результатов поиска
     */
    public function searchCount($query, $lang)
    {
        $searchTerm = '%' . $query . '%';

        $sql = "SELECT COUNT(*) as count
                FROM {$this->table}
                WHERE status = 'published' 
                  AND published_at <= NOW()
                  AND (
                      title_{$lang} LIKE ? OR
                      content_{$lang} LIKE ? OR
                      excerpt_{$lang} LIKE ?
                  )";

        $result = $this->db->fetchOne($sql, [$searchTerm, $searchTerm, $searchTerm]);
        return (int) ($result['count'] ?? 0);
    }

    /**
     * Получить новости за конкретную дату
     */
    public function getByDate($date, $lang, $limit = 20, $offset = 0)
    {
        $sql = "SELECT p.*, c.name_{$lang} as category_name, c.slug_{$lang} as category_slug,
                       u.full_name as author_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN users u ON p.user_id = u.id
                WHERE p.status = 'published' 
                  AND DATE(p.published_at) = ?
                  AND p.published_at <= NOW()
                ORDER BY p.published_at DESC
                LIMIT {$limit} OFFSET {$offset}";

        return $this->db->fetchAll($sql, [$date]);
    }

    /**
     * Подсчитать новости за конкретную дату
     */
    public function countByDate($date)
    {
        $sql = "SELECT COUNT(*) as count
                FROM {$this->table}
                WHERE status = 'published' 
                  AND DATE(published_at) = ?
                  AND published_at <= NOW()";

        $result = $this->db->fetchOne($sql, [$date]);
        return (int) ($result['count'] ?? 0);
    }

    /**
     * Получить дни месяца, в которые были опубликованы новости
     */
    public function getDatesWithNews($month, $year)
    {
        $sql = "SELECT DISTINCT DAY(published_at) as day
                FROM {$this->table}
                WHERE status = 'published'
                  AND MONTH(published_at) = ?
                  AND YEAR(published_at) = ?
                  AND published_at <= NOW()";

        $results = $this->db->fetchAll($sql, [$month, $year]);
        return array_column($results, 'day');
    }
}
