<?php
/**
 * SearchController - Контроллер поиска по новостям
 */

require_once __DIR__ . '/../../core/Controller.php';

class SearchController extends Controller
{
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = $this->model('PostModel');
    }

    /**
     * Страница результатов поиска
     */
    public function index()
    {
        $lang = $this->getLang();
        $query = $_GET['q'] ?? '';

        // Пагинация
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        // Если есть дата, ищем по дате
        $date = $_GET['date'] ?? null;
        if ($date && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            $results = $this->postModel->getByDate($date, $lang, $perPage, $offset);
            $totalResults = $this->postModel->countByDate($date);
            $queryDisplay = date('d.m.Y', strtotime($date));
        } else {
            // Иначе - обычный поиск
            if (mb_strlen($query, 'UTF-8') < 3) {
                $this->view('search/results', [
                    'lang' => $lang,
                    'query' => $query,
                    'results' => [],
                    'totalResults' => 0,
                    'error' => $lang === 'kz'
                        ? 'Іздеу үшін кем дегенде 3 таңба енгізіңіз'
                        : 'Введите минимум 3 символа для поиска'
                ]);
                return;
            }
            $results = $this->postModel->search($query, $lang, $perPage, $offset);
            $totalResults = $this->postModel->searchCount($query, $lang);
            $queryDisplay = $query;
        }

        // Вычисляем общее количество страниц
        $totalPages = ceil($totalResults / $perPage);

        $this->view('search/results', [
            'lang' => $lang,
            'query' => $queryDisplay,
            'results' => $results,
            'totalResults' => $totalResults,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'searchDate' => $date
        ]);
    }
}
