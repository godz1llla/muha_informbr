<?php
/**
 * CSRF Helper - защита от Cross-Site Request Forgery
 */

class CSRFHelper
{
    /**
     * Генерировать новый CSRF токен
     */
    public static function generateToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Получить текущий токен
     */
    public static function getToken()
    {
        return $_SESSION['csrf_token'] ?? self::generateToken();
    }

    /**
     * Создать скрытое поле с токеном для формы
     */
    public static function field()
    {
        $token = self::getToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }

    /**
     * Проверить токен из POST запроса
     */
    public static function validate()
    {
        $token = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (empty($token) || empty($sessionToken)) {
            return false;
        }

        // Используем hash_equals для защиты от timing attacks
        return hash_equals($sessionToken, $token);
    }

    /**
     * Проверить и выбросить ошибку если токен невалиден
     */
    public static function check()
    {
        if (!self::validate()) {
            http_response_code(403);
            die('CSRF token validation failed. Possible CSRF attack detected.');
        }
    }

    /**
     * Сгенерировать новый токен (после успешной отправки формы)
     */
    public static function regenerate()
    {
        unset($_SESSION['csrf_token']);
        return self::generateToken();
    }
}
