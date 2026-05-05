<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $video ? 'Видеоны өзгерту / Редактировать видео' : 'Жаңа видео / Новое видео' ?> - CMS
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
            <!-- Top Header -->
            <header class="h-16 bg-white shadow flex justify-between items-center px-8 z-10">
                <h2 class="text-xl font-semibold text-gray-800">
                    <?= $video ? 'Видеоны өзгерту / Редактировать видео' : 'Жаңа видео қосу / Добавить новое видео' ?>
                </h2>
                <div class="flex gap-4">
                    <button type="submit" form="video-form"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm font-medium">
                        Сақтау / Сохранить
                    </button>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form id="video-form" action="/admin/videos/save" method="POST" enctype="multipart/form-data"
                    class="max-w-4xl mx-auto space-y-6">
                    <input type="hidden" name="id" value="<?= $video['id'] ?? '' ?>">
                    <input type="hidden" name="current_image" value="<?= $video['image'] ?? '' ?>">

                    <!-- Блок контента -->
                    <div class="bg-white shadow rounded-lg p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Тақырып (QAZ) *</label>
                                <input type="text" name="title_kz"
                                    value="<?= htmlspecialchars($video['title_kz'] ?? '') ?>" required
                                    class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок (RUS)</label>
                                <input type="text" name="title_ru"
                                    value="<?= htmlspecialchars($video['title_ru'] ?? '') ?>"
                                    class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">YouTube URL * (мысалы:
                                https://www.youtube.com/watch?v=...)</label>
                            <input type="url" name="youtube_url"
                                value="<?= htmlspecialchars($video['youtube_url'] ?? '') ?>" required
                                class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500 text-sm font-mono"
                                placeholder="https://www.youtube.com/watch?v=...">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Жрияланған күні / Дата
                                    публикации</label>
                                <input type="datetime-local" name="published_at"
                                    value="<?= isset($video['published_at']) ? date('Y-m-d\TH:i', strtotime($video['published_at'])) : date('Y-m-d\TH:i') ?>"
                                    class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Мұқаба / Обложка (Preview
                                    Image) *</label>
                                <input type="file" name="image" <?= !$video ? 'required' : '' ?> accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded
                                file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700
                                hover:file:bg-red-100">
                                <?php if ($video && !empty($video['image'])): ?>
                                    <div class="mt-2 text-[10px] text-gray-500 italic">Қазіргі сурет / Текущее фото:
                                        <?= $video['image'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="/admin/videos"
                            class="px-6 py-2 border border-gray-300 rounded text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                            Болдырмау / Отмена
                        </a>
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-8 py-2 rounded text-sm font-medium shadow-lg transition-colors">
                            <?= $video ? 'Өзгертулерді сақтау / Сохранить изменения' : 'Қосу / Добавить видео' ?>
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>