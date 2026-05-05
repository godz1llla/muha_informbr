<?php
/**
 * AdminVideoController - Управление видео в админке
 */

namespace admin;

require_once __DIR__ . '/../../../core/Controller.php';
require_once __DIR__ . '/../../helpers/ImageProcessor.php';

class AdminVideoController extends \Controller
{
    private $videoModel;
    private $imageProcessor;

    public function __construct()
    {
        parent::__construct();
        $this->requireAuth();

        $this->videoModel = $this->model('VideoModel');
        $this->imageProcessor = new \ImageProcessor();
    }

    /**
     * Список всех видео
     */
    public function index()
    {
        $videos = $this->videoModel->getAllAdmin();

        $this->view('admin/videos/index', [
            'activeTab' => 'videos',
            'videos' => $videos
        ]);
    }

    /**
     * Форма создания
     */
    public function create()
    {
        $this->view('admin/videos/form', [
            'activeTab' => 'videos',
            'video' => null
        ]);
    }

    /**
     * Форма редактирования
     */
    public function edit($id)
    {
        $video = $this->videoModel->getById($id);
        if (!$video) {
            $_SESSION['error'] = 'Видео не найдено';
            $this->redirect('/admin/videos');
            return;
        }

        $this->view('admin/videos/form', [
            'activeTab' => 'videos',
            'video' => $video
        ]);
    }

    /**
     * Сохранение (создание или обновление)
     */
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/videos');
            return;
        }

        $id = $this->post('id');
        $titleKz = $this->post('title_kz');
        $titleRu = $this->post('title_ru');
        $youtubeUrl = $this->post('youtube_url');
        $publishedAt = $this->post('published_at') ?: date('Y-m-d H:i:s');

        if (empty($titleKz) || empty($youtubeUrl)) {
            $_SESSION['error'] = 'Тақырып пен YouTube сілтемесі міндетті / Заголовок и YouTube ссылка обязательны';
            $this->redirect($id ? "/admin/videos/edit/{$id}" : '/admin/videos/create');
            return;
        }

        // Обработка изображения
        $image = $this->post('current_image');
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                // Если редактируем, удаляем старое фото
                if ($id && !empty($image)) {
                    $this->imageProcessor->delete($image);
                }
                $image = $this->imageProcessor->upload($_FILES['image']);
            } catch (\Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                $this->redirect($id ? "/admin/videos/edit/{$id}" : '/admin/videos/create');
                return;
            }
        }

        if (!$id && empty($image)) {
            $_SESSION['error'] = 'Сурет жүктеу міндетті / Загрузка изображения обязательна';
            $this->redirect('/admin/videos/create');
            return;
        }

        $data = [
            'title_kz' => $titleKz,
            'title_ru' => $titleRu,
            'youtube_url' => $youtubeUrl,
            'image' => $image,
            'published_at' => $publishedAt
        ];

        if ($id) {
            if ($this->videoModel->update($id, $data)) {
                $_SESSION['success'] = 'Видео сәтті жаңартылды / Видео успешно обновлено';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        } else {
            if ($this->videoModel->create($data)) {
                $_SESSION['success'] = 'Видео сәтті қосылды / Видео успешно добавлено';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        }

        $this->redirect('/admin/videos');
    }

    /**
     * Удаление
     */
    public function delete($id)
    {
        $video = $this->videoModel->getById($id);
        if ($video) {
            if (!empty($video['image'])) {
                $this->imageProcessor->delete($video['image']);
            }
            if ($this->videoModel->delete($id)) {
                $_SESSION['success'] = 'Видео сәтті өшірілді / Видео успешно удалено';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        }
        $this->redirect('/admin/videos');
    }
}
