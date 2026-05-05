<?php
// Страница категории - Informnews.kz
// Подключаем header
require_once __DIR__ . '/../partials/_header.php';
?>

<!-- Подключаем навигацию -->
<?php require_once __DIR__ . '/../partials/_navigation.php'; ?>

<!-- === BREADCRUMBS === -->
<div class="bg-slate-50 border-b border-slate-200">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center text-[11px] font-semibold text-slate-500 uppercase tracking-widest">
            <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?>" class="hover:text-slate-900 transition-colors flex items-center gap-1.5">
                <i class="las la-home text-sm"></i> <?= $lang === 'kz' ? 'Басты бет' : 'Главная' ?>
            </a>
            <i class="las la-angle-right mx-3 text-slate-300 text-sm"></i>
            <span class="text-slate-900 font-bold">
                <?= htmlspecialchars($category['name'] ?? '') ?>
            </span>
        </div>
    </div>
</div>

<!-- === CATEGORY HEADER === -->
<div class="bg-white border-b border-slate-200 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight text-slate-900">
            <?= htmlspecialchars($category['name'] ?? '') ?>
        </h1>
        <?php if (!empty($category['description'])): ?>
            <p class="text-lg text-slate-500 font-medium max-w-2xl">
                <?= htmlspecialchars($category['description']) ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- === POSTS GRID === -->
<main class="container mx-auto px-4 py-8">
    <?php if (isset($posts) && !empty($posts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <?php foreach ($posts as $post): ?>
                <?php
                $postTitle = $lang === 'kz' ? $post['title_kz'] : $post['title_ru'];
                $postExcerpt = $lang === 'kz' ? $post['excerpt_kz'] : $post['excerpt_ru'];
                $postSlug = $lang === 'kz' ? $post['slug_kz'] : $post['slug_ru'];
                $postCategory = $category['slug'] ?? 'aqparat';
                $postImage = !empty($post['image'])
                    ? '/uploads/medium/' . $post['image']
                    : 'https://placehold.co/400x300/666/FFF?text=News';
                $postDate = date('d.m.Y H:i', strtotime($post['published_at'] ?? 'now'));
                ?>
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $postCategory ?>/<?= $postSlug ?>"
                    class="bg-white border border-slate-200 group cursor-pointer shadow-sm hover:shadow-md transition-all duration-300 rounded-2xl overflow-hidden flex flex-col">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="<?= $postImage ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            alt="<?= htmlspecialchars($postTitle) ?>">
                        <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm tracking-widest uppercase">
                            <i class="las la-eye mr-1"></i>
                            <?= number_format($post['views'] ?? 0) ?>
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="text-[11px] font-semibold text-slate-400 mb-3 flex items-center gap-1.5 uppercase tracking-widest">
                            <i class="las la-calendar text-sm"></i>
                            <?= $postDate ?>
                        </div>
                        <h3 class="text-xl font-bold leading-snug text-slate-900 group-hover:text-slate-600 transition-colors mb-3">
                            <?= htmlspecialchars($postTitle) ?>
                        </h3>
                        <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed mt-auto">
                            <?= htmlspecialchars($postExcerpt ?? '') ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- === PAGINATION (PREMIUM DARK) === -->
        <?php
        $totalPages = 5; // TODO: Вычислять из количества постов
        $hasNext = $currentPage < $totalPages;
        $hasPrev = $currentPage > 1;
        ?>
        <?php if ($totalPages > 1): ?>
            <div class="flex justify-center items-center gap-2 mt-12">
                <?php if ($hasPrev): ?>
                    <a href="?page=<?= $currentPage - 1 ?>"
                        class="px-5 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-slate-900 font-bold text-sm">
                        <i class="las la-angle-left text-sm mr-1"></i>
                        <?= $lang === 'kz' ? 'Артқа' : 'Назад' ?>
                    </a>
                <?php endif; ?>

                <div class="flex gap-2">
                    <?php for ($i = 1; $i <= min($totalPages, 5); $i++): ?>
                        <a href="?page=<?= $i ?>"
                            class="w-12 h-12 flex items-center justify-center rounded-xl transition-all font-bold text-sm border <?= $i === $currentPage ? 'bg-slate-900 text-white border-slate-900 shadow-md' : 'bg-white border-slate-200 hover:bg-slate-50 text-slate-600' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <?php if ($hasNext): ?>
                    <a href="?page=<?= $currentPage + 1 ?>"
                        class="px-5 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-slate-900 font-bold text-sm">
                        <?= $lang === 'kz' ? 'Алға' : 'Вперед' ?>
                        <i class="las la-angle-right text-sm ml-1"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="text-center py-20 bg-slate-50 rounded-2xl border border-slate-200">
            <i class="las la-inbox text-6xl text-slate-300 mb-6"></i>
            <h3 class="text-2xl font-bold text-slate-900 mb-3 tracking-tight">
                <?= $lang === 'kz' ? 'Жаңалықтар жоқ' : 'Нет новостей' ?>
            </h3>
            <p class="text-slate-500 font-medium">
                <?= $lang === 'kz' ? 'Бұл санатта әлі ешқандай жаңалық жарияланбаған' : 'В этой категории еще нет опубликованных новостей' ?>
            </p>
        </div>
    <?php endif; ?>
</main>

<!-- Подключаем footer -->
<?php require_once __DIR__ . '/../partials/_footer.php'; ?>