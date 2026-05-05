<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $ad ? 'Жарнаманы өзгерту / Редактировать' : 'Жаңа жарнама / Новая реклама' ?> - CMS
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR -->
        <?php require_once __DIR__ . '/../../partials/_admin_sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white shadow flex justify-between items-center px-8 z-10">
                <h2 class="text-xl font-semibold text-gray-800">
                    <?= $ad ? 'Жарнаманы өңдеу / Редактировать рекламу' : 'Жаңа жарнама қосу / Добавить рекламу' ?>
                </h2>
                <div class="flex gap-4">
                    <button type="submit" form="ad-form"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm font-medium">Сақтау</button>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form id="ad-form" action="/admin/ads/save" method="POST" enctype="multipart/form-data"
                    class="max-w-4xl mx-auto space-y-6">
                    <input type="hidden" name="id" value="<?= $ad['id'] ?? '' ?>">
                    <input type="hidden" name="current_image" value="<?= $ad['image'] ?? '' ?>">

                    <div class="bg-white shadow rounded-lg p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Тақырып (Админ үшін) /
                                Заголовок</label>
                            <input type="text" name="title" value="<?= htmlspecialchars($ad['title'] ?? '') ?>"
                                class="w-full border border-gray-300 rounded p-2 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Сілтеме / Ссылка (Link)</label>
                            <input type="url" name="link" value="<?= htmlspecialchars($ad['link'] ?? '') ?>"
                                placeholder="https://..."
                                class="w-full border border-gray-300 rounded p-2 text-sm font-mono">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Позиция</label>
                                <select name="position" class="w-full border border-gray-300 rounded p-2 text-sm">
                                    <option value="sidebar" <?= (isset($ad['position']) && $ad['position'] === 'sidebar') ? 'selected' : '' ?>>Сайдбар (Бас бет)</option>
                                    <option value="content_bottom" <?= (isset($ad['position']) && $ad['position'] === 'content_bottom') ? 'selected' : '' ?>>Мақала асты (Single
                                        Page)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Статус</label>
                                <select name="status" class="w-full border border-gray-300 rounded p-2 text-sm">
                                    <option value="active" <?= (isset($ad['status']) && $ad['status'] === 'active') ? 'selected' : '' ?>>Актив</option>
                                    <option value="inactive" <?= (isset($ad['status']) && $ad['status'] === 'inactive') ? 'selected' : '' ?>>Өшірулі</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Баннер / Изображение *</label>
                            <input type="file" name="image" <?= !$ad ? 'required' : '' ?> accept="image/*" class="w-full
                            text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs
                            file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                            <?php if ($ad && !empty($ad['image'])): ?>
                                <div class="mt-4">
                                    <p class="text-xs text-gray-500 mb-2">Қазіргі сурет / Текущее изображение:</p>
                                    <img src="/uploads/medium/<?= $ad['image'] ?>" class="h-32 rounded border shadow-sm">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="/admin/ads"
                            class="px-6 py-2 border border-gray-300 rounded text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">Болдырмау</a>
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-8 py-2 rounded text-sm font-medium shadow-lg transition-colors">Сақтау</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>