# 🗞️ Informnews.kz

Региональный новостной портал с современным дизайном и полным функционалом CMS.

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-CSS-06B6D4?logo=tailwindcss&logoColor=white)
![License](https://img.shields.io/badge/License-Proprietary-red)

---

## 📋 Описание

**Informnews.kz** - двуязычный (қазақша/русский) новостной портал с административной панелью для управления контентом.

### ✨ Основные возможности

#### 🎨 Фронтенд
- 🌓 **Система тем (Dark/Light mode)** — умное переключение с сохранением выбора
- 🌐 Двуязычность (казахский/русский)
- 📱 Полностью адаптивный дизайн (Mobile First)
- 🎯 Категории новостей с современными карточками
- 💬 Система комментариев с reCAPTCHA
- 🌡️ Виджет погоды (OpenWeather API)
- 💱 Актуальные курсы валют
- 🔍 SEO оптимизация (Meta, Sitemap, OpenGraph)
- 📊 Премиальный UI/UX (Glassmorphism, Red Accents)

#### 🔐 Админ-панель
- ✍️ WYSIWYG редактор постов (TinyMCE)
- 📁 Управление категориями
- 👥 Управление администраторами
- 🖼️ Медиа-галерея с обработкой изображений
- 💬 Модерация комментариев
- ⚙️ Настройки сайта (динамические контакты, соцсети)
- 🔒 CSRF защита + reCAPTCHA на логине
- 📈 Dashboard со статистикой

#### 🛡️ Безопасность
- ✅ Защита от SQL инъекций (PDO)
- ✅ Защита от XSS (htmlspecialchars)
- ✅ CSRF токены во всех формах
- ✅ reCAPTCHA v2 (комментарии + логин)
- ✅ Хеширование паролей (bcrypt)
- ✅ Валидация загрузки файлов

---

## 🚀 Технологии

### Backend
- **PHP 8.0+** - серверная логика
- **MySQL 8.0+** - база данных
- **PDO** - безопасная работа с БД

### Frontend
- **HTML5 / CSS3** - разметка и стили
- **JavaScript (Vanilla)** - интерактивность и управление темами
- **TailwindCSS** - CSS фреймворк (Dark Mode support)
- **Local Storage** - сохранение настроек пользователя (тема)
- **Font Awesome** - иконки
- **TinyMCE** - редактор контента

### Интеграции
- **OpenWeather API** - погода
- **Google reCAPTCHA v2** - защита отботов
- **GD Library** - обработка изображений

---

## 📂 Структура проекта

```
informnews.kz/
│
├── app/
│   ├── controllers/
│   │   ├── admin/
│   │   │   ├── AdminCategoryController.php    # Управление категориями
│   │   │   ├── AdminCommentController.php     # Модерация комментариев
│   │   │   ├── AdminDashboardController.php   # Dashboard со статистикой
│   │   │   ├── AdminMediaController.php       # Медиа-галерея
│   │   │   ├── AdminPostController.php        # Создание/редактирование постов
│   │   │   ├── AdminSettingsController.php    # Настройки сайта
│   │   │   ├── AdminUserController.php        # Управление админами
│   │   │   └── AuthController.php             # Аутентификация
│   │   ├── CategoryController.php             # Страницы категорий
│   │   ├── HomeController.php                 # Главная страница
│   │   └── PostController.php                 # Страницы постов
│   │
│   ├── models/
│   │   ├── CategoryModel.php                  # Модель категорий
│   │   ├── CommentModel.php                   # Модель комментариев
│   │   ├── PostModel.php                      # Модель постов
│   │   └── UserModel.php                      # Модель пользователей
│   │
│   ├── views/
│   │   ├── admin/
│   │   │   ├── categories.php                 # Управление категориями
│   │   │   ├── comments.php                   # Модерация комментариев
│   │   │   ├── dashboard.php                  # Dashboard
│   │   │   ├── login.php                      # Страница входа (+ reCAPTCHA)
│   │   │   ├── media.php                      # Медиа-галерея
│   │   │   ├── post-editor.php                # Редактор постов (TinyMCE)
│   │   │   ├── posts-list.php                 # Список постов
│   │   │   ├── settings.php                   # Настройки сайта
│   │   │   └── users.php                      # Управление пользователями
│   │   ├── partials/
│   │   │   ├── _admin_sidebar.php             # Боковое меню админки
│   │   │   ├── _footer.php                    # Футер сайта
│   │   │   ├── _header.php                    # Header (погода, валюты)
│   │   │   └── _navigation.php                # Главное меню
│   │   ├── category/
│   │   │   └── index.php                      # Страница категории
│   │   ├── home/
│   │   │   └── index.php                      # Главная страница
│   │   └── post/
│   │       └── single.php                     # Страница поста
│   │
│   ├── helpers/
│   │   ├── CSRFHelper.php                     # CSRF защита
│   │   ├── ImageProcessor.php                 # Обработка изображений
│   │   ├── SitemapGenerator.php               # Генерация sitemap.xml
│   │   └── SlugGenerator.php                  # Генерация URL slug
│   │
│   └── services/
│       ├── CurrencyService.php                # API курсов валют
│       └── WeatherService.php                 # API погоды
│
├── config/
│   ├── app.php                                # Конфиг сайта (название, API ключи, контакты)
│   └── database.php                           # Настройки БД
│
├── core/
│   ├── Controller.php                         # Базовый контроллер (CSRF, auth)
│   ├── Database.php                           # PDO singleton
│   ├── Model.php                              # Базовая модель
│   └── Router.php                             # Маршрутизатор (KZ/RU)
│
├── database/
│   ├── schema.sql                             # Структура БД (8 таблиц)
│   └── sample_data.sql                        # Демо-данные (опционально)
│
├── public/                                     # Публичная директория (Document Root)
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── logo.png                           # Логотип сайта
│   ├── uploads/                               # Загруженные файлы
│   │   ├── thumbnail/                         # 150x150
│   │   ├── medium/                            # 600x400
│   │   └── large/                             # 1200x800
│   ├── .htaccess                              # Apache конфиг (URL rewrite)
│   └── index.php                              # Точка входа (bootstrap)
│
├── .env.example                                # Пример переменных окружения
├── DEPLOYMENT.md                               # Инструкция по деплою на production
├── README.md                                   # Документация проекта
├── QUICKSTART.md                               # Быстрый старт
├── robots.txt                                  # Для поисковых роботов
├── setup-database.sh                           # Скрипт установки БД
└── cron.php                                    # Cron задачи (обновление API)
```

**Всего:**
- 📁 **8 контроллеров** (3 публичных + 5 админских)
- 📁 **4 модели** (Post, Category, Comment, User)
- 📁 **13 view-файлов** + 4 partialов
- 📁 **4 helper'а** (CSRF, Image, Sitemap, Slug)
- 📁 **2 сервиса** (Weather, Currency)
- 📁 **4 ядра** (Router, Database, Controller, Model)

---

## ⚙️ Требования

- **PHP** >= 8.0
- **MySQL** >= 8.0
- **Apache/Nginx** с mod_rewrite
- **GD Extension** для обработки изображений
- **PDO Extension** для работы с БД

---

## 📦 Установка

### Быстрый старт (локально)

```bash
# 1. Клонировать репозиторий
git clone https://github.com/mhammedbekmahan/informnews.kz.git
cd informnews.kz

# 2. Настроить БД
mysql -u root -p < database/schema.sql

# 3. Настроить подключение
cp config/database.php.example config/database.php
# Отредактировать config/database.php

# 4. Запустить локальный сервер
cd public
php -S localhost:8000
```

### Деплой на сервер

Смотри подробную инструкцию в **[DEPLOYMENT.md](DEPLOYMENT.md)**

---

## 🔑 Первый вход

После установки:

1. Открой `/admin/login`
2. Используй учетные данные из БД (создай через SQL или `/admin/users`)
3. Настрой API ключи в `/admin/settings`:
   - OpenWeather API
   - Google reCAPTCHA

---

## 📝 Конфигурация

### config/app.php

Основные настройки сайта:
- Название, URL, язык
- API ключи (погода, reCAPTCHA)
- Контакты и соцсети
- Параметры изображений

### config/database.php

Параметры подключения к MySQL:
- Host, порт
- База данных
- Пользователь, пароль

---

## 🎯 Основные функции

### Управление постами
- Создание/редактирование на 2 языках
- WYSIWYG редактор
- Автогенерация slug
- Загрузка изображений (4 размера)
- Черновики и публикация

### Категории
- Создание категорий на 2 языках
- Описания и иконки
- URL slug для SEO

### Система тем
- **Dual Theme Support**: Полноценный светлый и темный режимы.
- **Premium Dark**: Сохранен эстетичный темно-серый стиль для ночного режима.
- **Red Gradient Header**: Специальный дизайн хедера для светлого режима.
- **Persistence**: Выбранная тема сохраняется локально.
- **Zero Flash**: Скрипт инициализации предотвращает "вспышку" белого при загрузке темной темы.

### Комментарии
- Модерация (одобрение/удаление)
- IP трекинг
- reCAPTCHA защита

### Медиа
- Галерея изображений
- Автоматическая генерация превью
- Управление файлами

---

## 🔒 Безопасность

Проект прошел аудит безопасности:

| Категория | Статус |
|-----------|--------|
| SQL инъекции | ✅ Защищено (PDO) |
| XSS | ✅ Защищено (htmlspecialchars) |
| CSRF | ✅ Защищено (токены) |
| Загрузка файлов | ✅ Валидация |
| Авторизация | ✅ Сессии + bcrypt |

**Оценка: 9/10** - production ready

---

## 📸 Скриншоты

*(Добавьте скриншоты вашего проекта)*

---

## 🤝 Разработка

Разработано для **Informnews.kz**

### Author
- GitHub: [@mhammedbekmahan](https://github.com/mhammedbekmahan)

---

## 📄 Лицензия

Proprietary - Все права защищены © 2026 Informnews.kz

---

## 🆘 Поддержка

Для вопросов и поддержки:
- Email: info@informnews.kz
- Telegram: *указать контакт*

---

## 📌 Дополнительно

- [Инструкция по деплою](DEPLOYMENT.md)
- [Настройка API](api-setup.md)
- [Аудит безопасности](security-audit.md)
# muha_informbr
