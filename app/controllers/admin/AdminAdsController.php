<?php
/**
 * AdminAdsController - Управление рекламой в админке
 */

namespace admin;

require_once __DIR__ . '/../../../core/Controller.php';
require_once __DIR__ . '/../../helpers/ImageProcessor.php';

class AdminAdsController extends \Controller
{
    private $adModel;
    private $imageProcessor;

    public function __construct()
    {
        parent::__construct();
        $this->requireAuth();

        $this->adModel = $this->model('AdModel');
        $this->imageProcessor = new \ImageProcessor();
    }

    /**
     * Список всей рекламы
     */
    public function index()
    {
        $ads = $this->adModel->getAllAdmin();

        $this->view('admin/ads/index', [
            'activeTab' => 'ads',
            'ads' => $ads
        ]);
    }

    /**
     * Форма создания
     */
    public function create()
    {
        $this->view('admin/ads/form', [
            'activeTab' => 'ads',
            'ad' => null
        ]);
    }

    /**
     * Форма редактирования
     */
    public function edit($id)
    {
        $ad = $this->adModel->getById($id);
        if (!$ad) {
            $_SESSION['error'] = 'Реклама не найдена';
            $this->redirect('/admin/ads');
            return;
        }

        $this->view('admin/ads/form', [
            'activeTab' => 'ads',
            'ad' => $ad
        ]);
    }

    /**
     * Сохранение
     */
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/ads');
            return;
        }

        $id = $this->post('id');
        $title = $this->post('title');
        $link = $this->post('link');
        $position = $this->post('position');
        $status = $this->post('status') ?: 'active';

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
                $this->redirect($id ? "/admin/ads/edit/{$id}" : '/admin/ads/create');
                return;
            }
        }

        if (!$id && empty($image)) {
            $_SESSION['error'] = 'Рекламный баннер (сурет) міндетті / Загрузка баннера обязательна';
            $this->redirect('/admin/ads/create');
            return;
        }

        $data = [
            'title' => $title,
            'link' => $link,
            'position' => $position,
            'status' => $status,
            'image' => $image
        ];

        if ($id) {
            if ($this->adModel->update($id, $data)) {
                $_SESSION['success'] = 'Жарнама сәтті жаңартылды / Реклама успешно обновлена';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        } else {
            if ($this->adModel->create($data)) {
                $_SESSION['success'] = 'Жарнама сәтті қосылды / Реклама успешно добавлена';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        }

        $this->redirect('/admin/ads');
    }

    /**
     * Удаление
     */
    public function delete($id)
    {
        $ad = $this->adModel->getById($id);
        if ($ad) {
            if (!empty($ad['image'])) {
                $this->imageProcessor->delete($ad['image']);
            }
            if ($this->adModel->delete($id)) {
                $_SESSION['success'] = 'Жарнама сәтті өшірілді / Реклама успешно удалена';
            } else {
                $_SESSION['error'] = 'Қате орын алды / Произошла ошибка';
            }
        }
        $this->redirect('/admin/ads');
    }
}
