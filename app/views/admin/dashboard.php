<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CMS Informnews.kz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .nav-item.active {
            background-color: #f1f5f9;
            color: #0f172a;
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR (Меню) -->
        <?php require_once __DIR__ . '/../partials/_admin_sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10 shadow-sm">
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Шолу (Обзор)</h2>
                <div class="flex gap-4">
                    <a href="/" target="_blank" class="flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors bg-slate-100 px-4 py-2 rounded-xl">
                        <i class="las la-external-link-alt text-lg"></i> Сайтты көру
                    </a>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-8">

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 transition-all hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-500 font-medium text-sm mb-1">Жалпы жаңалықтар</p>
                                <h3 class="text-3xl font-bold text-slate-900">
                                    <?= number_format($stats['total_posts'] ?? 0) ?>
                                </h3>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <i class="las la-newspaper text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 transition-all hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-500 font-medium text-sm mb-1">Бүгінгі қаралым</p>
                                <h3 class="text-3xl font-bold text-slate-900">
                                    <?= number_format($stats['today_views'] ?? 0) ?>
                                </h3>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                                <i class="las la-eye text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 transition-all hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-500 font-medium text-sm mb-1">Күту пікірлер</p>
                                <h3 class="text-3xl font-bold text-slate-900">
                                    <?= number_format($stats['pending_comments'] ?? 0) ?>
                                </h3>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                <i class="las la-comments text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 transition-all hover:shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-500 font-medium text-sm mb-1">Барлық пікірлер</p>
                                <h3 class="text-3xl font-bold text-slate-900">
                                    <?= number_format($stats['total_comments'] ?? 0) ?>
                                </h3>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                                <i class="las la-comment-dots text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Latest Posts Table -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-white">
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">Соңғы қосылғандар</h3>
                        <a href="/admin/posts/create"
                            class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm flex items-center gap-2">
                            <i class="las la-plus text-lg"></i> Жаңа жаңалық
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        ID</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        Тақырып (Title)</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        Автор</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        Статус</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        Дата</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-widest">
                                        Әрекет</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                <?php if (isset($recentPosts) && !empty($recentPosts)): ?>
                                    <?php foreach ($recentPosts as $post): ?>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium text-xs">#<?= $post['id'] ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-slate-900 line-clamp-1">
                                                    <?= htmlspecialchars($post['title_kz'] ?? $post['title_ru']) ?>
                                                </div>
                                                <span class="text-xs text-slate-400 font-medium">
                                                    <?= !empty($post['title_kz']) && !empty($post['title_ru']) ? 'KZ / RU' : (!empty($post['title_kz']) ? 'KZ' : 'RU') ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-medium">
                                                <?= htmlspecialchars($post['author_name'] ?? 'Редакция') ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                $statusClass = match ($post['status'] ?? 'draft') {
                                                    'published' => 'bg-green-100 text-green-700 border border-green-200',
                                                    'draft' => 'bg-amber-100 text-amber-700 border border-amber-200',
                                                    default => 'bg-slate-100 text-slate-700 border border-slate-200'
                                                };
                                                $statusText = match ($post['status'] ?? 'draft') {
                                                    'published' => 'Жарияланды',
                                                    'draft' => 'Черновик',
                                                    default => 'Белгісіз'
                                                };
                                                ?>
                                                <span
                                                    class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full <?= $statusClass ?>">
                                                    <?= $statusText ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium">
                                                <?= date('d.m.Y', strtotime($post['created_at'] ?? 'now')) ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="/admin/posts/edit/<?= $post['id'] ?>"
                                                    class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors mr-2">
                                                    <i class="las la-pen text-lg"></i>
                                                </a>
                                                <a href="/admin/posts/delete/<?= $post['id'] ?>"
                                                    class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"
                                                    onclick="return confirm('Жаңалықты өшіруге сенімдісіз бе?')">
                                                    <i class="las la-trash-alt text-lg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                            Жаңалықтар жоқ
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php
    // Компоненты справки
    $helpPage = 'dashboard';
    include __DIR__ . '/partials/_help_button.php';
    include __DIR__ . '/partials/_help_modal.php';
    ?>

</body>

</html>