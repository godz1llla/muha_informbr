<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($post) ? 'Редактировать' : 'Новая' ?> мақала - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CKEditor 5 Classic Build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <style>
        .tab-btn.active {
            border-bottom: 2px solid #1C3D81;
            color: #1C3D81;
            font-weight: bold;
        }
        
        /* CKEditor стили */
        .ck-editor__editable {
            min-height: 400px;
        }
        
        .ck.ck-editor {
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Шапка (упрощенная) -->
    <header class="bg-[#1F1F1F] text-white h-14 flex items-center justify-between px-4 md:px-6">
        <div class="font-bold flex items-center gap-1 md:gap-2">
            <a href="/admin" class="text-gray-400 hover:text-white flex items-center gap-1 md:gap-2"><i class="fas fa-arrow-left"></i> <span class="hidden sm:inline">Артқа</span></a>
            <span class="mx-1 md:mx-2 text-gray-500 hidden sm:inline">|</span>
            <span class="text-sm line-clamp-1"><?= isset($post) ? 'Мақаланы өзгерту' : 'Жаңа мақала қосу' ?></span>
        </div>
        <button type="submit" form="post-form" class="text-xs md:text-sm bg-red-600 hover:bg-red-700 px-3 md:px-4 py-1.5 md:py-1 rounded flex items-center gap-1">
            <i class="fas fa-save md:hidden"></i>
            <span class="hidden md:inline">Сақтау (Save)</span>
            <span class="md:hidden">Сақтау</span>
        </button>
    </header>

    <div class="container mx-auto p-6">

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form id="post-form" action="<?= isset($post) ? '/admin/posts/update/' . $post['id'] : '/admin/posts/store' ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Левая колонка (70%) - Контент -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Блок заголовка и контента с Табами -->
                <div class="bg-white shadow rounded-lg overflow-hidden">

                    <!-- Tabs Header -->
                    <div class="flex border-b border-gray-200">
                        <button type="button" id="tab-btn-kz"
                                class="tab-btn active px-6 py-3 w-1/2 text-sm uppercase transition bg-gray-50 hover:bg-white"
                                onclick="switchTab('kz')">
                            🇰🇿 Қазақша (Негізгі)
                        </button>
                        <button type="button" id="tab-btn-ru"
                                class="tab-btn px-6 py-3 w-1/2 text-sm uppercase transition bg-gray-50 hover:bg-white text-gray-500"
                                onclick="switchTab('ru')">
                            🇷🇺 Русский (Перевод)
                        </button>
                    </div>

                    <div class="p-6">

                        <!-- KZ TAB -->
                        <div id="tab-kz" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Тақырып (QAZ)</label>
                                <input type="text" name="title_kz"
                                       value="<?= htmlspecialchars($post['title_kz'] ?? '') ?>"
                                       class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500"
                                       placeholder="Жаңалық тақырыбын жазыңыз...">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Лид / Қысқаша мәтін (QAZ)</label>
                                <textarea name="excerpt_kz" rows="3"
                                          class="w-full border border-gray-300 rounded p-2 focus:ring-red-500 focus:border-red-500 text-sm"
                                          placeholder="Жаңалықтың қысқаша мазмұны (қызыл сызықпен шығатын мәтін)..."><?= htmlspecialchars($post['excerpt_kz'] ?? '') ?></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Мәтін (QAZ)</label>
                                <textarea id="content_kz" name="content_kz"><?= htmlspecialchars($post['content_kz'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- RU TAB (Скрыт по умолчанию) -->
                        <div id="tab-ru" class="space-y-4 hidden">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок (RU)</label>
                                <input type="text" name="title_ru"
                                       value="<?= htmlspecialchars($post['title_ru'] ?? '') ?>"
                                       class="w-full border border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Введите заголовок...">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Лид / Краткое описание (RU)</label>
                                <textarea name="excerpt_ru" rows="3"
                                          class="w-full border border-gray-300 rounded p-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                          placeholder="Краткое содержание новости (текст с красной чертой)..."><?= htmlspecialchars($post['excerpt_ru'] ?? '') ?></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Текст (RU)</label>
                                <textarea id="content_ru" name="content_ru"><?= htmlspecialchars($post['content_ru'] ?? '') ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SEO Section -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">SEO параметрлер</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="slug_kz" value="<?= htmlspecialchars($post['slug_kz'] ?? '') ?>"
                               class="border rounded p-2 text-sm" placeholder="URL-сілтеме KZ (автоматты)">
                        <input type="text" name="slug_ru" value="<?= htmlspecialchars($post['slug_ru'] ?? '') ?>"
                               class="border rounded p-2 text-sm" placeholder="URL-сілтеме RU (автоматты)">
                    </div>
                </div>

            </div>

            <!-- Правая колонка (30%) - Свойства -->
            <div class="space-y-6">

                <!-- Publish Box -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="font-bold text-sm uppercase text-gray-500 mb-3">Жариялау</h3>

                    <div class="mb-4">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="status" value="published" id="status-checkbox"
                                   <?= (!isset($post) || $post['status'] === 'published') ? 'checked' : '' ?>
                                   class="text-red-600 focus:ring-red-500 h-4 w-4">
                            <span class="text-sm">Сайтқа шығару (Published)</span>
                        </label>
                    </div>

                    <button type="submit" name="action" value="publish"
                            class="w-full bg-[#1C3D81] hover:bg-red-700 text-white font-bold py-2 rounded shadow">
                        Жариялау
                    </button>
                    <button type="submit" name="action" value="publish"
                            class="w-full mt-2 bg-gray-500 hover:bg-gray-600 text-white py-2 text-sm rounded shadow">
                        Сақтау (Save)
                    </button>
                </div>

                <!-- Категории -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="font-bold text-sm uppercase text-gray-500 mb-3">Категория</h3>
                    <div class="space-y-2 max-h-40 overflow-y-auto border border-gray-100 p-2 text-sm">
                        <?php if (isset($categories) && !empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="category_id" value="<?= $category['id'] ?>"
                                           <?= (isset($post) && $post['category_id'] == $category['id']) ? 'checked' : '' ?>>
                                    <span><?= htmlspecialchars($category['name'] ?? 'Без категории') ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Время публикации -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="font-bold text-sm uppercase text-gray-500 mb-3">
                        <i class="fas fa-clock mr-1"></i> Уақыты / Время публикации
                    </h3>
                    <input type="datetime-local" name="published_at" 
                           value="<?= isset($post['published_at']) ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : date('Y-m-d\TH:i') ?>"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1C3D81] focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-2">
                        <?= isset($post) ? 'Өзгерту үшін жаңа уақыт таңдаңыз' : 'Бос қалдырсаңыз - қазіргі уақыт қолданылады' ?>
                    </p>
                    <p class="text-xs text-gray-500">
                        <?= isset($post) ? 'Выберите новое время для изменения' : 'Оставьте пустым - будет использовано текущее время' ?>
                    </p>
                </div>

                <!-- Main Image -->
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="font-bold text-sm uppercase text-gray-500 mb-3">Басты сурет</h3>
                    
                    <!-- Превью загруженного фото -->
                    <div id="image-preview-container" class="mb-3 hidden">
                        <img id="image-preview" src="" class="w-full rounded-lg shadow-sm border border-gray-200" alt="Preview">
                        <button type="button" onclick="clearImagePreview()" 
                                class="mt-2 text-xs text-red-600 hover:text-red-800 font-medium">
                            <i class="fas fa-times"></i> Өшіру
                        </button>
                    </div>
                    
                    <!-- Текущее фото (при редактировании) -->
                    <?php if (isset($post) && !empty($post['image'])): ?>
                        <img src="/uploads/medium/<?= $post['image'] ?>" class="w-full mb-2 rounded-lg border border-gray-200" alt="Current">
                    <?php endif; ?>
                    
                    <!-- Зона загрузки -->
                    <div id="upload-zone" class="border-2 border-dashed border-gray-300 rounded-lg h-32 flex items-center justify-center cursor-pointer hover:border-red-400 bg-gray-50 transition"
                         onclick="document.getElementById('image-upload').click()">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-cloud-upload-alt text-2xl"></i>
                            <p class="text-xs mt-1">Жүктеу үшін басыңыз</p>
                            <p class="text-[10px] mt-1 text-gray-300">JPG, PNG (макс. 5MB)</p>
                        </div>
                    </div>
                    <input type="file" id="image-upload" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
                </div>

                <!-- Attr Checkboxes -->
                <div class="bg-white shadow rounded-lg p-4 text-sm">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_announcement" value="1"
                               <?= (isset($post) && $post['is_announcement']) ? 'checked' : '' ?>
                               class="text-blue-600 h-4 w-4">
                        <span>"Анонс" блогына қосу</span>
                    </label>
                    <p class="text-xs text-gray-400 mt-2 italic">
                        💡 Жаңа жаңалықтар автоматты түрде "Басты жаңалық" болып көрсетіледі
                    </p>
                </div>

            </div>
        </form>
    </div>

    <!-- JS для переключения вкладок -->
    <script>
        function switchTab(lang) {
            document.getElementById('tab-kz').classList.add('hidden');
            document.getElementById('tab-ru').classList.add('hidden');

            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active', 'text-[#1C3D81]', 'font-bold');
                btn.classList.add('text-gray-500');
            });

            document.getElementById('tab-' + lang).classList.remove('hidden');

            const activeBtn = document.getElementById('tab-btn-' + lang);
            activeBtn.classList.add('active', 'text-[#1C3D81]', 'font-bold');
            activeBtn.classList.remove('text-gray-500');
        }

        // Превью изображения при выборе
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview-container').classList.remove('hidden');
                    document.getElementById('upload-zone').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Очистить превью
        function clearImagePreview() {
            document.getElementById('image-upload').value = '';
            document.getElementById('image-preview').src = '';
            document.getElementById('image-preview-container').classList.add('hidden');
            document.getElementById('upload-zone').classList.remove('hidden');
        }

        // ===== CKEditor 5 Адаптер для загрузки изображений =====
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);

                        fetch('/admin/posts/uploadImage', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.error) {
                                return reject(result.error.message);
                            }
                            resolve({
                                default: result.url
                            });
                        })
                        .catch(err => reject('Ошибка загрузки: ' + err));
                    }));
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        // ===== Инициализация Редакторов =====
        let editorKz, editorRu;

        document.addEventListener('DOMContentLoaded', function() {
            const editorConfig = {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'uploadImage', '|',
                        'bulletedList', 'numberedList', 'blockQuote', '|',
                        'insertTable', 'undo', 'redo'
                    ]
                },
                language: 'ru'
            };

            // Инициализация для казахского редактора
            if (document.querySelector('#content_kz')) {
                ClassicEditor
                    .create(document.querySelector('#content_kz'), editorConfig)
                    .then(editor => {
                        editorKz = editor;
                        window.editorKz = editor;
                        console.log('✅ CKEditor KZ initialized');
                    })
                    .catch(error => {
                        console.error('❌ CKEditor KZ error:', error);
                    });
            }

            // Инициализация для русского редактора
            if (document.querySelector('#content_ru')) {
                ClassicEditor
                    .create(document.querySelector('#content_ru'), editorConfig)
                    .then(editor => {
                        editorRu = editor;
                        window.editorRu = editor;
                        console.log('✅ CKEditor RU initialized');
                    })
                    .catch(error => {
                        console.error('❌ CKEditor RU error:', error);
                    });
            }
        });

        // === Автоматически ставить галочку "Published" при сохранении ===
        document.getElementById('post-form').addEventListener('submit', function(e) {
            // При любом сабмите формы - автоматом ставим галочку
            const checkbox = document.getElementById('status-checkbox');
            if (checkbox && !checkbox.checked) {
                checkbox.checked = true;
            }
        });
    </script>

    <?php 
    // Компоненты справки
    $helpPage = 'post-editor';
    include __DIR__ . '/partials/_help_button.php';
    include __DIR__ . '/partials/_help_modal.php';
    ?>

</body>

</html>
