<!-- Mobile Menu Toggle Button -->
<button onclick="toggleAdminSidebar()" class="md:hidden fixed top-3 left-4 z-50 bg-slate-100 hover:bg-slate-200 shadow-sm p-2 rounded-lg text-slate-800 transition-colors">
    <i class="las la-bars text-xl leading-none"></i>
</button>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden md:hidden transition-opacity" onclick="toggleAdminSidebar()"></div>

<!-- SIDEBAR (Меню) -->
<aside id="adminSidebar" class="w-64 bg-slate-900 text-slate-400 flex flex-col border-r border-slate-800 shadow-xl absolute inset-y-0 left-0 z-50 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Branding -->
    <div class="h-16 flex items-center justify-center border-b border-slate-800 bg-slate-900/50">
        <span class="text-white font-bold tracking-tight text-lg flex items-center gap-2">
            Informnews <span class="bg-blue-600 text-white text-[10px] px-1.5 py-0.5 rounded font-black tracking-widest uppercase">CMS</span>
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3">
        <ul class="space-y-1.5">
            <!-- Dashboard -->
            <li>
                <a href="/admin"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'dashboard' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-chart-line text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Басты бет</span>
                </a>
            </li>

            <!-- Posts Section -->
            <li class="px-4 pt-4 pb-2 text-[10px] font-bold uppercase text-slate-500 tracking-wider">Контент</li>
            <li>
                <a href="/admin/posts"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'posts' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-newspaper text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Жаңалықтар</span>
                </a>
            </li>
            <li>
                <a href="/admin/comments"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'comments' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-comments text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Пікірлер</span>
                    <?php if (isset($pendingCount) && $pendingCount > 0): ?>
                        <span class="ml-auto bg-blue-600 text-white text-[10px] font-bold rounded-md px-2 py-0.5">
                            <?= $pendingCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="/admin/categories"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'categories' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-tags text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Категориялар</span>
                </a>
            </li>
            <li>
                <a href="/admin/media"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'media' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-image text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Медиа-файлдар</span>
                </a>
            </li>
            <li>
                <a href="/admin/videos"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'videos' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-play-circle text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Бейнежазбалар</span>
                </a>
            </li>
            <li>
                <a href="/admin/ads"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'ads' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-ad text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Жарнама</span>
                </a>
            </li>

            <!-- System Section -->
            <li class="px-4 pt-4 pb-2 text-[10px] font-bold uppercase text-slate-500 tracking-wider">Жүйе</li>
            <li>
                <a href="/admin/users"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'users' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-users text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Администраторлар</span>
                </a>
            </li>
            <li>
                <a href="/admin/settings"
                    class="nav-item <?= isset($activeTab) && $activeTab === 'settings' ? 'active' : '' ?> flex items-center px-4 py-2.5 rounded-lg hover:bg-slate-800 hover:text-white transition-colors text-sm font-medium group">
                    <i class="las la-cog text-lg w-7 text-slate-500 group-hover:text-white transition-colors"></i>
                    <span>Настройки</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Info -->
    <div class="border-t border-slate-800 p-4 bg-slate-900/80 m-3 rounded-xl mb-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                <?= mb_substr($_SESSION['admin_full_name'] ?? 'A', 0, 1, 'UTF-8') ?>
            </div>
            <div class="flex-1 overflow-hidden">
                <div class="text-white text-sm font-semibold truncate">
                    <?= htmlspecialchars($_SESSION['admin_full_name'] ?? 'Admin User') ?>
                </div>
                <a href="/admin/logout" class="text-xs text-slate-400 hover:text-white transition-colors flex items-center gap-1 mt-0.5">
                    <i class="las la-sign-out-alt"></i> Шығу
                </a>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Adjust header padding on mobile so title doesn't overlap the menu button */
    @media (max-width: 768px) {
        header { padding-left: 3.5rem !important; }
    }
</style>

<script>
    function toggleAdminSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }
</script>