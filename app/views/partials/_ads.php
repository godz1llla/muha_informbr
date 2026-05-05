<?php
/**
 * _ads.php - Показ рекламных баннеров
 * Ожидает массив $ads
 */
?>

<?php if (isset($ads) && !empty($ads)): ?>
    <div class="flex flex-col gap-6">
        <?php foreach ($ads as $ad): ?>
            <div
                class="group relative overflow-hidden rounded-2xl md:rounded-3xl border border-slate-200 dark:border-white/10 shadow-lg transition-all duration-500 hover:shadow-2xl hover:border-brand/30 bg-white dark:bg-black">
                <a href="<?= htmlspecialchars($ad['link'] ?? '#') ?>" target="_blank" class="block relative overflow-hidden">
                    <img src="/uploads/large/<?= $ad['image'] ?>" alt="<?= htmlspecialchars($ad['title'] ?? 'Реклама') ?>"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                        loading="lazy">

                    <!-- Декоративное наложение при наведении -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <!-- Метка "Реклама" -->
                    <span
                        class="absolute top-2 right-2 bg-black/50 backdrop-blur-md text-white text-[8px] font-black px-2 py-0.5 rounded uppercase tracking-widest opacity-60">
                        <?= $lang === 'kz' ? 'Жарнама' : 'Реклама' ?>
                    </span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>