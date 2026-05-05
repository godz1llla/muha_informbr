<?php
/**
 * Ad Index Page - Informnews.kz
 */

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';
?>

<main class="container mx-auto px-4 py-12 md:py-20 lg:py-24">
    <!-- Header Section -->
    <div class="max-w-4xl mx-auto text-center mb-16 md:mb-24">
        <h1
            class="text-4xl md:text-5xl lg:text-7xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-8 animate-fade-in">
            <?= $lang === 'kz' ? 'Жарнама' : 'Реклама' ?>
        </h1>
        <div class="h-1.5 w-24 bg-brand mx-auto rounded-full shadow-[0_0_15px_rgba(214,0,35,0.4)] mb-8"></div>
        <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 font-medium leading-relaxed max-w-2xl mx-auto">
            <?= $lang === 'kz'
                ? 'Біздің порталда жарнамаңызды орналастырып,AUDITORIYAҢЫЗДЫ тауып, бизнесіңізді дамытыңыз.'
                : 'Разместите свою рекламу на нашем портале, найдите свою аудиторию и развивайте свой бизнес.' ?>
        </p>
    </div>

    <!-- Ads Gallery -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 mb-24">
        <?php if (!empty($ads)): ?>
            <?php foreach ($ads as $ad): ?>
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 dark:border-white/10 shadow-xl transition-all duration-500 hover:shadow-2xl hover:border-brand/30 bg-white dark:bg-black p-4 aspect-[4/3] flex items-center justify-center">
                    <a href="<?= htmlspecialchars($ad['link'] ?? '#') ?>" target="_blank"
                        class="block w-full h-full relative overflow-hidden rounded-2xl">
                        <img src="/uploads/large/<?= $ad['image'] ?>" alt="<?= htmlspecialchars($ad['title'] ?? 'Реклама') ?>"
                            class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-110"
                            loading="lazy">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                            <span
                                class="text-white text-xs font-black uppercase tracking-widest bg-brand px-4 py-2 rounded-xl shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <?= $lang === 'kz' ? 'Толығырақ' : 'Подробнее' ?>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div
                class="col-span-full py-20 text-center border-2 border-dashed border-slate-200 dark:border-white/5 rounded-3xl">
                <i class="fas fa-ad text-4xl text-slate-300 dark:text-slate-700 mb-6"></i>
                <p class="text-slate-500 dark:text-slate-500 font-bold uppercase tracking-widest text-sm">
                    <?= $lang === 'kz' ? 'Жарнамалар әлі жүктелмеген' : 'Рекламные баннеры еще не загружены' ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Contact Info -->
    <div
        class="max-w-4xl mx-auto glass rounded-3xl p-8 md:p-12 border border-slate-200 dark:border-white/10 shadow-2xl relative overflow-hidden">
        <!-- Decor -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand/5 rounded-full filter blur-[100px]"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
            <div>
                <h2
                    class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mb-6 uppercase tracking-tight">
                    <?= $lang === 'kz' ? 'Байланыс орталығы' : 'Свяжитесь с нами' ?>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 font-bold mb-8 italic">
                    <?= $lang === 'kz'
                        ? 'Жарнама бойынша барлық сұрақтар бойынша бізге хабарласыңыз.'
                        : 'По всем вопросам размещения рекламы обращайтесь к нашим менеджерам.' ?>
                </p>

                <div class="space-y-4">
                    <a href="tel:77470645196"
                        class="flex items-center gap-4 text-slate-900 dark:text-white font-black hover:text-brand transition-colors group">
                        <div
                            class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center group-hover:bg-brand group-hover:text-white transition-all">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        8 (747) 064 5196
                    </a>
                    <a href="https://wa.me/77470645196" target="_blank"
                        class="flex items-center gap-4 text-slate-900 dark:text-white font-black hover:text-green-500 transition-colors group">
                        <div
                            class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center group-hover:bg-green-500 group-hover:text-white transition-all text-green-500">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        WhatsApp
                    </a>
                </div>
            </div>

            <div class="bg-slate-900 dark:bg-white/5 rounded-2xl p-6 text-white border border-white/5">
                <div class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40 mb-4">Quick Stats</div>
                <div class="space-y-6">
                    <div class="flex justify-between items-center border-b border-white/5 pb-4">
                        <span class="text-sm font-bold opacity-60">Daily Views</span>
                        <span class="text-xl font-black text-brand">5,000+</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/5 pb-4">
                        <span class="text-sm font-bold opacity-60">Engagement</span>
                        <span class="text-xl font-black text-brand">85%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold opacity-60">Active Users</span>
                        <span class="text-xl font-black text-brand">10k+</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>