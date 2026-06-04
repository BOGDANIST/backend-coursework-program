# 🧪 API Endpoint Testing Guide

## ✅ Виправлені помилки

1. **bootstrap.php** - Виправлено шлях до Autoloader з абсолютного на відносний
2. **students_edit.php** - Виправлено шлях до bootstrap з абсолютного на відносний
3. **Controller.php** - Покращена обробка сесій (PHP_SESSION_NONE)

## 🔧 Конфігурація

Переконайтеся, що `config/Config.php` має правильні параметри:
- HOST: localhost
- USER: root
- PASSWORD: (порожній або ваш пароль)
- DATABASE: college
- CHARSET: utf8mb4

## 🧪 Тестування Endpoints

### 1. Отримання Групи (GET)

```bash
curl -X GET "http://localhost/admin/api/crud/groups_edit.php?id=ІС-21" \
  -H "Cookie: PHPSESSID=your_session_id" \
  -H "Content-Type: application/json"
```

### 2. Редагування Групи (POST)

```bash
curl -X POST "http://localhost/admin/api/crud/groups_edit.php" \
  -H "Cookie: PHPSESSID=your_session_id" \
  -H "Content-Type: application/json" \
  -d '{
    "id": "ІС-21",
    "form_im_group": "ІС-21-NEW",
    "form_gz": "Галузь",
    "form_sp": "Спеціалізація",
    "form_sz": "Спеціальність"
  }'
```

### 3. Створення Студента (POST)

```bash
curl -X POST "http://localhost/admin/api/crud/students_create.php" \
  -H "Cookie: PHPSESSID=your_session_id" \
  -H "Content-Type: application/json" \
  -d '{
    "form_group": "ІС-21",
    "form_pr_stud": "Прізвище",
    "form_im_stud": "Ім'\''я",
    "form_bat_stud": "По батькові",
    "form_sex": "Чоловік",
    "form_date_nar": "2002-05-15",
    "form_zamovl": "Так",
    "form_osvita": "Повна загальна середня освіта",
    "form_zscool": "2020",
    "form_region_type": "Місто",
    "form_region": "Київська"
  }'
```

### 4. Редагування Студента (POST)

```bash
curl -X POST "http://localhost/admin/api/crud/students_edit.php" \
  -H "Cookie: PHPSESSID=your_session_id" \
  -H "Content-Type: application/json" \
  -d '{
    "id": 123,
    "form_group": "ІС-21",
    "form_pr_stud": "Прізвище",
    "form_im_stud": "Ім'\''я",
    "form_bat_stud": "По батькові"
  }'
```

### 5. Редагування Користувача (POST)

```bash
# Тільки оновлення ролі
curl -X POST "http://localhost/admin/api/crud/users_edit.php" \
  -H "Cookie: PHPSESSID=admin_session" \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 5,
    "status": "editor"
  }'

# Оновлення пароля та ролі
curl -X POST "http://localhost/admin/api/crud/users_edit.php" \
  -H "Cookie: PHPSESSID=admin_session" \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 5,
    "status": "admin",
    "new_password1": "newPassword123",
    "new_password2": "newPassword123"
  }'
```

## 🔐 Авторизація

- **401 Unauthorized** — Користувач не залогінений (відсутня сесія)
- **403 Forbidden** — Користувач не має необхідної ролі
  - Groups/Students: потрібні ролі `admin` або `editor`
  - Users: потрібна роль `admin`

## 📊 HTTP Статус-коди

| Код | Значення | Приклад |
|-----|----------|---------|
| 200 | OK | Успішна редакція (PUT/POST) |
| 201 | Created | Успішне створення (POST create) |
| 400 | Bad Request | Помилка валідації |
| 401 | Unauthorized | Необхідна аутентифікація |
| 403 | Forbidden | Доступ заборонено |
| 404 | Not Found | Ресурс не знайдено |
| 405 | Method Not Allowed | Невіддповідний HTTP метод |
| 500 | Server Error | Внутрішня помилка сервера |

## 🗂 Структура Response

```json
{
  "success": true,
  "message": "Опис результату",
  "status_code": 200,
  "data": {
    "key": "value"
  },
  "errors": {
    "field_name": "Помилка валідації"
  }
}
```

## 🚀 JavaScript (fetch)

```javascript
// Редагування студента
fetch('admin/api/crud/students_edit.php', {
  method: 'POST',
  credentials: 'include', // Важливо для сесій!
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    id: 123,
    form_group: 'ІС-21',
    form_pr_stud: 'Прізвище'
  })
})
.then(r => r.json())
.then(data => {
  if (data.success) {
    console.log('Успіх:', data.data);
  } else {
    console.error('Помилка:', data.errors);
  }
});
```

## 📝 Примітки

1. **Сесії** — Всі API endpoints вимагають активної сесії PHP
2. **CORS** — Якщо фронтенд на іншому домені, налаштуйте CORS
3. **UTF-8** — Всі відповіді використовують UTF-8 (JSON_UNESCAPED_UNICODE)
4. **Prepared Statements** — Всі DB запити захищені від SQL-ін'єкцій
