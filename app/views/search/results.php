<?php
/**
 * Страница результатов поиска
 */

$pageTitle = ($lang === 'kz' ? 'Іздеу нәтижелері' : 'Результаты поиска') . ' - Informnews.kz';
require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';
?>

<main class="container mx-auto px-4 py-8">

    <!-- Заголовок поиска -->
    <div class="mb-10">
        <h1 class="text-3xl font-black text-slate-900 mb-2 uppercase tracking-tight">
            <?= $lang === 'kz' ? 'Іздеу нәтижелері' : 'Результаты поиска' ?>
        </h1>

        <?php if (!empty($query)): ?>
            <p class="text-slate-600 font-medium">
                <?= $lang === 'kz' ? 'Сұраныс' : 'Запрос' ?>:
                <span class="text-slate-900 font-black">"<?= htmlspecialchars($query) ?>"</span>
            </p>

            <?php if (isset($totalResults)): ?>
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-2">
                    <?= $lang === 'kz'
                        ? "Табылды: {$totalResults} мақала"
                        : "Найдено: {$totalResults} материалов" ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Ошибка (минимум символов) -->
    <?php if (isset($error)): ?>
        <div class="bg-amber-50 border-l-4 border-amber-500 p-5 rounded-r-2xl mb-8">
            <div class="flex items-center gap-4">
                <i class="las la-exclamation-triangle text-amber-500 text-2xl"></i>
                <p class="text-sm text-amber-900 font-bold">
                    <?= htmlspecialchars($error) ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Результаты -->
    <?php if (!empty($results)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($results as $post): ?>
                <?php
                $postTitle = $lang === 'kz' ? ($post['title_kz'] ?? $post['title_ru']) : ($post['title_ru'] ?? $post['title_kz']);
                $postExcerpt = $lang === 'kz' ? ($post['excerpt_kz'] ?? $post['excerpt_ru']) : ($post['excerpt_ru'] ?? $post['excerpt_kz']);
                $postSlug = $lang === 'kz' ? $post['slug_kz'] : $post['slug_ru'];
                $categorySlug = $post['category_slug'] ?? '';
                $postImage = !empty($post['image']) ? '/uploads/medium/' . $post['image'] : 'https://placehold.co/400x300/666/FFF?text=News';
                ?>

                <!-- Карточка новости -->
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $categorySlug ?>/<?= $postSlug ?>"
                    class="bg-white border border-slate-200 group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300 rounded-2xl overflow-hidden flex flex-col">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="<?= $postImage ?>" alt="<?= htmlspecialchars($postTitle) ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm tracking-widest uppercase">
                            <i class="las la-eye mr-1"></i>
                            <?= number_format($post['views'] ?? 0) ?>
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="text-[11px] font-semibold text-slate-400 mb-3 flex items-center gap-1.5 uppercase tracking-widest">
                            <i class="las la-calendar text-sm"></i>
                            <?= date('d.m.Y', strtotime($post['published_at'])) ?>
                        </div>
                        <h3 class="text-lg font-bold leading-snug text-slate-900 group-hover:text-slate-600 transition-colors mb-3 line-clamp-2">
                            <?= htmlspecialchars($postTitle) ?>
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed mt-auto">
                            <?= htmlspecialchars($postExcerpt ?? '') ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Пагинация -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center gap-2">
                    <?php if ($currentPage > 1): ?>
                        <a href="?q=<?= urlencode($query) ?>&page=<?= $currentPage - 1 ?>"
                            class="px-5 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-slate-900 font-bold group text-sm flex items-center justify-center">
                            <i class="las la-angle-left text-sm mr-1"></i>
                        </a>
                    <?php endif; ?>

                    <div class="flex gap-2">
                        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                            <a href="?q=<?= urlencode($query) ?>&page=<?= $i ?>"
                                class="w-12 h-12 flex items-center justify-center rounded-xl transition-all font-bold text-sm border <?= $i === $currentPage ? 'bg-slate-900 text-white border-slate-900 shadow-md' : 'bg-white border-slate-200 hover:bg-slate-50 text-slate-600' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?q=<?= urlencode($query) ?>&page=<?= $currentPage + 1 ?>"
                            class="px-5 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-slate-900 font-bold group text-sm flex items-center justify-center">
                            <i class="las la-angle-right text-sm ml-1"></i>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>

    <?php elseif (!isset($error)): ?>
        <!-- Ничего не найдено -->
        <div class="text-center py-20 bg-slate-50 rounded-2xl border border-slate-200">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white border border-slate-200 rounded-3xl mb-6 shadow-sm">
                <i class="las la-search text-4xl text-slate-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3 tracking-tight">
                <?= $lang === 'kz' ? 'Ештеңе табылмады' : 'Ничего не найдено' ?>
            </h3>
            <p class="text-slate-500 font-medium max-w-md mx-auto">
                <?= $lang === 'kz'
                    ? 'Бұл сұраныс бойынша мақалалар табылмады. Басқа сөздерді қолданып көріңіз.'
                    : 'По вашему запросу ничего не найдено. Попробуйте использовать другие слова.' ?>
            </p>
            <a href="/"
                class="inline-flex items-center gap-2 mt-8 text-slate-900 font-bold uppercase tracking-widest text-xs hover:text-slate-600 transition-colors">
                <i class="las la-arrow-left"></i>
                <?= $lang === 'kz' ? 'Басты бетке' : 'На главную' ?>
            </a>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>