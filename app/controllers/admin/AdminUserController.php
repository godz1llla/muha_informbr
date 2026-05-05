<?php
/**
 * AdminUserController - Управление администраторами
 */

namespace admin;

require_once __DIR__ . '/../../../core/Controller.php';

class AdminUserController extends \Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();

        // Проверка авторизации
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->redirect('/admin/login');
            exit;
        }

        $this->userModel = $this->model('UserModel');
    }

    /**
     * Список администраторов
     */
    public function index()
    {
        $users = $this->userModel->all();

        $this->view('admin/users', [
            'users' => $users,
            'activeTab' => 'users'
        ]);
    }

    /**
     * Создание нового администратора
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->post('username');
            $email = $this->post('email');
            $fullName = $this->post('full_name');
            $password = $this->post('password');
            $passwordConfirm = $this->post('password_confirm');

            // Валидация
            if (empty($username) || empty($email) || empty($fullName) || empty($password)) {
                $_SESSION['error'] = 'Все поля обязательны';
                $this->redirect('/admin/users');
                return;
            }

            if ($password !== $passwordConfirm) {
                $_SESSION['error'] = 'Пароли не совпадают';
                $this->redirect('/admin/users');
                return;
            }

            // Проверка существующего пользователя
            $existing = $this->userModel->whereOne('username', $username);
            if ($existing) {
                $_SESSION['error'] = 'Пользователь с таким логином уже существует';
                $this->redirect('/admin/users');
                return;
            }

            // Создание
            try {
                $this->userModel->insert([
                    'username' => $username,
                    'email' => $email,
                    'full_name' => $fullName,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => 'admin'
                ]);

                $_SESSION['success'] = 'Администратор успешно создан';
            } catch (\Exception $e) {
                $_SESSION['error'] = 'Ошибка создания: ' . $e->getMessage();
            }

            $this->redirect('/admin/users');
            return;
        }

        $this->redirect('/admin/users');
    }

    /**
     * Удаление администратора
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Неверный метод';
            $this->redirect('/admin/users');
            return;
        }

        $userId = $this->post('user_id');

        // Защита от удаления себя
        if ($userId == $_SESSION['admin_user_id']) {
            $_SESSION['error'] = 'Нельзя удалить самого себя';
            $this->redirect('/admin/users');
            return;
        }

        try {
            $this->userModel->delete($userId);
            $_SESSION['success'] = 'Администратор удален';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Ошибка удаления: ' . $e->getMessage();
        }

        $this->redirect('/admin/users');
    }

    /**
     * Смена пароля
     */
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Неверный метод';
            $this->redirect('/admin/users');
            return;
        }

        $userId = $this->post('user_id');
        $newPassword = $this->post('new_password');
        $confirmPassword = $this->post('confirm_password');

        if (empty($newPassword) || $newPassword !== $confirmPassword) {
            $_SESSION['error'] = 'Пароли не совпадают';
            $this->redirect('/admin/users');
            return;
        }

        try {
            $this->userModel->update($userId, [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            ]);

            $_SESSION['success'] = 'Пароль изменен';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Ошибка: ' . $e->getMessage();
        }

        $this->redirect('/admin/users');
    }
}
