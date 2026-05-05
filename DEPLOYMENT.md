# 🚀 Деплой на голый сервер (Production)

Пошаговая инструкция для установки **Informnews.kz** на чистый VPS/сервер.

---

## 📋 Требования

### Минимальные характеристики сервера
- **OS:** Ubuntu 20.04+ / Debian 11+ / CentOS 8+
- **RAM:** 2GB+
- **Disk:** 20GB+
- **CPU:** 1 core+

### Необходимое ПО
- Apache 2.4+ или Nginx
- PHP 8.0+
- MySQL 8.0+ или MariaDB 10.5+
- Git
- Composer (опционально)

---

## 🔧 Шаг 1: Подготовка сервера

### 1.1 Обновление системы

```bash
# Ubuntu/Debian
sudo apt update && sudo apt upgrade -y

# CentOS/RHEL
sudo yum update -y
```

### 1.2 Установка необходимого ПО

#### Ubuntu/Debian:

```bash
# Apache, PHP, MySQL
sudo apt install -y apache2 php8.1 php8.1-cli php8.1-mysql php8.1-gd \
                     php8.1-mbstring php8.1-xml php8.1-curl \
                     mysql-server git unzip

# Включить mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### CentOS/RHEL:

```bash
# Репозитории
sudo yum install -y epel-release
sudo yum install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm
sudo yum module enable php:remi-8.1 -y

# Установка
sudo yum install -y httpd php php-mysqlnd php-gd php-mbstring \
                     php-xml php-curl mariadb-server git

# Запуск сервисов
sudo systemctl start httpd mariadb
sudo systemctl enable httpd mariadb
```

---

## 🗄️ Шаг 2: Настройка MySQL

### 2.1 Безопасная установка

```bash
sudo mysql_secure_installation
```

Ответы:
- Set root password? **Y** (придумай сложный пароль)
- Remove anonymous users? **Y**
- Disallow root login remotely? **Y**
- Remove test database? **Y**
- Reload privilege tables? **Y**

### 2.2 Создание БД и пользователя

```bash
# Войти в MySQL
sudo mysql -u root -p

# В консоли MySQL:
CREATE DATABASE informnews CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'informnews_user'@'localhost' IDENTIFIED BY 'YOUR_STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON informnews.* TO 'informnews_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**⚠️ Замени** `YOUR_STRONG_PASSWORD_HERE` на надежный пароль!

### 2.3 Импорт схемы БД

```bash
# После клонирования проекта (следующий шаг)
mysql -u informnews_user -p informnews < /var/www/informnews.kz/database/schema.sql
```

---

## 📦 Шаг 3: Клонирование проекта

### 3.1 Создание директории

```bash
cd /var/www
sudo git clone https://github.com/godz1llla/informnews.kz.git
cd informnews.kz
```

### 3.2 Настройка прав доступа

```bash
# Владелец - веб-сервер
sudo chown -R www-data:www-data /var/www/informnews.kz

# Права на папки
sudo chmod -R 755 /var/www/informnews.kz

# Папка uploads должна быть записываемая
sudo chmod -R 775 /var/www/informnews.kz/public/uploads
```

---

## ⚙️ Шаг 4: Конфигурация проекта

### 4.1 Настройка подключения к БД

```bash
sudo nano /var/www/informnews.kz/config/database.php
```

Укажи данные из Шага 2.2:

```php
return [
    'host' => 'localhost',
    'port' => 3306,
    'database' => 'informnews',
    'username' => 'informnews_user',
    'password' => 'YOUR_STRONG_PASSWORD_HERE',
    'charset' => 'utf8mb4',
];
```

### 4.2 Настройка конфига сайта (опционально)

```bash
sudo nano /var/www/informnews.kz/config/app.php
```

Измени:
- `url` - доменное имя
- `openweather_api_key` - (получи на openweathermap.org)
- `recaptcha_site_key` / `recaptcha_secret_key` - (получи на google.com/recaptcha)

---

## 🌐 Шаг 5: Настройка Apache

### 5.1 Создание VirtualHost

```bash
sudo nano /etc/apache2/sites-available/informnews.conf
```

Вставь конфиг:

```apache
<VirtualHost *:80>
    ServerName informnews.kz
    ServerAlias www.informnews.kz
    DocumentRoot /var/www/informnews.kz/public

    <Directory /var/www/informnews.kz/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Логи
    ErrorLog ${APACHE_LOG_DIR}/informnews_error.log
    CustomLog ${APACHE_LOG_DIR}/informnews_access.log combined
</VirtualHost>
```

### 5.2 Активация сайта

```bash
# Отключить дефолтный сайт
sudo a2dissite 000-default.conf

# Включить наш сайт
sudo a2ensite informnews.conf

# Проверка конфига
sudo apache2ctl configtest

# Перезапуск
sudo systemctl restart apache2
```

