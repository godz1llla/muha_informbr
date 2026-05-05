<?php
/**
 * Страница чтения новости (Single Post)
 * Дизайн: Longread / Editorial style
 */

// 1. Подготовка данных
$tLang = $lang === 'kz' ? 'kz' : 'ru';
$postTitle = $post['title_' . $tLang] ?? $post['title_ru'];
$postContent = $post['content_' . $tLang] ?? $post['content_ru'];
$postExcerpt = $post['excerpt_' . $tLang] ?? $post['excerpt_ru'];
$postDate = strtotime($post['published_at']);
$categoryName = $post['category_name'] ?? 'News';

// SEO Metas
$pageTitle = htmlspecialchars($postTitle) . ' - Informnews.kz';
$metaDescription = mb_substr(strip_tags($postExcerpt), 0, 160);

// Open Graph (для красивой ссылки в WhatsApp)
$ogTitle = htmlspecialchars($postTitle);
$ogImage = !empty($post['image']) ? 'https://informnews.kz/uploads/large/' . $post['image'] : 'https://informnews.kz/logo.png';
$ogUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';

// Хелпер для картинок
function getPostImg($img)
{
    return !empty($img) ? "/uploads/large/$img" : null;
}
?>

<!-- === PROGRESS BAR (ИНДИКАТОР ЧТЕНИЯ) === -->
<div class="fixed top-0 left-0 w-full h-1 z-[60] bg-transparent pointer-events-none">
    <div id="scrollProgress"
        class="h-full bg-slate-900 w-0 transition-all duration-75 shadow-sm"></div>
</div>

