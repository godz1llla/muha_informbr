<?php $this->view('partials/_header', ['pageTitle' => $pageTitle, 'lang' => $lang]); ?>
<?php $this->view('partials/_navigation', ['categories' => $categories, 'lang' => $lang, 'weather' => $weather, 'currency' => $currency]); ?>

<main class="flex-grow">
    <!-- Hero Section -->
    <section
        class="relative py-20 overflow-hidden bg-white/5 dark:bg-black/40 border-b border-slate-200 dark:border-white/5">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand/10 rounded-full filter blur-[120px]"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-blue-600/5 rounded-full filter blur-[100px]"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-6">
                <?= $lang === 'kz' ? 'Редакция' : 'Редакция' ?>
            </h1>
            <div class="flex items-center justify-center gap-4">
                <span class="h-1 w-12 bg-brand rounded-full"></span>
                <p class="text-brand font-serif italic text-xl md:text-2xl">Informnews.kz</p>
                <span class="h-1 w-12 bg-brand rounded-full"></span>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 md:py-24 container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div
                class="glass p-8 md:p-12 rounded-3xl border border-slate-200 dark:border-white/10 shadow-2xl relative overflow-hidden">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand/5 rounded-bl-full"></div>

                <div class="prose prose-lg dark:prose-invert max-w-none">
                    <?php if ($lang === 'kz'): ?>
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-6 font-medium">
                            Informnews.kz – өңірдегі және ел көлеміндегі өзекті әлеуметтік, экономикалық және
                            қоғамдық-саяси жаңалықтарды жедел әрі сапалы жариялайтын ақпарат агенттігі. Басылымның негізгі
                            бағыты – ақпараттық, талдамалы және танымдық контент ұсыну.
                        </p>
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-10 font-medium">
                            Агенттік сайтында күн сайынғы жаңалықтармен қатар, сараптамалық мақалалар, арнайы репортаждар,
                            сұхбаттар және авторлық шығармашылық материалдар тұрақты түрде жарияланып тұрады. Informnews.kz
                            оқырманға шынайы ақпарат ұсынып қана қоймай, маңызды мәселелерге терең талдау жасап,
                            қоғамдық пікір қалыптастыруға үлес қосуды мақсат етеді.
                        </p>

                        <div
                            class="mt-16 pt-10 border-t border-slate-200 dark:border-white/10 flex flex-col md:flex-row items-center gap-10">
                            <div class="relative group">
                                <div
                                    class="w-48 md:w-64 rounded-2xl overflow-hidden border-4 border-brand/20 group-hover:border-brand transition-all duration-500 shadow-2xl">
                                    <img src="/assets/aslan.png" alt="Aslan Sagyndyk"
                                        class="w-full h-auto transition-all duration-700">
                                </div>
                                <!-- Decorative glow -->
                                <div
                                    class="absolute -inset-4 bg-brand/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10">
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <h3
                                    class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-2">
                                    Аслан Сағындық</h3>
                                <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Ақпарат агенттігінің
                                    бас редакторы</p>
                                <div class="flex gap-4 justify-center md:justify-start">
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-telegram-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-6 font-medium">
                            Informnews.kz — это информационное агентство, оперативно и качественно освещающее актуальные
                            социальные, экономические и общественно-политические новости региона и страны. Основное
                            направление издания — предоставление информационного, аналитического и познавательного контента.
                        </p>
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-10 font-medium">
                            На сайте агентства, помимо ежедневных новостей, регулярно публикуются аналитические статьи,
                            специальные репортажи, интервью и авторские творческие материалы. Цель Informnews.kz — не
                            просто предоставлять читателям достоверную информацию, но и проводить глубокий анализ значимых
                            проблем, внося свой вклад в формирование общественного мнения.
                        </p>

                        <div
                            class="mt-16 pt-10 border-t border-slate-200 dark:border-white/10 flex flex-col md:flex-row items-center gap-10">
                            <div class="relative group">
                                <div
                                    class="w-48 md:w-64 rounded-2xl overflow-hidden border-4 border-brand/20 group-hover:border-brand transition-all duration-500 shadow-2xl">
                                    <img src="/assets/aslan.png" alt="Аслан Сагындык"
                                        class="w-full h-auto transition-all duration-700">
                                </div>
                                <!-- Decorative glow -->
                                <div
                                    class="absolute -inset-4 bg-brand/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 -z-10">
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <h3
                                    class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-2">
                                    Аслан Сагындык</h3>
                                <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Главный редактор
                                    информационного агентства</p>
                                <div class="flex gap-4 justify-center md:justify-start">
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:bg-brand hover:text-white transition-all"><i
                                            class="fab fa-telegram-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->view('partials/_footer', ['categories' => $categories, 'lang' => $lang]); ?>