---

## 🔐 Шаг 6: SSL сертификат (Let's Encrypt)

### 6.1 Установка Certbot

```bash
# Ubuntu/Debian
sudo apt install -y certbot python3-certbot-apache

# CentOS
sudo yum install -y certbot python3-certbot-apache
```

### 6.2 Получение сертификата

```bash
sudo certbot --apache -d informnews.kz -d www.informnews.kz
```

Следуй инструкциям:
- Email для уведомлений
- Согласие с Terms of Service
- Редирект HTTP → HTTPS: **Yes**

### 6.3 Автообновление

```bash
# Проверка обновления (тест)
sudo certbot renew --dry-run

# Добавить в cron (автоматически)
sudo crontab -e
# Добавь строку:
0 0 * * * certbot renew --quiet
```

---

## 👤 Шаг 7: Создание первого администратора

### 7.1 Через MySQL

```bash
mysql -u informnews_user -p informnews
```

```sql
-- Создать пользователя (пароль зашифруется автоматически через интерфейс)
-- Временно создадим через SHA256, потом сменим через админку

INSERT INTO users (username, email, password, full_name, role) 
VALUES (
    'admin', 
    'admin@informnews.kz',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- пароль: password
    'Администратор',
    'admin'
);
```

**⚠️ ВАЖНО:** Сразу после первого входа смени пароль через `/admin/users`!

---

## 🔥 Шаг 8: Файрвол и безопасность

### 8.1 UFW (Ubuntu/Debian)

```bash
# Разрешить SSH, HTTP, HTTPS
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Включить
sudo ufw enable
```

### 8.2 Настройка PHP (безопасность)

```bash
sudo nano /etc/php/8.1/apache2/php.ini
```

Измени:
```ini
display_errors = Off
expose_php = Off
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 30
```

Перезапуск:
```bash
sudo systemctl restart apache2
```

---

## ✅ Шаг 9: Проверка

### 9.1 Открой в браузере

```
https://informnews.kz
```

### 9.2 Тест админки

```
https://informnews.kz/admin/login
```

Логин: `admin`  
Пароль: `password` (смени сразу!)

---

## 🎯 Шаг 10: Настройка API

### 10.1 OpenWeather (погода)

1. Регистрация: https://openweathermap.org/api
2. Получи бесплатный ключ
3. Вставь в `/admin/settings` → OpenWeather API Key

### 10.2 Google reCAPTCHA

1. Регистрация: https://www.google.com/recaptcha/admin
2. Создай Site (v2 Checkbox)
3. Вставь Site Key и Secret Key в `/admin/settings`

---

## 🔄 Обновление проекта

```bash
cd /var/www/informnews.kz
sudo git pull origin main
sudo chown -R www-data:www-data .
sudo systemctl restart apache2
```

---

## 📊 Мониторинг

### Логи Apache

```bash
# Ошибки
sudo tail -f /var/log/apache2/informnews_error.log

# Доступ
sudo tail -f /var/log/apache2/informnews_access.log
```

### Логи MySQL

```bash
sudo tail -f /var/log/mysql/error.log
```

---

## 🆘 Troubleshooting

### Проблема: "500 Internal Server Error"

**Решение:**
```bash
# Проверь права
sudo chown -R www-data:www-data /var/www/informnews.kz

# Проверь логи
sudo tail -f /var/log/apache2/informnews_error.log
```

### Проблема: "Database connection failed"

**Решение:**
```bash
# Проверь config/database.php
# Проверь что MySQL запущен
sudo systemctl status mysql

# Тест подключения
mysql -u informnews_user -p informnews
```

### Проблема: Не загружаются картинки

**Решение:**
```bash
# Права на uploads
sudo chmod -R 775 /var/www/informnews.kz/public/uploads
sudo chown -R www-data:www-data /var/www/informnews.kz/public/uploads
```

---

## 🎉 Готово!

Твой сайт работает на **https://informnews.kz**

**Не забудь:**
1. ✅ Сменить пароль админа
2. ✅ Настроить API ключи
3. ✅ Добавить контент
4. ✅ Настроить бэкапы БД

---

## 💾 Бэкапы (рекомендуется)

### Автоматический бэкап БД

```bash
# Создай скрипт
sudo nano /root/backup-db.sh
```

```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/root/backups"
mkdir -p $BACKUP_DIR

# Бэкап БД
mysqldump -u informnews_user -pYOUR_PASSWORD informnews | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Удалить старые (старше 30 дней)
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +30 -delete
```

```bash
# Права на выполнение
sudo chmod +x /root/backup-db.sh

# Добавь в cron (ежедневно в 3:00)
sudo crontab -e
# Добавь:
0 3 * * * /root/backup-db.sh
```

---

**Разработано [hubtech.kz](https://hubtech.kz)** 🚀
