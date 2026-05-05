<?php
/**
 * VideoController - Контроллер для страницы видеоархива
 */

require_once __DIR__ . '/../../core/Controller.php';

class VideoController extends Controller
{
    private $videoModel;
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->videoModel = $this->model('VideoModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    /**
     * Страница со всеми видео
     */
    public function index()
    {
        $lang = $this->getLang();

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $videos = $this->videoModel->getPaginated($lang, $perPage, $offset);
        $totalVideos = $this->videoModel->countAll();
        $totalPages = ceil($totalVideos / $perPage);

        $categories = $this->categoryModel->getAllCategories($lang);

        $this->view('video/archive', [
            'lang' => $lang,
            'videos' => $videos,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'categories' => $categories,
            'title' => $lang === 'kz' ? 'Бейнежазбалар архиві' : 'Архив видео'
        ]);
    }
}
