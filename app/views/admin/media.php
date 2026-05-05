<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медиа-файлдар - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .nav-item.active {
            background-color: #1C3D81;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <?php require_once __DIR__ . '/../partials/_admin_sidebar.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header class="h-16 bg-white shadow flex justify-between items-center px-8 z-10">
                <h2 class="text-xl font-semibold text-gray-800">Медиа-файлдар / Медиа-галерея</h2>
                <button onclick="document.getElementById('upload-modal').classList.remove('hidden')"
                    class="bg-[#1C3D81] hover:bg-red-700 text-white px-6 py-2 rounded shadow">
                    <i class="fas fa-upload mr-2"></i>Жүктеу / Загрузить
                </button>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">

                <!-- Уведомления -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Галерея -->
                <?php if (empty($files)): ?>
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Файлдар жоқ</h3>
                        <p class="text-gray-500 mb-4">Медиа-файлдар жүктелмеген / Нет загруженных файлов</p>
                        <button onclick="document.getElementById('upload-modal').classList.remove('hidden')"
                            class="bg-[#1C3D81] hover:bg-red-700 text-white px-6 py-2 rounded">
                            <i class="fas fa-upload mr-2"></i>Алғашқы файлды жүктеу
                        </button>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <?php foreach ($files as $file): ?>
                            <div class="bg-white rounded-lg shadow overflow-hidden group hover:shadow-lg transition">
                                <!-- Превью -->
                                <div class="aspect-square bg-gray-100 relative overflow-hidden">
                                    <img src="<?= $file['url_thumbnail'] ?>" alt="<?= $file['filename'] ?>"
                                        class="w-full h-full object-cover cursor-pointer"
                                        onclick="showPreview('<?= $file['url_large'] ?>', '<?= $file['filename'] ?>')">

                                    <!-- Оверлей при наведении -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <button onclick="showPreview('<?= $file['url_large'] ?>', '<?= $file['filename'] ?>')"
                                            class="bg-white text-gray-800 px-3 py-1 rounded text-sm mr-2 hover:bg-gray-100">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="deleteFile('<?= $file['filename'] ?>')"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Инфо -->
                                <div class="p-3">
                                    <p class="text-xs font-medium text-gray-800 truncate" title="<?= $file['filename'] ?>">
                                        <?= $file['filename'] ?>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        <?= number_format($file['size'] / 1024, 0) ?> KB
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        <?= date('d.m.Y', $file['date']) ?>
                                    </p>

                                    <!-- Кнопка копирования URL -->
                                    <button onclick="copyUrl('<?= $file['url_large'] ?>')"
                                        class="mt-2 text-xs text-blue-600 hover:text-blue-800 w-full text-left">
                                        <i class="fas fa-copy"></i> Сілтемені көшіру
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Статистика -->
                    <div class="mt-6 bg-white rounded-lg shadow p-4">
                        <p class="text-sm text-gray-600">
                            <strong>Барлығы:</strong>
                            <?= count($files) ?> файл
                        </p>
                    </div>
                <?php endif; ?>

            </main>
        </div>
    </div>

    <!-- Modal загрузки -->
    <div id="upload-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Файл жүктеу / Загрузить файл</h3>
                <button onclick="document.getElementById('upload-modal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="/admin/media/upload" method="POST" enctype="multipart/form-data">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center mb-4 cursor-pointer hover:border-red-400 transition"
                    onclick="document.getElementById('file-input').click()">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Файлды таңдаңыз / Выберите файл</p>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF</p>
                </div>
                <input type="file" id="file-input" name="media_file" accept="image/*" required class="hidden"
                    onchange="this.form.querySelector('.text-gray-600').textContent = this.files[0].name">

                <div class="flex gap-2">
                    <button type="button" onclick="document.getElementById('upload-modal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">
                        Болдырмау / Отмена
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#1C3D81] text-white rounded hover:bg-red-700">
                        Жүктеу / Загрузить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal превью -->
    <div id="preview-modal" class="hidden fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50"
        onclick="this.classList.add('hidden')">
        <div class="max-w-4xl max-h-screen p-4">
            <img id="preview-image" src="" alt="" class="max-w-full max-h-screen rounded">
            <p id="preview-filename" class="text-white text-center mt-4"></p>
        </div>
    </div>

    <script>
        function showPreview(url, filename) {
            document.getElementById('preview-image').src = url;
            document.getElementById('preview-filename').textContent = filename;
            document.getElementById('preview-modal').classList.remove('hidden');
        }

        function deleteFile(filename) {
            if (!confirm('Файлды өшіруге сенімдісіз бе? / Удалить файл?')) return;

            // Создаем форму для POST запроса
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/media/delete';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'filename';
            input.value = filename;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        function copyUrl(url) {
            const fullUrl = window.location.origin + url;
            navigator.clipboard.writeText(fullUrl).then(() => {
                alert('Сілтеме көшірілді! / URL скопирован!');
            });
        }
    </script>
</body>

</html>