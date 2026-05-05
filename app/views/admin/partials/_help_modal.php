<?php
/**
 * Компонент: Модальное окно справки
 * 
 * Использование:
 * include __DIR__ . '/partials/_help_modal.php';
 * 
 * Параметры:
 * $helpPage - название страницы (dashboard, posts-list, post-editor и т.д.)
 */

// Загружаем инструкции
$helpTexts = require __DIR__ . '/../../../helpers/HelpContent.php';

// Получаем контент для текущей страницы
$helpData = $helpTexts[$helpPage] ?? [
    'title' => 'Анықтама',
    'content' => '<p>Нұсқаулық әзірлену үстінде...</p>'
];
?>

<!-- Модальное окно справки -->
<div id="helpModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 animate-fadeIn">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[85vh] overflow-hidden transform transition-all animate-slideUp"
        onclick="event.stopPropagation()">

        <!-- Заголовок -->
        <div class="bg-gradient-to-r from-[#1C3D81] to-red-600 text-white px-6 py-4 flex justify-between items-center">
            <h3 class="text-2xl font-bold flex items-center gap-3">
                <i class="fas fa-question-circle"></i>
                <span><?= $helpData['title'] ?></span>
            </h3>
            <button onclick="closeHelp()"
                class="text-white/80 hover:text-white transition-colors text-3xl leading-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Контент (с прокруткой) -->
        <div class="p-6 overflow-y-auto max-h-[calc(85vh-80px)] prose prose-sm max-w-none">
            <?= $helpData['content'] ?>
        </div>

        <!-- Футер -->
        <div class="bg-gray-50 px-6 py-3 flex justify-between items-center border-t">
            <p class="text-xs text-gray-500">
                💡 Кеңес: <kbd class="px-2 py-1 bg-gray-200 rounded text-xs">Esc</kbd> басып жабуға болады
            </p>
            <button onclick="closeHelp()"
                class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm transition">
                Жабу
            </button>
        </div>

    </div>
</div>

<style>
    /* Анимации */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }

    .animate-slideUp {
        animation: slideUp 0.3s ease-out;
    }

    /* Стили для контента */
    #helpModal .prose h4 {
        margin-top: 0;
    }

    #helpModal .prose ul {
        margin-top: 0.5rem;
    }

    #helpModal kbd {
        font-family: monospace;
        font-size: 0.9em;
    }
</style>

<script>
    // Функции управления модалкой
    function openHelp() {
        const modal = document.getElementById('helpModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeHelp() {
        const modal = document.getElementById('helpModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Закрытие по клику вне модалки
    document.getElementById('helpModal')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeHelp();
        }
    });

    // Закрытие по Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeHelp();
        }
    });

    // Горячая клавиша F1 для открытия справки
    document.addEventListener('keydown', function (e) {
        if (e.key === 'F1') {
            e.preventDefault();
            openHelp();
        }
    });
</script>