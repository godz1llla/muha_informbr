<!-- Кнопка помощи (фиксированная в углу) -->
<button onclick="openHelp()"
    class="help-button fixed bottom-6 right-6 w-14 h-14 bg-[#1C3D81] hover:bg-red-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center z-40 group"
    title="Анықтама ашу (F1)">
    <i class="fas fa-question text-2xl group-hover:scale-110 transition-transform"></i>

    <!-- Пульсирующий эффект -->
    <span class="absolute inset-0 rounded-full bg-[#1C3D81] animate-ping opacity-20"></span>
</button>

<style>
    /* Пульсация для привлечения внимания */
    @keyframes ping {

        75%,
        100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    /* Tooltip для кнопки */
    .help-button:hover::before {
        content: 'Анықтама (F1)';
        position: absolute;
        bottom: 100%;
        right: 0;
        background: #1F1F1F;
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        white-space: nowrap;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }
</style>