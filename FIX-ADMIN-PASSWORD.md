# Исправление пароля админ-аккаунта

## Проблема

Пароль в sample_data.sql был неправильный. Хеш `$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi` соответствует паролю **password**, а не **admin123**.

## Решение

Выполните в MySQL:

```bash
sudo mysql -u root informnews
```

Затем в MySQL консоли:

```sql
-- Обновить пароль на Info#m_$zhanar2026
UPDATE users 
SET password = '$2y$12$5a8dO0KKw3vo.O//oyh7Q.LDgddPlyRthqU7X077KSIjsaHtZ7A6e', username = 'Zhanar_inform2026#' 
WHERE id = 1;

-- Проверить
SELECT username, email, role FROM users WHERE username = 'Zhanar_inform2026#';

EXIT;
```

## Теперь вход работает:

**URL:** http://localhost:8000/admin/login  
**Логин:** Zhanar_inform2026#  
**Пароль:** Info#m_$zhanar2026

---

## Или попробуйте старый пароль:

Если не хотите менять, попробуйте войти с:
- Логин: `admin`
- Пароль: `password`
