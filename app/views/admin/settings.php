<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Баптаулар - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .nav-item.active {
            background-color: #1C3D81;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <?php require_once __DIR__ . '/../partials/_admin_sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header class="h-16 bg-white shadow flex justify-between items-center px-8 z-10">
                <h2 class="text-xl font-semibold text-gray-800">Баптаулар / Настройки</h2>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">

                <!-- Уведомления -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Форма настроек -->
                <form action="/admin/settings/save" method="POST" class="space-y-6">

                    <!-- Основные настройки -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-globe text-blue-600 mr-2"></i>
                            Негізгі / Основные настройки
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Сайт аты / Название сайта</label>
                                <input type="text" name="site_name" value="<?= $config['name'] ?>" required
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">URL сайта</label>
                                <input type="url" name="site_url" value="<?= $config['url'] ?>" required
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Әдепкі тіл / Язык по умолчанию</label>
                                <select name="default_lang"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="kz" <?= $config['default_lang'] === 'kz' ? 'selected' : '' ?>>Қазақша
                                    </option>
                                    <option value="ru" <?= $config['default_lang'] === 'ru' ? 'selected' : '' ?>>Русский
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Брендтік түс / Цвет бренда</label>
                                <input type="color" name="brand_color" value="<?= $config['brand_color'] ?>"
                                    class="w-full border border-gray-300 rounded px-3 py-2 h-10">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Таймзона</label>
                                <input type="text" name="timezone" value="<?= $config['timezone'] ?>"
                                    placeholder="Asia/Qyzylorda"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Pagination (элементов на странице)</label>
                                <input type="number" name="pagination" value="<?= $config['pagination'] ?>" min="5"
                                    max="50"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- API ключи -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-key text-yellow-600 mr-2"></i>
                            API кілттері / API ключи
                        </h3>

                        <div class="space-y-4">
                            <!-- OpenWeather -->
                            <div class="border-l-4 border-blue-400 pl-4">
                                <h4 class="font-semibold mb-2 text-sm">OpenWeather</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-1">API Key</label>
                                        <input type="text" name="openweather_api_key"
                                            value="<?= $config['openweather_api_key'] ?>"
                                            placeholder="Получить на openweathermap.org"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Қала / Город</label>
                                        <input type="text" name="weather_city" value="<?= $config['weather_city'] ?>"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Google reCAPTCHA -->
                            <div class="border-l-4 border-green-400 pl-4">
                                <h4 class="font-semibold mb-2 text-sm">Google reCAPTCHA v2</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Site Key</label>
                                        <input type="text" name="recaptcha_site_key"
                                            value="<?= $config['recaptcha_site_key'] ?>"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1">Secret Key</label>
                                        <input type="text" name="recaptcha_secret_key"
                                            value="<?= $config['recaptcha_secret_key'] ?>"
                                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="recaptcha_enabled" value="1"
                                            <?= $config['recaptcha_enabled'] ? 'checked' : '' ?>
                                            class="rounded text-red-600 focus:ring-red-500">
                                        <span class="ml-2 text-sm">Қосу / Включить reCAPTCHA</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email настройки -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-envelope text-purple-600 mr-2"></i>
                            Email байланыстары / Email контакты
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Байланыс email / Контактный email</label>
                                <input type="email" name="contact_email" value="<?= $config['contact_email'] ?>"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Админ email</label>
                                <input type="email" name="admin_email" value="<?= $config['admin_email'] ?>"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- Контактная информация -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-address-book text-green-600 mr-2"></i>
                            Байланыс ақпараты / Контактная информация
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Телефон</label>
                                <input type="text" name="phone" value="<?= $config['phone'] ?? '' ?>"
                                    placeholder="8 (747) 064 5196"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Info Email</label>
                                <input type="email" name="info_email" value="<?= $config['info_email'] ?? '' ?>"
                                    placeholder="info@informnews.kz"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Мекен-жайы / Адрес</label>
                                <input type="text" name="address" value="<?= $config['address'] ?? '' ?>"
                                    placeholder="Қызылорда қ., Бейбарыс сұлтан, 1"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Компания аты / Название компании</label>
                                <input type="text" name="company_name" value="<?= $config['company_name'] ?? '' ?>"
                                    placeholder="&quot;Сыр медиа&quot; ЖШС"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- Социальные сети -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-share-alt text-pink-600 mr-2"></i>
                            Әлеуметтік желілер / Социальные сети
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    <i class="fab fa-instagram mr-1"></i> Instagram
                                </label>
                                <input type="text" name="social_instagram"
                                    value="<?= $config['social_instagram'] ?? '#' ?>"
                                    placeholder="https://instagram.com/..."
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    <i class="fab fa-facebook mr-1"></i> Facebook
                                </label>
                                <input type="text" name="social_facebook"
                                    value="<?= $config['social_facebook'] ?? '#' ?>"
                                    placeholder="https://facebook.com/..."
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    <i class="fab fa-telegram mr-1"></i> Telegram
                                </label>
                                <input type="text" name="social_telegram"
                                    value="<?= $config['social_telegram'] ?? '#' ?>" placeholder="https://t.me/..."
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    <i class="fab fa-tiktok mr-1"></i> TikTok
                                </label>
                                <input type="text" name="social_tiktok" value="<?= $config['social_tiktok'] ?? '#' ?>"
                                    placeholder="https://tiktok.com/@..."
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- Кнопка сохранения -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-[#1C3D81] hover:bg-red-700 text-white font-bold px-8 py-3 rounded shadow-lg">
                            <i class="fas fa-save mr-2"></i>Сақтау / Сохранить
                        </button>
                    </div>

                </form>

            </main>
        </div>
    </div>
<?php
$helpPage = 'settings';
include __DIR__ . '/partials/_help_button.php';
include __DIR__ . '/partials/_help_modal.php';
?>

</body>

</html>