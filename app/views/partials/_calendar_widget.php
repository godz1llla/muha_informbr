<?php
/**
 * Виджет Календаря новостей
 * Стили: Glassmorphism / Premium Dark
 */

// Логика календаря
$currentMonth = date('n');
$currentYear = date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));

// Названия месяцев на двух языках
$monthsKz = [1 => 'Қаңтар', 'Ақпан', 'Наурыз', 'Сәуір', 'Мамыр', 'Маусым', 'Шілде', 'Тамыз', 'Қыркүйек', 'Қазан', 'Қараша', 'Желтоқсан'];
$monthsRu = [1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
$monthName = $lang === 'kz' ? $monthsKz[$currentMonth] : $monthsRu[$currentMonth];

// Дни недели
$daysKz = ['Дү', 'Се', 'Сә', 'Бе', 'Жұ', 'Се', 'Же'];
$daysRu = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
$weekDays = $lang === 'kz' ? $daysKz : $daysRu;

// Подсвечиваемые даты (из контроллера)
$activeDates = $calendarDates ?? [];
?>

<!-- Внутренняя структура календаря (без внешней обертки glass для интеграции) -->
<div class="flex flex-col h-full">
    <div
        class="bg-slate-50/50 dark:bg-white/5 px-4 py-2 border-y border-slate-200 dark:border-white/10 flex justify-between items-center flex-shrink-0">
        <h3
            class="font-black text-slate-900 dark:text-white text-[9px] uppercase tracking-[0.2em] flex items-center gap-2">
            <i class="far fa-calendar-alt text-brand"></i>
            <?= $monthName ?>
            <?= $currentYear ?>
        </h3>
    </div>

    <div class="p-4 flex-1 flex flex-col justify-center">
        <div class="grid grid-cols-7 gap-1 text-center mb-1">
            <?php foreach ($weekDays as $day): ?>
                <div class="text-[9px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-widest">
                    <?= $day ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Пустые ячейки до начала месяца -->
            <?php for ($i = 1; $i < $firstDayOfMonth; $i++): ?>
                <div class="h-6 md:h-7"></div>
            <?php endfor; ?>

            <!-- Дни месяца -->
            <?php for ($day = 1; $day <= $daysInMonth; $day++):
                $hasNews = in_array($day, $activeDates);
                $isToday = ($day == date('j'));
                $formattedDate = sprintf("%04d-%02d-%02d", $currentYear, $currentMonth, $day);
                $link = "/" . ($lang === 'ru' ? 'ru/' : '') . "search?date=" . $formattedDate;
                ?>
                <div class="relative group">
                    <?php if ($hasNews): ?>
                        <a href="<?= $link ?>"
                            class="flex items-center justify-center h-6 md:h-7 w-full rounded-lg text-[10px] font-bold transition-all duration-300
                                  <?= $isToday ? 'bg-brand text-white shadow-lg shadow-blue-500/30' : 'bg-slate-100 dark:bg-white/5 text-slate-900 dark:text-white hover:bg-brand hover:text-white' ?>">
                            <?= $day ?>
                            <span
                                class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-0.5 h-0.5 rounded-full <?= $isToday ? 'bg-white' : 'bg-brand shadow-[0_0_5px_rgba(28,61,129,0.8)]' ?>"></span>
                        </a>
                    <?php else: ?>
                        <div
                            class="flex items-center justify-center h-6 md:h-7 w-full rounded-lg text-[10px] text-slate-400 dark:text-slate-600 cursor-default">
                            <?= $day ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>