# 📋 Инструкция: Настройка БД вручную

## Шаг 1: Войти в MySQL

Откройте терминал и введите:
```bash
sudo mysql -u root
```

Введите ваш sudo пароль когда попросит.

---

## Шаг 2: Создать базу данных (если еще не создана)

В консоли MySQL введите:
```sql
CREATE DATABASE IF NOT EXISTS informnews CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Вы должны увидеть: `Query OK, 1 row affected`

---

## Шаг 3: Выбрать базу данных

```sql
USE informnews;
```

Вы увидите: `Database changed`

---

## Шаг 4: Импортировать схему

```sql
SOURCE database/schema.sql;
```

Подождите пока выполнятся все CREATE TABLE команды.
Вы увидите много строк `Query OK, 0 rows affected`.

---

## Шаг 5: Импортировать демо-данные

```sql
SOURCE database/sample_data.sql;
```

Вы увидите `Query OK, X rows affected` для каждой таблицы.

---

## Шаг 6: Проверить таблицы

```sql
SHOW TABLES;
```

Должны увидеть 9 таблиц:
- categories
- comments
- currency_cache
- post_tags
- posts
- settings
- tags
- users
- weather_cache

---

## Шаг 7: Выйти из MySQL

```sql
EXIT;
```

---

## ✅ Готово!

Теперь откройте в браузере:
- **Frontend:** http://localhost:8000
- **Admin:** http://localhost:8000/admin
  - Логин: `Zhanar_inform2026#`
  - Пароль: `Info#m_$zhanar2026`

---

## 🔧 Если что-то пошло не так

**Проблема: "ERROR 1049 Unknown database"**
- Вернитесь к Шагу 2 и создайте БД

**Проблема: "ERROR 1064 Syntax error"**
- Убедитесь что находитесь в директории `/Users/mhammedbekmahan/Desktop/informnews.kz`
- Проверьте что файл `database/schema.sql` существует

**Проблема: "Can't open file"**
- Используйте полный путь:
  ```sql
  SOURCE /Users/mhammedbekmahan/Desktop/informnews.kz/database/schema.sql;
  SOURCE /Users/mhammedbekmahan/Desktop/informnews.kz/database/sample_data.sql;
  ```
