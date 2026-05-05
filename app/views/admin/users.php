<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администраторлар - Admin</title>
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
                <h2 class="text-xl font-semibold text-gray-800">Администраторлар / Администраторы</h2>
                <button onclick="document.getElementById('create-modal').classList.remove('hidden')"
                    class="bg-[#1C3D81] hover:bg-red-700 text-white px-6 py-2 rounded shadow">
                    <i class="fas fa-user-plus mr-2"></i>Қосу / Добавить
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

                <!-- Таблица администраторов -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Аты / Имя
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Логин</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Рөлі / Роль
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Әрекеттер
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($users as $user): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <?= $user['id'] ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">
                                                <?= mb_substr($user['full_name'], 0, 1, 'UTF-8') ?>
                                            </div>
                                            <div class="font-medium text-gray-900">
                                                <?= htmlspecialchars($user['full_name']) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <?= htmlspecialchars($user['username']) ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <?= htmlspecialchars($user['email']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800 font-medium">
                                            <?= $user['role'] === 'admin' ? 'Админ' : $user['role'] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button
                                                onclick="showPasswordModal(<?= $user['id'] ?>, '<?= htmlspecialchars($user['username']) ?>')"
                                                class="text-blue-600 hover:text-blue-800" title="Сменить пароль">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            <?php if ($user['id'] != $_SESSION['admin_user_id']): ?>
                                                <button
                                                    onclick="deleteUser(<?= $user['id'] ?>, '<?= htmlspecialchars($user['username']) ?>')"
                                                    class="text-red-600 hover:text-red-800" title="Удалить">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <!-- Modal создания -->
    <div id="create-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Жаңа админ / Новый администратор</h3>
                <button onclick="document.getElementById('create-modal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="/admin/users/create" method="POST">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Толық аты / Полное имя</label>
                        <input type="text" name="full_name" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Логин</label>
                        <input type="text" name="username" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Құпия сөз / Пароль</label>
                        <input type="password" name="password" required minlength="6"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Растау / Подтверждение</label>
                        <input type="password" name="password_confirm" required minlength="6"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('create-modal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">
                        Болдырмау / Отмена
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#1C3D81] text-white rounded hover:bg-red-700">
                        Қосу / Создать
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal смены пароля -->
    <div id="password-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Құпия сөзді өзгерту / Смена пароля</h3>
                <button onclick="document.getElementById('password-modal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="/admin/users/changePassword" method="POST" id="password-form">
                <input type="hidden" name="user_id" id="password-user-id">

                <p class="text-sm text-gray-600 mb-4">Пайдаланушы: <strong id="password-username"></strong></p>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Жаңа құпия сөз / Новый пароль</label>
                        <input type="password" name="new_password" required minlength="6"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Растау / Подтверждение</label>
                        <input type="password" name="confirm_password" required minlength="6"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <div class="flex gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('password-modal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">
                        Болдырмау / Отмена
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#1C3D81] text-white rounded hover:bg-red-700">
                        Өзгерту / Изменить
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPasswordModal(userId, username) {
            document.getElementById('password-user-id').value = userId;
            document.getElementById('password-username').textContent = username;
            document.getElementById('password-modal').classList.remove('hidden');
        }

        function deleteUser(userId, username) {
            if (!confirm(`Өшіруге сенімдісіз бе?\nУдалить администратора "${username}"?`)) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/users/delete';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'user_id';
            input.value = userId;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
<?php
$helpPage = 'users';
include __DIR__ . '/partials/_help_button.php';
include __DIR__ . '/partials/_help_modal.php';
?>

</body>

</html>