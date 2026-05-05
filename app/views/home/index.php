<?php
/**
 * Главная страница - Informnews.kz
 * Файл обновлен: Дизайн Bento Grid + Фикс логики главной новости
 */

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';

// === ЛОГИКА ДАННЫХ ВНУТРИ VIEW (ЧТОБЫ НЕ БЫЛО ОШИБОК) ===

// 1. Функция для безопасного получения картинки
function getPostImage($post, $size = 'medium')
{
    if (!empty($post['image'])) {
        return "/uploads/$size/" . $post['image'];
    }
    // Красивая заглушка в цвет бренда, если фото нет
    return 'https://placehold.co/800x600/1e293b/FFF?text=Informnews.kz';
}

// 2. Умное определение Главной новости
// Если контроллер передал $heroPost - берем её. Если нет - берем первую из списка $latestNews.
$mainPost = null;
$feedNews = $latestNews ?? []; // Копия массива всех новостей

if (isset($heroPost) && !empty($heroPost)) {
    $mainPost = $heroPost;
} elseif (!empty($feedNews)) {
    $mainPost = $feedNews[0];
    array_shift($feedNews); // Удаляем эту новость из общего списка, чтобы не повторялась
}

// 3. Новости для средней колонки (2 шт)
$centerPosts = array_slice($feedNews, 0, 2);

// 4. Новости для нижней большой сетки (остальные)
$gridPosts = array_slice($feedNews, 2);
?>



