<?php
// Важно: переменные $categories, $siteConfig, $lang уже должны быть доступны из контроллера
$weather = $weather ?? ['temperature' => -9, 'condition' => 'Ашық аспан', 'icon' => '01d'];
$currency = $currency ?? ['usd_rate' => 502, 'eur_rate' => 545, 'rub_rate' => 5.4];
?>

<!-- === МЕНЮ НАВИГАЦИИ === -->
<nav class="glass-nav border-b border-slate-200 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            
            <div class="cursor-pointer py-5 pr-4 text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition-colors" onclick="openMobileMenu()"><i class="las la-bars text-2xl"></i></div>
            
            <ul class="hidden md:flex space-x-8 py-5 font-semibold text-[13px] text-slate-500 uppercase tracking-wider overflow-x-auto whitespace-nowrap no-scrollbar mask-image-scroll">
                <?php if (isset($categories) && !empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <?php
                        if ($cat['slug'] === 'zhanalyqtar' || $cat['slug'] === 'novosti') {
                            $catUrl = $lang === 'ru' ? '/ru/' : '/';
                        } else {
                            $catUrl = '/' . ($lang === 'ru' ? 'ru/' : '') . $cat['slug'];
                        }
                        ?>
                        <li>
                            <a href="<?= $catUrl ?>" class="hover:text-slate-900 cursor-pointer transition-colors block">
                                <?= mb_strtoupper(htmlspecialchars($cat['name'])) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            
            <div class="flex items-center space-x-5 text-slate-400 pl-6 border-l border-slate-200">
                <i class="las la-search cursor-pointer hover:text-slate-900 text-xl transition-colors" onclick="openSearchModal()"></i>
                <i class="las la-moon cursor-pointer hover:text-slate-900 text-xl transition-colors" onclick="toggleTheme()"></i>
                
                <?php
                $switchUrl = '/';
                if (isset($post) && !empty($post)) {
                    $targetLang = $lang === 'kz' ? 'ru' : 'kz';
                    $categorySlug = $post["slug_{$targetLang}"] ?? $post['category_slug'] ?? '';
                    $postSlug = $post["slug_{$targetLang}"] ?? '';
                    $switchUrl = (!empty($categorySlug) && !empty($postSlug))
                        ? ($targetLang === 'ru' ? '/ru/' : '/') . $categorySlug . '/' . $postSlug
                        : ($targetLang === 'ru' ? '/ru/' : '/');
                } elseif (isset($category) && !empty($category)) {
                    $targetLang = $lang === 'kz' ? 'ru' : 'kz';
                    $categorySlug = $category["slug_{$targetLang}"] ?? '';
                    $switchUrl = !empty($categorySlug) ? ($targetLang === 'ru' ? '/ru/' : '/') . $categorySlug : ($targetLang === 'ru' ? '/ru/' : '/');
                } else {
                    $switchUrl = $lang === 'kz' ? '/ru/' : '/';
                }
                ?>
                <a href="<?= $switchUrl ?>" class="cursor-pointer hover:text-slate-900 font-bold text-xs tracking-widest bg-slate-100 px-2 py-1 rounded">
                    <?= $lang === 'kz' ? 'РУС' : 'KAZ' ?>
                </a>
            </div>

        </div>
    </div>
</nav>

<style>
    /* Маска для скроллбара категорий */
    .mask-image-scroll {
        mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    }

    /* Скрытие скроллбара */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<?php
// Functions will be implemented in script below
?>

<script>
    // Модальное окно поиска
    function openSearchModal() {
        const modal = document.getElementById('searchModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => document.getElementById('searchInput').focus(), 100);
        document.body.style.overflow = 'hidden';
    }

    function closeSearchModal() {
        const modal = document.getElementById('searchModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Мобильное меню
    function openMobileMenu() {
        document.getElementById('mobileMenu').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        document.getElementById('mobileMenu').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Переключение темы
    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        if (newTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        // Сохраняем в localStorage
        localStorage.setItem('theme', newTheme);
    }

    // Горячие клавиши
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearchModal();
            closeMobileMenu();
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearchModal();
        }
    });
</script>
<!-- Модальное окно поиска -->
<div id="searchModal"
    class="fixed inset-0 bg-slate-900/80 backdrop-blur-xl z-[100] hidden items-center justify-center p-4 transition-opacity duration-500"
    onclick="closeSearchModal()">
    <div class="bg-white dark:bg-zinc-950 border border-slate-200 dark:border-white/10 rounded-3xl shadow-2xl max-w-2xl w-full p-10 transition-colors duration-300"
        onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                <span class="w-10 h-10 bg-slate-100 dark:bg-zinc-900 rounded-xl flex items-center justify-center border border-slate-200 dark:border-white/10 shadow-sm transition-colors duration-300">
                    <i class="las la-search text-slate-900 dark:text-white text-lg"></i>
                </span>
                <?= $lang === 'kz' ? 'Іздеу' : 'Поиск' ?>
            </h3>
            <button onclick="closeSearchModal()"
                class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-900 hover:bg-slate-200 dark:hover:bg-zinc-800 transition border border-slate-200 dark:border-white/10 flex items-center justify-center"><i
                    class="las la-times text-slate-900 dark:text-white text-lg"></i></button>
        </div>
        <form action="/<?= $lang === 'ru' ? 'ru/' : '' ?>search" method="GET">
            <div class="relative mb-4">
                <i class="las la-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
                <input type="text" name="q" id="searchInput" placeholder="<?= $lang === 'kz' ? 'Іздеу...' : 'Поиск...' ?>"
                    class="w-full pl-12 pr-6 py-4 bg-slate-50 dark:bg-zinc-900 border border-slate-200 dark:border-white/10 rounded-2xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900 dark:focus:ring-white transition-all shadow-inner"
                    autofocus>
            </div>
            <button type="submit"
                class="w-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-semibold py-4 rounded-2xl shadow-md hover:bg-slate-800 dark:hover:bg-slate-200 transition-all flex items-center justify-center gap-2">
                <i class="las la-arrow-right"></i> <?= $lang === 'kz' ? 'Іздеу' : 'Найти' ?>
            </button>
        </form>
    </div>
</div>

<!-- Мобильное меню -->
<div id="mobileMenu" class="fixed inset-0 bg-white/98 dark:bg-zinc-950/98 backdrop-blur-2xl z-[90] hidden transition-colors duration-300">
    <div class="h-full p-6 md:p-8 overflow-y-auto relative z-10">
        <!-- Шапка меню -->
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-4 group cursor-pointer">
                <img src="/logo.php" alt="Informnews" class="h-16 md:h-20 w-auto object-contain">
            </div>
            <button onclick="closeMobileMenu()"
                class="w-12 h-12 rounded-full bg-slate-100 dark:bg-zinc-900 hover:bg-slate-900 dark:hover:bg-white transition-all flex items-center justify-center border border-slate-200 dark:border-white/10 group">
                <i class="las la-times text-slate-900 dark:text-white group-hover:text-white dark:group-hover:text-slate-900 text-xl"></i>
            </button>
        </div>

        <!-- Поиск в мобильном меню -->
        <div class="mb-8">
            <form action="/<?= $lang === 'ru' ? 'ru/' : '' ?>search" method="GET">
                <div class="relative">
                    <input type="text" name="q" placeholder="<?= $lang === 'kz' ? 'Іздеу...' : 'Поиск...' ?>"
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-zinc-900 border border-slate-200 dark:border-white/10 rounded-2xl text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-900/40 dark:focus:ring-white/40">
                    <i class="las la-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
                </div>
            </form>
        </div>

        <!-- Заголовок категорий -->
        <div
            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4 flex items-center gap-3">
            <span class="w-1 h-4 bg-slate-900 dark:bg-white rounded-full"></span>
            <?= $lang === 'kz' ? 'Бөлімдер' : 'Категории' ?>
        </div>

        <!-- Категории -->
        <div class="space-y-2 mb-10">
            <?php if (isset($categories) && !empty($categories)):
                foreach ($categories as $cat):
                    $catUrl = ($cat['slug'] === 'zhanalyqtar' || $cat['slug'] === 'novosti')
                        ? ($lang === 'ru' ? '/ru/' : '/')
                        : '/' . ($lang === 'ru' ? 'ru/' : '') . $cat['slug'];
                    ?>
                    <a href="<?= $catUrl ?>"
                        class="px-6 py-4 rounded-2xl text-slate-800 dark:text-slate-200 font-semibold hover:bg-slate-100 dark:hover:bg-zinc-900 transition-all duration-300 border border-transparent hover:border-slate-200 dark:hover:border-white/10 flex items-center justify-between group shadow-sm">
                        <span class="flex items-center gap-3">
                            <i class="las la-folder-open text-lg text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white"></i>
                            <?= htmlspecialchars($cat['name']) ?>
                        </span>
                        <i
                            class="las la-arrow-right text-slate-400 opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                    </a>
                <?php endforeach; ?>

                <!-- Mobile Video Link -->
                <a href="/<?= $lang === 'ru' ? 'ru/' : '' ?>videos"
                    class="px-6 py-4 rounded-2xl text-slate-800 dark:text-slate-200 font-semibold hover:bg-slate-100 dark:hover:bg-zinc-900 transition-all duration-300 border border-transparent hover:border-slate-200 dark:hover:border-white/10 flex items-center justify-between group shadow-sm">
                    <span class="flex items-center gap-3">
                        <i class="las la-play-circle text-lg text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white"></i>
                        <?= $lang === 'kz' ? 'Бейнежазбалар' : 'Видеогалерея' ?>
                    </span>
                    <i
                        class="las la-arrow-right opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- Социальные сети -->
        <div class="border-t border-slate-200 pt-8">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-4">
                <?= $lang === 'kz' ? 'Біздің желілер' : 'Соц. сети' ?>
            </div>
            <div class="flex gap-3">
                <a href="<?= $siteConfig['social_instagram'] ?? '#' ?>" target="_blank"
                    class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white transition-all">
                    <i class="lab la-instagram text-xl"></i>
                </a>
                <a href="<?= $siteConfig['social_telegram'] ?? '#' ?>" target="_blank"
                    class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white transition-all">
                    <i class="lab la-telegram-plane text-xl"></i>
                </a>
                <a href="<?= $siteConfig['social_tiktok'] ?? '#' ?>" target="_blank"
                    class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white transition-all">
                    <i class="lab la-tiktok text-xl"></i>
                </a>
                <a href="https://wa.me/77470645196" target="_blank"
                    class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-900 hover:text-white transition-all">
                    <i class="lab la-whatsapp text-xl"></i>
                </a>
            </div>
        </div>
    </div>
</div>