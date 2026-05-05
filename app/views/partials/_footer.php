<?php $siteConfig = $siteConfig ?? require __DIR__ . '/../../../config/app.php'; ?>
<!-- === FOOTER === -->
<footer class="bg-brand text-white pt-16 mt-auto transition-colors duration-300">
    <div class="container mx-auto px-4 pb-12 text-center border-b border-white/10">
        <h2 class="text-3xl font-black uppercase mb-4 tracking-tight">Informnews</h2>
        <p class="text-slate-500 text-sm mb-8 font-medium">
        </p>
        <div class="flex justify-center gap-4 text-3xl mb-8">
            <a href="<?= $siteConfig['social_telegram'] ?? '#' ?>" target="_blank" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white hover:text-brand transition-colors"><i class="lab la-telegram-plane"></i></a>
            <a href="<?= $siteConfig['social_instagram'] ?? '#' ?>" target="_blank" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white hover:text-brand transition-colors"><i class="lab la-instagram"></i></a>
            <a href="<?= $siteConfig['social_facebook'] ?? '#' ?>" target="_blank" class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white hover:text-brand transition-colors"><i class="lab la-facebook-f"></i></a>
        </div>
        
        <!-- Дополнительные ссылки для навигации -->
        <div class="flex flex-wrap justify-center gap-6 text-sm font-medium text-slate-400 mt-8">
            <a href="/<?= ($lang === 'ru' ? 'ru/' : '') ?>ads" class="hover:text-white transition">
                <?= $lang === 'kz' ? 'Жарнама' : 'Реклама на сайте' ?>
            </a>

            <a href="#" class="hover:text-white transition">
                <?= $lang === 'kz' ? 'Қолдану ережелері' : 'Условия использования' ?>
            </a>
        </div>
    </div>
    <div class="bg-brand-dark py-6 text-center transition-colors duration-300">
        <div class="text-xs font-medium text-slate-400 flex flex-col md:flex-row justify-center items-center gap-2">
            <div class="flex items-center gap-1.5">
                <i class="las la-code"></i> <?= $lang === 'kz' ? 'Әзірлеуші' : 'Разработка' ?>:
                <a href="https://hubtech.kz" target="_blank" class="text-slate-400 hover:text-white transition-colors">HUBTECH</a>
            </div>
        </div>
    </div>
</footer>

<!-- Скрипты анимаций и поведения -->
<script>
    // Плавный скролл прогресс-бара
    window.onscroll = function () {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        let progress = document.getElementById("scrollProgress");
        if (progress) progress.style.width = scrolled + "%";
    };

    // ЗАЩИТА АВТОРСКИХ ПРАВ (Copy-Trap + Inspector Block)
    document.addEventListener('copy', function (e) {
        const selection = window.getSelection().toString();
        const link = "https://whatsapp.com/channel/0029VaadnaZEawdtprQ8Kf1Q";
        e.clipboardData.setData('text/plain', selection + "\n\nДереккөз: " + link);
        e.preventDefault();
    });

    // Блокировка правой кнопки мыши
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Блокировка горячих клавиш (F12, Ctrl+Shift+I/J, Ctrl+U)
    document.onkeydown = function (e) {
        if (e.keyCode == 123) { // F12 key
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'J'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { // View source
            return false;
        }
    };
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments) };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) { if (document.scripts[j].src === r) { return; } }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=106829765', 'ym');

    ym(106829765, 'init', { ssr: true, webvisor: true, clickmap: true, ecommerce: "dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce: true, trackLinks: true });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/106829765" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>