<main class="container mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-4 gap-8">

    <!-- Главная новость (Hero Left) -->
    <div class="lg:col-span-3 relative h-[400px] md:h-[450px] group overflow-hidden rounded-2xl shadow-sm border border-slate-200">
        <?php if ($mainPost):
            $hTitle = $lang === 'kz' ? $mainPost['title_kz'] : $mainPost['title_ru'];
            $hSlug = $lang === 'kz' ? $mainPost['slug_kz'] : $mainPost['slug_ru'];
            $hCatSlug = $mainPost['category_slug'] ?? 'aqparat';
            $hLink = "/" . ($lang === 'ru' ? 'ru/' : '') . "$hCatSlug/$hSlug";
            ?>
            <a href="<?= $hLink ?>" class="block w-full h-full">
                <!-- Фото с зум-эффектом -->
                <img src="<?= getPostImage($mainPost, 'large') ?>"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                    alt="<?= htmlspecialchars($hTitle) ?>">

                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/90 via-black/50 to-transparent p-6 md:p-8 text-white">
                    <span class="bg-white text-brand px-3 py-1 text-[10px] font-extrabold uppercase mb-4 inline-flex items-center gap-1.5 rounded-md tracking-widest shadow-sm">
                        <i class="las la-star text-sm"></i> <?= $lang === 'kz' ? 'Басты жаңалық' : 'Главное' ?>
                    </span>

                    <h2 class="text-2xl md:text-4xl font-bold leading-tight mb-4 group-hover:text-slate-200 transition-colors tracking-tight">
                        <?= htmlspecialchars($hTitle) ?>
                    </h2>

                    <div class="flex items-center text-xs font-semibold text-slate-300 gap-6">
                        <span class="flex items-center gap-1.5"><i class="las la-clock text-lg"></i> <?= date('H:i', strtotime($mainPost['published_at'])) ?></span>
                        <span class="flex items-center gap-1.5"><i class="las la-eye text-lg"></i> <?= $mainPost['views'] ?? 0 ?></span>
                    </div>
                </div>
            </a>
        <?php else: ?>
            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold uppercase tracking-widest text-sm">
                <?= $lang === 'kz' ? 'Жаңалықтар жүктелуде...' : 'Загрузка новостей...' ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Сайдбар (Анонс/Live) -->
    <div class="lg:col-span-1 bg-white dark:bg-zinc-950 rounded-2xl shadow-sm border border-slate-200 dark:border-white/10 overflow-hidden flex flex-col h-[400px] md:h-[450px] transition-colors duration-300">
        <div class="bg-slate-50 dark:bg-zinc-900 border-b border-slate-200 dark:border-white/10 text-slate-900 dark:text-white p-5 font-bold uppercase flex justify-between items-center text-sm tracking-wider flex-shrink-0 transition-colors duration-300">
            <span class="flex items-center gap-2">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                </span>
                <?= $lang === 'kz' ? 'Ақпарат легі' : 'Live' ?>
            </span>
            <a href="https://wa.me/77470645196" target="_blank" class="text-slate-400 hover:text-green-500 transition-colors"><i class="lab la-whatsapp text-2xl"></i></a>
        </div>

        <div class="divide-y divide-slate-100 flex-1 overflow-y-auto no-scrollbar">
            <?php if (isset($announcements) && !empty($announcements)):
                foreach ($announcements as $item):
                    $aTitle = $lang === 'kz' ? $item['title_kz'] : $item['title_ru'];
                    $aLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($item['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $item['slug_kz'] : $item['slug_ru']);
                    ?>
                    <a href="<?= $aLink ?>" class="block p-5 hover:bg-slate-50 dark:hover:bg-zinc-900 cursor-pointer flex gap-4 transition-colors group/item">
                        <div class="flex flex-col justify-center w-full">
                            <div class="text-[10px] font-bold text-slate-400 flex justify-between uppercase tracking-wider mb-1">
                                <span class="flex items-center gap-1 text-slate-500 dark:text-slate-400 text-[11px] font-mono">
                                    <i class="las la-clock"></i> <?= date('H:i', strtotime($item['published_at'])) ?>
                                </span>
                            </div>
                            <h4 class="text-sm font-semibold leading-tight text-slate-800 dark:text-slate-200 line-clamp-3 group-hover/item:text-slate-500 dark:group-hover/item:text-slate-400 transition-colors">
                                <?= htmlspecialchars($aTitle) ?>
                            </h4>
                        </div>
                    </a>
                <?php endforeach; else: ?>
                <div class="flex items-center justify-center h-full text-xs text-slate-400 font-bold uppercase tracking-widest p-5 text-center">
                    <?= $lang === 'kz' ? 'Жүктелуде...' : 'Загрузка...' ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- ВИДЖЕТ КАЛЕНДАРЯ -->
        <div class="flex-shrink-0 bg-slate-50 dark:bg-zinc-900 border-t border-slate-200 dark:border-white/10 transition-colors duration-300">
            <?php require __DIR__ . '/../partials/_calendar_widget.php'; ?>
        </div>
    </div>
</main>




<!-- === ЛЕНТА НОВОСТЕЙ === -->
<section class="container mx-auto px-4 mb-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3 transition-colors duration-300">
            <span class="w-1.5 h-6 bg-brand dark:bg-white rounded-full block"></span>
            <?= $lang === 'kz' ? 'Барлық жаңалықтар' : 'Все новости' ?>
        </h2>
        <a href="/" class="text-sm font-semibold text-slate-500 hover:text-slate-900 flex items-center gap-1 transition-colors">
            <?= $lang === 'kz' ? 'Барлығын көру' : 'Показать все' ?> <i class="las la-arrow-right"></i>
        </a>
    </div>

    <!-- Общий массив для вывода в сетку (включая centerPosts и gridPosts) -->
    <?php $allGridNews = array_merge($centerPosts, $gridPosts); ?>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        <?php foreach ($allGridNews as $news):
            $nTitle = $lang === 'kz' ? $news['title_kz'] : $news['title_ru'];
            $nLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($news['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $news['slug_kz'] : $news['slug_ru']);
            ?>
            <!-- News Card -->
            <a href="<?= $nLink ?>" class="bg-white dark:bg-zinc-950 group cursor-pointer rounded-2xl shadow-sm hover:shadow-md transition-all border border-slate-200 dark:border-white/10 overflow-hidden flex flex-col">
                <div class="relative h-56 overflow-hidden bg-slate-100 dark:bg-zinc-900">
                    <img src="<?= getPostImage($news, 'medium') ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy" alt="<?= htmlspecialchars($nTitle) ?>">
                    <div class="absolute top-3 left-3 bg-white/90 dark:bg-black/90 backdrop-blur-sm text-slate-900 dark:text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-md shadow-sm">
                        <?= htmlspecialchars($news['category_name'] ?? 'Info') ?>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-[11px] text-slate-400 font-semibold mb-3 flex items-center gap-1.5">
                        <i class="las la-calendar text-sm"></i> <?= date('d M, Y H:i', strtotime($news['published_at'])) ?>
                    </div>
                    <h3 class="text-xl font-bold leading-snug text-slate-900 dark:text-slate-200 group-hover:text-slate-600 dark:group-hover:text-slate-400 transition-colors mb-3">
                        <?= htmlspecialchars($nTitle) ?>
                    </h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- === ПОПУЛЯРНОЕ + ВИДЕО === -->
<section class="container mx-auto px-4 mb-12">
    <?php if (isset($popularNews) && !empty($popularNews)): ?>
        <div class="bg-white dark:bg-zinc-950 text-slate-900 dark:text-white rounded-3xl p-8 lg:p-12 relative overflow-hidden border border-slate-200 dark:border-white/10 shadow-sm transition-colors duration-300">
            <h2 class="text-2xl font-bold mb-10 relative z-10 flex items-center gap-3 text-slate-900 dark:text-white">
                <span class="w-10 h-10 bg-slate-100 dark:bg-zinc-900 rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-white/10">
                    <i class="las la-fire text-xl"></i>
                </span>
                <?= $lang === 'kz' ? 'Ең көп оқылғандар' : 'Популярное за неделю' ?>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10 mb-12">
                <?php foreach (array_slice($popularNews, 0, 4) as $idx => $pop):
                    $pTitle = $lang === 'kz' ? $pop['title_kz'] : $pop['title_ru'];
                    $pLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($pop['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $pop['slug_kz'] : $pop['slug_ru']);
                    ?>
                    <div class="group cursor-pointer hover:bg-slate-50 dark:hover:bg-zinc-900 p-4 rounded-2xl transition-all border border-transparent hover:border-slate-200 dark:hover:border-white/10">
                        <div class="flex items-start gap-4">
                            <span class="text-5xl font-black text-slate-200 dark:text-zinc-800 group-hover:text-slate-300 dark:group-hover:text-zinc-700 transition -mt-2"><?= $idx + 1 ?></span>
                            <div>
                                <a href="<?= $pLink ?>">
                                    <h4 class="font-bold text-[15px] leading-snug group-hover:text-slate-500 dark:group-hover:text-slate-400 transition-colors mb-3 text-slate-900 dark:text-slate-200">
                                        <?= htmlspecialchars($pTitle) ?>
                                    </h4>
                                </a>
                                <div class="text-[11px] text-slate-400 font-bold flex items-center gap-2 tracking-widest uppercase">
                                    <i class="las la-eye text-sm"></i>
                                    <?= number_format($pop['views'] ?? 0) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- === БЛОК ВИДЕО === -->
            <?php if (isset($videos) && !empty($videos)): ?>
                <div class="border-t border-slate-200 dark:border-white/10 pt-10 relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                            <span class="w-10 h-10 bg-slate-100 dark:bg-zinc-900 rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-white/10">
                                <i class="las la-play-circle text-xl"></i>
                            </span>
                            <?= $lang === 'kz' ? 'Бейнежазбалар' : 'Видеогалерея' ?>
                        </h3>
                        <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?>videos" class="text-[12px] font-semibold text-slate-500 hover:text-slate-900 transition-all flex items-center gap-2">
                            <?= $lang === 'kz' ? 'Барлығы' : 'Все видео' ?> <i class="las la-arrow-right"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach ($videos as $video):
                            $vTitle = $lang === 'kz' ? $video['title_kz'] : $video['title_ru'];
                            $vLink = $video['youtube_url'];
                            ?>
                            <div class="group relative bg-white dark:bg-zinc-950 rounded-2xl overflow-hidden border border-slate-200 dark:border-white/10 transition-all hover:shadow-md hover:-translate-y-1">
                                <a href="<?= $vLink ?>" target="_blank" class="relative block aspect-video overflow-hidden">
                                    <img src="/uploads/large/<?= $video['image'] ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="<?= htmlspecialchars($vTitle) ?>">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-all flex items-center justify-center">
                                        <div class="w-14 h-14 bg-white/90 backdrop-blur-md text-slate-900 rounded-full flex items-center justify-center shadow-lg transform transition group-hover:scale-110">
                                            <i class="las la-play text-2xl ml-1"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="p-5">
                                    <div class="text-[11px] font-semibold text-slate-400 mb-2 flex items-center gap-2 tracking-widest uppercase">
                                        <i class="las la-calendar text-sm"></i>
                                        <?= date('d.m.Y', strtotime($video['published_at'])) ?>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-slate-200 leading-snug line-clamp-2 group-hover:text-slate-500 dark:group-hover:text-slate-400 transition-colors">
                                        <a href="<?= $vLink ?>" target="_blank"><?= htmlspecialchars($vTitle) ?></a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>