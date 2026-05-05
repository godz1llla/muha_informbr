<?php
/**
 * Бейнежазбалар архиві / Архив видео - Informnews.kz
 */

require_once __DIR__ . '/../partials/_header.php';
require_once __DIR__ . '/../partials/_navigation.php';
?>

<main class="container mx-auto px-4 py-10 lg:py-16">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <nav class="flex mb-4 text-[11px] font-bold uppercase tracking-widest text-slate-500">
                <a href="/" class="hover:text-slate-900 transition flex items-center gap-1.5"><i class="las la-home text-sm"></i> Басты бет</a>
                <span class="mx-3 text-slate-300"><i class="las la-angle-right"></i></span>
                <span class="text-slate-900 font-black">Бейнежазбалар</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 uppercase tracking-tight">
                <?= $lang === 'kz' ? 'Бейнежазбалар' : 'Видеогалерея' ?>
            </h1>
        </div>
        <div class="h-px flex-1 bg-slate-200 mx-8 hidden lg:block"></div>
        <div
            class="text-[11px] font-black text-slate-500 uppercase tracking-widest bg-slate-50 px-4 py-2 rounded-lg border border-slate-200 shadow-sm">
            Барлығы:
            <?= $totalVideos ?? 0 ?>
        </div>
    </div>

    <!-- Videos Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <?php if (isset($videos) && !empty($videos)): ?>
            <?php foreach ($videos as $video):
                $vTitle = $lang === 'kz' ? $video['title_kz'] : $video['title_ru'];
                $vLink = $video['youtube_url'];
                ?>
                <div
                    class="group relative bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm transition-all hover:shadow-md hover:-translate-y-1">
                    <!-- Preview Image -->
                    <a href="<?= $vLink ?>" target="_blank" class="relative block aspect-video overflow-hidden">
                        <img src="/uploads/large/<?= $video['image'] ?>"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                            alt="<?= htmlspecialchars($vTitle) ?>">
                        <div
                            class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-all flex items-center justify-center">
                            <div
                                class="w-14 h-14 bg-white/90 backdrop-blur-md text-slate-900 rounded-full flex items-center justify-center shadow-lg transform transition group-hover:scale-110">
                                <i class="las la-play text-2xl ml-1"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Text Content -->
                    <div class="p-6 md:p-8 flex flex-col flex-1">
                        <div class="text-[11px] font-semibold text-slate-400 mb-3 flex items-center gap-1.5 uppercase tracking-widest">
                            <i class="las la-calendar text-sm"></i>
                            <?= date('d.m.Y', strtotime($video['published_at'])) ?>
                        </div>
                        <h3
                            class="text-lg font-bold text-slate-900 leading-snug group-hover:text-slate-600 transition-colors line-clamp-2">
                            <a href="<?= $vLink ?>" target="_blank">
                                <?= htmlspecialchars($vTitle) ?>
                            </a>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-20 text-center bg-slate-50 rounded-2xl border border-slate-200">
                <div class="text-slate-300 mb-4 text-5xl">
                    <i class="las la-play-circle"></i>
                </div>
                <div class="text-slate-900 font-bold uppercase tracking-widest text-sm">
                    Видеолар табылмады / Видео не найдены
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div class="flex justify-center items-center gap-2">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-900 hover:bg-slate-50 transition shadow-sm">
                    <i class="las la-angle-left text-sm"></i>
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl <?= $currentPage == $i ? 'bg-slate-900 text-white shadow-md border border-slate-900' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' ?> font-bold text-sm transition">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>"
                    class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-900 hover:bg-slate-50 transition shadow-sm">
                    <i class="las la-angle-right text-sm"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/_footer.php'; ?>