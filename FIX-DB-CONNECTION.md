# 🔧 Исправление ошибки подключения

## Проблема
```
Access denied for user 'root'@'localhost'
```

В MySQL 8.0 на Ubuntu пользователь `root` использует **auth_socket** plugin вместо пароля.

---

## ✅ Решение: Создать отдельного пользователя

### Шаг 1: Войти в MySQL
```bash
sudo mysql -u root
```

### Шаг 2: Создать пользователя для приложения

В MySQL консоли выполните:

```sql
-- Создать пользователя
CREATE USER 'informnews_user'@'localhost' IDENTIFIED BY 'informnews_pass_2026';

-- Дать все права на базу данных
GRANT ALL PRIVILEGES ON informnews.* TO 'informnews_user'@'localhost';

-- Применить изменения
FLUSH PRIVILEGES;

-- Выйти
EXIT;
```

### Шаг 3: Обновить config/database.php

Откройте файл `config/database.php` и измените:

```php
'username' => 'informnews_user',    // Вместо 'root'
'password' => 'informnews_pass_2026',  // Вместо 'root'
```

---

## 🚀 После этого перезапустите сервер

```bash
# Остановить текущий сервер (Ctrl+C если запущен)
# Или найти процесс
pkill -f "php -S"

# Запустить снова
cd public
php -S localhost:8000
```

Откройте: http://localhost:8000

---

## ✨ Готово!
