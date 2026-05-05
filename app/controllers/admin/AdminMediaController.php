<?php
/**
 * AdminMediaController - Управление медиа-файлами
 */

namespace admin;

require_once __DIR__ . '/../../../core/Controller.php';

class AdminMediaController extends \Controller
{
    private $uploadDir;

    public function __construct()
    {
        parent::__construct();

        // Проверка авторизации
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->redirect('/admin/login');
            exit;
        }

        $this->uploadDir = __DIR__ . '/../../../public/uploads';
    }

    /**
     * Главная страница медиа-галереи
     */
    public function index()
    {
        // Получаем все загруженные файлы
        $files = $this->scanMediaFiles();

        $this->view('admin/media', [
            'files' => $files,
            'activeTab' => 'media'
        ]);
    }

    /**
     * Загрузка нового файла
     */
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/media');
            return;
        }

        if (!isset($_FILES['media_file']) || $_FILES['media_file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = 'Ошибка загрузки файла';
            $this->redirect('/admin/media');
            return;
        }

        try {
            // Используем ImageProcessor для обработки
            require_once __DIR__ . '/../../helpers/ImageProcessor.php';
            $processor = new \ImageProcessor();

            $uploadedFile = $_FILES['media_file'];
            $filename = $processor->upload($uploadedFile);

            $_SESSION['success'] = 'Файл успешно загружен: ' . $filename;
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Ошибка: ' . $e->getMessage();
        }

        $this->redirect('/admin/media');
    }

    /**
     * Удаление файла
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Неверный метод запроса';
            $this->redirect('/admin/media');
            return;
        }

        $filename = $_POST['filename'] ?? null;

        if (!$filename) {
            $_SESSION['error'] = 'Файл не указан';
            $this->redirect('/admin/media');
            return;
        }

        // Удаляем все версии (original, large, medium, thumbnail)
        $sizes = ['original', 'large', 'medium', 'thumbnail'];
        $deleted = 0;

        foreach ($sizes as $size) {
            $filepath = $this->uploadDir . '/' . $size . '/' . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
                $deleted++;
            }
        }

        if ($deleted > 0) {
            $_SESSION['success'] = 'Файл удален (' . $deleted . ' версий)';
        } else {
            $_SESSION['error'] = 'Файл не найден';
        }

        $this->redirect('/admin/media');
    }

    /**
     * Сканирование медиа-файлов
     */
    private function scanMediaFiles()
    {
        $files = [];
        $originalDir = $this->uploadDir . '/original';

        if (!is_dir($originalDir)) {
            return $files;
        }

        $items = scandir($originalDir);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $filepath = $originalDir . '/' . $item;

            if (is_file($filepath)) {
                $files[] = [
                    'filename' => $item,
                    'size' => filesize($filepath),
                    'date' => filemtime($filepath),
                    'type' => mime_content_type($filepath),
                    'url_thumbnail' => '/uploads/thumbnail/' . $item,
                    'url_medium' => '/uploads/medium/' . $item,
                    'url_large' => '/uploads/large/' . $item,
                    'url_original' => '/uploads/original/' . $item
                ];
            }
        }

        // Сортировка по дате (новые первые)
        usort($files, function ($a, $b) {
            return $b['date'] - $a['date'];
        });

        return $files;
    }

    /**
     * Форматирование размера файла
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