<main class="container mx-auto px-4 py-8 lg:py-12">

    <!-- Хлебные крошки -->
    <nav class="flex items-center gap-2 text-[11px] font-bold text-slate-500 mb-8 uppercase tracking-widest">
        <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="hover:text-slate-900 transition flex items-center gap-1.5">
            <i class="las la-home text-sm mb-0.5"></i> <?= $lang === 'kz' ? 'Басты' : 'Главная' ?>
        </a>
        <i class="las la-angle-right text-xs opacity-40 mx-2 text-slate-300"></i>
        <a href="/<?= $lang === 'ru' ? 'ru/' : '/' ?><?= $post['category_slug'] ?? 'news' ?>"
            class="hover:text-slate-900 transition text-slate-900 font-bold flex items-center gap-1.5">
            <i class="las la-folder-open text-sm mb-0.5"></i> <?= htmlspecialchars($categoryName) ?>
        </a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

        <!-- === ЛЕВАЯ КОЛОНКА (СТАТЬЯ) === -->
        <article class="lg:col-span-8">

            <!-- Заголовок -->
            <header class="mb-8">
                <h1
                    class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 leading-tight mb-6 tracking-tight">
                    <?= htmlspecialchars($postTitle) ?>
                </h1>

                <!-- Мета-строка -->
                <div
                    class="flex flex-wrap items-center justify-between border-y border-slate-200 py-4 gap-4">
                    <div class="flex items-center gap-4">
                        <img src="/assets/logo.png"
                            class="w-10 h-10 object-contain p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm">
                        <div class="leading-tight">
                            <div class="font-bold text-slate-900 text-sm">Informnews.kz</div>
                            <div class="text-[11px] text-slate-500 font-semibold flex items-center gap-1.5 mt-0.5 tracking-widest uppercase">
                                <i class="las la-clock text-sm"></i> <?= date('d.m.Y, H:i', $postDate) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <div
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest mr-2 hidden sm:block">
                            <?= $lang === 'kz' ? 'Бөлісу:' : 'Поделиться:' ?>
                        </div>
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($postTitle . ' ' . $ogUrl) ?>"
                            target="_blank"
                            class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-green-500 hover:text-white flex items-center justify-center transition-colors border border-slate-200 shadow-sm">
                            <i class="lab la-whatsapp text-xl"></i>
                        </a>
                        <a href="https://t.me/share/url?url=<?= urlencode($ogUrl) ?>&text=<?= urlencode($postTitle) ?>"
                            target="_blank"
                            class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors border border-slate-200 shadow-sm">
                            <i class="lab la-telegram-plane text-xl"></i>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Главное фото -->
            <?php if ($imgSrc = getPostImg($post['image'])): ?>
                <figure
                    class="mb-10 rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-slate-50">
                    <img src="<?= $imgSrc ?>" class="w-full h-auto object-cover" alt="<?= htmlspecialchars($postTitle) ?>">
                </figure>
            <?php endif; ?>

            <!-- ТЕЛО СТАТЬИ (TYPOGRAPHY) -->
            <!-- 
               Используем класс 'prose' от Tailwind Typography. 
               Он автоматически делает отступы, красивые списки, цитаты.
               font-serif -> включает Merriweather.
            -->
            <div class="prose prose-lg prose-slate max-w-none text-slate-800 leading-relaxed font-serif">

                <!-- Основной контент -->
                <div class="article-body">
                    <?= $postContent ?>
                </div>

            </div>

            <!-- Теги и категория -->
            <div class="mt-8 pt-6 border-t border-slate-200 flex items-center gap-3 flex-wrap">
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $post['category_slug'] ?>"
                    class="bg-slate-50 border border-slate-200 hover:bg-slate-100 transition px-4 py-2 rounded-xl text-xs font-bold text-slate-500 uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                    <i class="las la-tag text-sm"></i> <?= htmlspecialchars($categoryName) ?>
                </a>
            </div>

            <!-- === БЛОК КОММЕНТАРИЕВ === -->
            <section class="mt-16" id="comments">
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm">

                    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3 tracking-tight">
                        <span class="w-1.5 h-6 bg-slate-900 rounded-full"></span>
                        <i class="las la-comments text-slate-900 text-2xl"></i>
                        <?= $lang === 'kz' ? 'Пікірлер' : 'Обсуждение' ?>
                        <span class="bg-white text-slate-900 text-xs font-bold px-2.5 py-1 rounded-md border border-slate-200 shadow-sm">
                            <?= count($comments ?? []) ?>
                        </span>
                    </h3>

                    <!-- Уведомления (если есть) -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div
                            class="mb-4 text-sm text-green-700 bg-green-50 p-4 rounded-xl border border-green-200 font-medium">
                            <?= $_SESSION['success'] ?>     <?php unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                        <!-- Форма -->
                        <form action="/post/submitComment" method="POST" class="mb-8 relative">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">

                            <div class="mb-4 relative">
                                <i class="las la-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                                <input type="text" name="author_name" required
                                    placeholder="<?= $lang === 'kz' ? 'Сіздің атыңыз' : 'Ваше имя' ?>"
                                    class="w-full rounded-2xl border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 shadow-sm transition-all pl-12 py-3.5">
                            </div>

                            <div class="relative mb-4">
                                <i class="las la-pen absolute left-4 top-4 text-slate-400 text-lg"></i>
                                <textarea name="comment_text" required rows="3"
                                    placeholder="<?= $lang === 'kz' ? 'Өз ойыңызды жазыңыз...' : 'Напишите ваш комментарий...' ?>"
                                    class="w-full rounded-2xl border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 shadow-sm transition-all pl-12 py-3.5"></textarea>
                            </div>

                            <button type="submit"
                                class="bg-slate-900 text-white font-bold text-sm px-8 py-3.5 rounded-xl hover:bg-slate-800 transition-all shadow-md w-full md:w-auto flex items-center justify-center gap-2 tracking-wide uppercase">
                                <i class="las la-paper-plane text-lg"></i> <?= $lang === 'kz' ? 'Жіберу' : 'Отправить комментарий' ?>
                            </button>
                        </form>

                    <!-- Список комментов -->
                    <div class="space-y-6">
                        <?php if (!empty($comments)):
                            foreach ($comments as $comment): ?>
                                <div class="flex gap-4">
                                    <!-- Аватар -->
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center font-bold text-slate-600 uppercase select-none">
                                        <?= mb_substr($comment['author_name'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-bold text-slate-900 text-sm">
                                                <?= htmlspecialchars($comment['author_name']) ?>
                                            </span>
                                            <span class="text-[11px] font-semibold tracking-widest text-slate-400 uppercase">
                                                <i class="las la-clock"></i> <?= date('d.m.Y', strtotime($comment['created_at'])) ?>
                                            </span>
                                        </div>
                                        <p
                                            class="text-sm text-slate-700 leading-relaxed bg-white p-4 rounded-2xl rounded-tl-none border border-slate-200 shadow-sm inline-block font-medium">
                                            <?= nl2br(htmlspecialchars($comment['comment_text'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; else: ?>
                            <p class="text-center text-sm font-semibold text-slate-400 italic py-4">
                                <?= $lang === 'kz' ? 'Әзірге пікір жоқ. Алғашқы болыңыз!' : 'Комментариев пока нет. Будьте первым!' ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </article>

        <!-- === ПРАВАЯ КОЛОНКА (SIDEBAR) === -->
        <aside class="lg:col-span-4 space-y-8">
            <div class="sticky top-24">

                <!-- Виджет: По теме -->
                <div
                    class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 overflow-hidden">
                    <h3 class="font-bold text-lg text-slate-900 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-slate-900 rounded-full"></span>
                        <i class="las la-newspaper text-slate-900 text-2xl"></i>
                        <?= $lang === 'kz' ? 'Ұқсас жаңалықтар' : 'Читайте также' ?>
                    </h3>

                    <div class="flex flex-col gap-4">
                        <?php if (isset($relatedPosts) && !empty($relatedPosts)):
                            // Берем 4 похожих новости
                            foreach (array_slice($relatedPosts, 0, 4) as $rel):
                                $rTitle = $lang === 'kz' ? $rel['title_kz'] : $rel['title_ru'];
                                $rLink = "/" . ($lang === 'ru' ? 'ru/' : '') . ($rel['category_slug'] ?? 'news') . "/" . ($lang === 'kz' ? $rel['slug_kz'] : $rel['slug_ru']);
                                $rImg = !empty($rel['image']) ? "/uploads/thumbnail/" . $rel['image'] : null;
                                ?>
                                <a href="<?= $rLink ?>"
                                    class="flex gap-3 group hover:bg-slate-50 p-3 rounded-2xl transition-all duration-300 border border-transparent hover:border-slate-200">
                                    <?php if ($rImg): ?>
                                        <img src="<?= $rImg ?>"
                                            class="w-20 h-20 rounded-xl object-cover flex-shrink-0 bg-slate-100 border border-slate-200 group-hover:scale-105 transition-transform">
                                    <?php endif; ?>
                                    <div class="flex flex-col justify-center">
                                        <h4
                                            class="text-sm font-semibold leading-tight text-slate-900 group-hover:text-slate-500 transition-colors line-clamp-3">
                                            <?= htmlspecialchars($rTitle) ?>
                                        </h4>
                                        <span
                                            class="text-[11px] text-slate-400 mt-2 font-bold uppercase tracking-widest flex items-center gap-1.5">
                                            <i class="las la-clock text-sm"></i> <?= date('d.m.Y', strtotime($rel['published_at'])) ?>
                                        </span>
                                    </div>
                                </a>
                            <?php endforeach; else: ?>
                            <div class="text-sm text-slate-500 font-medium">Похожих новостей не найдено</div>
                        <?php endif; ?>
                    </div>

                    <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?><?= $post['category_slug'] ?? '' ?>"
                        class="block mt-6 text-center text-sm font-bold uppercase tracking-widest text-slate-600 border border-slate-200 py-3 rounded-xl bg-slate-50 hover:bg-slate-100 hover:text-slate-900 transition-all shadow-sm flex items-center justify-center gap-2">
                        <?= $lang === 'kz' ? 'Барлығын қарау' : 'Все новости рубрики' ?> <i class="las la-arrow-right"></i>
                    </a>
                </div>

                <!-- РЕКЛАМА В САЙДБАРЕ -->
                <?php
                $adsToShow = !empty($sidebarAds) ? $sidebarAds : (!empty($contentAds) ? $contentAds : null);
                if ($adsToShow): ?>
                    <div class="mt-8 bg-slate-50 rounded-3xl border border-slate-200 shadow-sm p-6 text-center">
                        <div
                            class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center justify-center gap-2">
                            <i class="las la-ad text-sm"></i> <?= $lang === 'kz' ? 'Жарнама' : 'Реклама' ?>
                        </div>
                        <?php
                        $ads = $adsToShow;
                        require __DIR__ . '/../partials/_ads.php';
                        ?>
                    </div>
                <?php endif; ?>

            </div>
        </aside>

    </div>
</main>

<script>
    // JS: Прогресс бар чтения
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById("scrollProgress").style.width = scrolled + "%";
    });
</script>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>