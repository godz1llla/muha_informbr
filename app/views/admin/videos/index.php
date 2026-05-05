<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бейнежазбалар / Видео - CMS</title>
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
                <h2 class="text-xl font-semibold text-gray-800">Бейнежазбалар / Видео</h2>
                <div class="flex gap-4">
                    <a href="/admin/videos/create"
                        class="bg-[#1C3D81] hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-medium flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Бейне қосу / Добавить видео
                    </a>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Videos Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Мұқаба / Обложка</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Тақырып / Заголовок</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        YouTube URL</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Әрекет / Действие</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (isset($videos) && !empty($videos)): ?>
                                    <?php foreach ($videos as $vid): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">#
                                                <?= $vid['id'] ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="/uploads/thumbnail/<?= $vid['image'] ?>"
                                                    class="h-12 w-20 object-cover rounded shadow-sm border" alt="">
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-xs text-gray-800 font-bold">
                                                    <?= htmlspecialchars($vid['title_kz']) ?>
                                                </div>
                                                <div class="text-[10px] text-gray-500 italic mt-1">
                                                    <?= htmlspecialchars($vid['title_ru']) ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-xs font-mono text-blue-600">
                                                <a href="<?= $vid['youtube_url'] ?>" target="_blank" class="hover:underline">🎬
                                                    YouTube Link</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-xs">
                                                <?= date('d.m.Y H:i', strtotime($vid['published_at'])) ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end gap-2">
                                                    <a href="/admin/videos/edit/<?= $vid['id'] ?>"
                                                        class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded transition-colors"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="/admin/videos/delete/<?= $vid['id'] ?>"
                                                        class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded transition-colors"
                                                        onclick="return confirm('Өшіруді растайсыз ба? / Подтверждаете удаление?')"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">Видеолар әлі
                                            қосылмаған / Видео еще не добавлены</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>