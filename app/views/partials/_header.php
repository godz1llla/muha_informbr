<!DOCTYPE html>
<html lang="<?= $lang === 'kz' ? 'kk' : 'ru' ?>" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $siteConfig = require __DIR__ . '/../../../config/app.php'; ?>
    <title>
        <?= $pageTitle ?? ($siteConfig['name'] . ' - Аймақтық ақпарат агенттігі') ?>
    </title>

    <!-- Meta Tags -->
    <?php if (isset($metaDescription)): ?>
        <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <?php endif; ?>

    <!-- Open Graph -->
    <?php if (isset($ogTitle)): ?>
        <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
        <meta property="og:description" content="<?= htmlspecialchars($ogDescription ?? '') ?>">
        <meta property="og:image" content="<?= $ogImage ?? '' ?>">
        <meta property="og:url" content="<?= $ogUrl ?? '' ?>">
    <?php endif; ?>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Иконки Line Awesome -->
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Шрифт Google Fonts: Plus Jakarta Sans -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Конфигурация темы -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand': '#09090b', // zinc-950
                        'brand-accent': '#fafafa',
                    },
                    borderRadius: {
                        'premium': '1rem',
                    },
                    boxShadow: {
                        'premium': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'premium-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025)',
                    }
                }
            }
        }
    </script>

    <script>
        // Применяем тему до рендера страницы во избежание мерцания
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: #fafafa;
        }

        .brand-red {
            background: #09090b;
        }

        .text-brand-red {
            color: #09090b;
        }

        .border-brand-red {
            border-color: #09090b;
        }

        .glass-nav {
            background: rgba(250, 250, 250, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .dark .glass-nav {
            background: rgba(9, 9, 11, 0.85);
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        .btn-premium {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .btn-premium:active {
            transform: scale(0.97);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>


<body
    class="bg-slate-50 dark:bg-zinc-950 flex flex-col min-h-screen text-slate-800 dark:text-slate-200 transition-colors duration-300">

    <!-- === HEADER (ПОВТОРЯЕТСЯ С ГЛАВНОЙ) === -->
    <div
        class="bg-white dark:bg-zinc-950 border-b border-slate-200/60 dark:border-white/10 py-2.5 hidden md:block text-sm transition-colors duration-300">
        <div class="container mx-auto px-4 flex justify-end items-center">
            <!-- Info -->
            <div
                class="flex items-center bg-slate-900 dark:bg-zinc-800 text-white rounded-xl px-5 py-2.5 space-x-6 text-sm font-medium shadow-sm transition-colors duration-300">
                <div>Қызылорда <?= number_format($weather['temperature'] ?? -5, 1) ?>°C</div>
                <div><?= date('d.m.Y') ?></div>
                <div class="border-l border-slate-700 pl-4">
                    USD: <?= number_format($currency['usd_rate'] ?? 502, 2) ?> <br> EUR:
                    <?= number_format($currency['eur_rate'] ?? 545, 2) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- === HEADER (LOGO) === -->
    <header
        class="bg-white dark:bg-zinc-950 border-b border-slate-200 dark:border-white/10 transition-colors duration-300">
        <div class="container mx-auto px-4 py-8 flex justify-between items-center">
            <a href="<?= $lang === 'ru' ? '/ru/' : '/' ?>" class="flex items-center gap-4 group cursor-pointer">
                <img src="/logo.php" alt="Informnews" class="h-16 w-auto group-hover:scale-105 transition-transform object-contain">
            </a>
        </div>
    </header>