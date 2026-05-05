<?php
/**
 * AdController - Контроллер страницы рекламы (Жарнама)
 */

require_once __DIR__ . '/../../core/Controller.php';

class AdController extends Controller
{
    private $adModel;
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->adModel = $this->model('AdModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    /**
     * Страница "Жарнама"
     */
    public function index()
    {
        $lang = $this->getLang();

        // Получаем ВСЕ активные рекламные баннеры
        $sidebarAds = $this->adModel->getActiveByPosition('sidebar');
        $contentAds = $this->adModel->getActiveByPosition('content_bottom');
        $allAds = array_merge($sidebarAds, $contentAds);

        $categories = $this->categoryModel->getAllCategories($lang);

        $this->view('ad/index', [
            'lang' => $lang,
            'ads' => $allAds,
            'categories' => $categories
        ]);
    }
}
