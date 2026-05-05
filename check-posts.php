<?php
// Скрипт для проверки published_at времени постов
require_once __DIR__ . '/core/Database.php';

$db = new Database();

echo "=== Проверка времени публикации постов ===\n\n";
echo "Текущее время сервера: " . date('Y-m-d H:i:s') . "\n\n";

$sql = "SELECT id, title_kz, status, published_at, created_at 
        FROM posts 
        ORDER BY id DESC 
        LIMIT 10";

$posts = $db->fetchAll($sql);

echo "ID | Заголовок | Статус | published_at | created_at\n";
echo str_repeat("-", 100) . "\n";

foreach ($posts as $post) {
    printf(
        "%d | %s | %s | %s | %s\n",
        $post['id'],
        mb_substr($post['title_kz'] ?? 'N/A', 0, 30),
        $post['status'],
        $post['published_at'] ?? 'NULL',
        $post['created_at']
    );
}

echo "\n=== Посты которые ДОЛЖНЫ показываться (published + published_at <= NOW) ===\n";

$sql2 = "SELECT id, title_kz, published_at 
         FROM posts 
         WHERE status = 'published' AND published_at <= NOW()
         ORDER BY published_at DESC
         LIMIT 5";

$visible = $db->fetchAll($sql2);

if (empty($visible)) {
    echo "⚠️ НЕТ ПОСТОВ! Возможно published_at в будущем?\n";
} else {
    foreach ($visible as $post) {
        printf(
            "ID %d: %s (published_at: %s)\n",
            $post['id'],
            mb_substr($post['title_kz'], 0, 40),
            $post['published_at']
        );
    }
}
