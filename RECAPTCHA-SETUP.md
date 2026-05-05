# Настройка Google reCAPTCHA v2

## ✅ reCAPTCHA успешно интегрирована!

Теперь нужно получить API ключи от Google.

---

## 📝 Инструкция

### Шаг 1: Регистрация на Google reCAPTCHA

1. Зайди на https://www.google.com/recaptcha/admin
2. Войди через Google аккаунт
3. Нажми **"+"** (Create / Создать)

### Шаг 2: Заполни форму

```
Label (Метка): Informnews.kz
reCAPTCHA type: reCAPTCHA v2 → "I'm not a robot" Checkbox
Domains (Домены): 
  localhost
  informnews.kz  (если есть домен)
```

Поставь галочку "Accept the reCAPTCHA Terms of Service"

Нажми **Submit**

### Шаг 3: Скопируй ключи

После создания увидишь 2 ключа:

```
Site Key:     6Lc...........................
Secret Key:   6Lc...........................
```

### Шаг 4: Вставь ключи в конфиг

Открой файл `config/app.php` и вставь:

```php
// Google reCAPTCHA v2
'recaptcha_site_key' => '6Lc...твой Site Key...',
'recaptcha_secret_key' => '6Lc...твой Secret Key...',
'recaptcha_enabled' => true,  // ← ВКЛЮЧИ!
```

**Важно:** `recaptcha_enabled` измени с `false` на `true`!

---

## 🧪 Тестирование

1. Зайди на любую новость
2. Попробуй оставить комментарий
3. Увидишь галочку **"Я не робот"**
4. Поставь галочку
5. Отправь комментарий

Если ключи правильные - комментарий отправится!

---

## 🔄 Fallback режим

Если не хочешь настраивать reCAPTCHA сейчас:
- Оставь `'recaptcha_enabled' => false`
- Будет работать простая проверка "3 + 2 = ?"

---

## ❓ Проблемы?

**"Ключ недействителен":**
- Проверь что домен в Google reCAPTCHA совпадает (localhost для разработки)
- Убедись что скопировал правильный ключ

**"Форма не показывает reCAPTCHA":**
- Проверь что `recaptcha_enabled => true`
- Проверь что ключи заполнены
