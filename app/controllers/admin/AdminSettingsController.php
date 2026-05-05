<?php
/**
 * AdminSettingsController - Управление настройками сайта
 */

namespace admin;

require_once __DIR__ . '/../../../core/Controller.php';

class AdminSettingsController extends \Controller
{
    private $configPath;

    public function __construct()
    {
        parent::__construct();

        // Проверка авторизации
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->redirect('/admin/login');
            exit;
        }

        $this->configPath = __DIR__ . '/../../../config/app.php';
    }

    /**
     * Страница настроек
     */
    public function index()
    {
        $config = require $this->configPath;

        $this->view('admin/settings', [
            'config' => $config,
            'activeTab' => 'settings'
        ]);
    }

    /**
     * Сохранение настроек
     */
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Неверный метод';
            $this->redirect('/admin/settings');
            return;
        }

        // Получаем текущий конфиг
        $config = require $this->configPath;

        // Обновляем значения из формы
        $config['name'] = $this->post('site_name');
        $config['url'] = $this->post('site_url');
        $config['default_lang'] = $this->post('default_lang');
        $config['brand_color'] = $this->post('brand_color');
        $config['timezone'] = $this->post('timezone');
        $config['pagination'] = (int) $this->post('pagination');

        // API ключи
        $config['openweather_api_key'] = $this->post('openweather_api_key');
        $config['weather_city'] = $this->post('weather_city');
        $config['recaptcha_site_key'] = $this->post('recaptcha_site_key');
        $config['recaptcha_secret_key'] = $this->post('recaptcha_secret_key');
        $config['recaptcha_enabled'] = isset($_POST['recaptcha_enabled']) ? true : false;

        // Email
        $config['contact_email'] = $this->post('contact_email');
        $config['admin_email'] = $this->post('admin_email');

        // Контакты
        $config['phone'] = $this->post('phone');
        $config['address'] = $this->post('address');
        $config['company_name'] = $this->post('company_name');
        $config['info_email'] = $this->post('info_email');

        // Социальные сети
        $config['social_instagram'] = $this->post('social_instagram');
        $config['social_facebook'] = $this->post('social_facebook');
        $config['social_telegram'] = $this->post('social_telegram');
        $config['social_tiktok'] = $this->post('social_tiktok');

        // Генерируем новый файл config
        $configContent = "<?php\n";
        $configContent .= "/**\n";
        $configContent .= " * Конфигурация приложения\n";
        $configContent .= " * Qyzylorda Times News Portal\n";
        $configContent .= " */\n\n";
        $configContent .= "return " . var_export($config, true) . ";\n";

        // Сохраняем
        if (file_put_contents($this->configPath, $configContent)) {
            $_SESSION['success'] = 'Настройки сохранены успешно!';
        } else {
            $_SESSION['error'] = 'Ошибка сохранения настроек';
        }

        $this->redirect('/admin/settings');
    }
}
