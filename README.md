# MVC Архітектура - Довідник Рефакторингу

## 📋 Структура Проекту

```
backend-coursework-program/
├── bootstrap.php                 # Точка входу - ініціалізація додатку
├── Autoloader.php               # PSR-4 автозагрузчик класів
├── config/
│   └── Config.php               # Конфігурація БД та додатку
├── Core/
│   ├── Database.php             # Singleton для підключення до БД
│   ├── ApiResponse.php          # Клас для JSON відповідей з HTTP статус-кодами
│   ├── Controller.php           # Базовий клас контролерів з буферизацією
│   ├── Model.php                # Базовий клас моделей з prepared statements
│   └── Router.php               # Маршрутизатор запитів
├── Modules/
│   ├── Groups/
│   │   ├── Controllers/
│   │   │   └── GroupController.php
│   │   └── Models/
│   │       └── GroupModel.php
│   ├── Students/
│   │   ├── Controllers/
│   │   │   └── StudentController.php
│   │   └── Models/
│   │       └── StudentModel.php
│   │       └── StudentModel.php 
│   ├── Archives/
│   │   ├── Controllers/
│   │   │   └── OldStudentController.php
│   │   └── Models/
│   │       └── OldStudentModel.php
│   ├── Users/
│   ├── Specialties/
│   └── Archives/
├── Views/                       # Шаблони (якщо потрібні)
└── admin/api/crud/
    └── groups_edit.php          # API endpoint для редагування груп
```

## 🔑 Ключові Концепції

### 1. **Буферизація та HTTP Статус-Коди**

Всі контролери автоматично використовують `ob_start()` для буферизації виходу:

```php
// У Core/Controller.php
protected function startBuffer(): void
{
    if (ob_get_level() === 0) {
        ob_start();
    }
}

protected function getBufferedOutput(): string
{
    return ob_get_clean() ?: '';
}
```

**Приклади відповідей з правильними статус-кодами:**

```php
// 200 OK
$this->success('Успіх', $data);

// 201 Created
$this->created('Створено', $data);

// 400 Bad Request
$this->error('Помилка валідації', 400, ['field' => 'Помилка']);

// 403 Forbidden
$this->forbidden('Доступ заборонено');

// 404 Not Found
$this->notFound('Ресурс не знайдено');

// 500 Internal Server Error
$this->error('Внутрішня помилка', 500);
```

### 2. **PHP 8 Стандарти**

#### Constructor Property Promotion
```php
public function __construct(
    private bool $success = true,
    private string $message = '',
    private array|object|null $data = null
) {}
```

#### Union Types
```php
public function setData(array|object|null $data): self
```

#### Nullsafe Operator
```php
$user = $_SESSION['auth_user'] ?? null;
```

#### Strict Types
```php
declare(strict_types=1);
```

### 3. **Prepared Statements - Захист від SQL-ін'єкцій**

```php
protected function execute(
    string $query,
    string $types,
    array $params = []
): mysqli_stmt|false {
    $stmt = $this->db->prepare($query);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    return $stmt;
}
```

**Типи параметрів:**
- `s` - string
- `i` - integer
- `d` - double
- `b` - blob

### 4. **Архітектура Models/Controllers**

#### Model - Робота з БД
```php
class GroupModel extends Model
{
    protected string $table = 'st_group';
    
    public function findByName(string $name): ?array
    {
        return $this->fetchOne(
            "SELECT * FROM {$this->table} WHERE g_im = ? LIMIT 1",
            's',
            [&$name]
        );
    }
}
```

#### Controller - Бізнес-логіка
```php
class GroupController extends Controller
{
    private GroupModel $groupModel;
    
    public function actionEdit(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization();
        
        // Бізнес-логіка
        // ...
        
        $this->success('Успішно', $data);
    }
}
```

### 5. **Автентифікація та Авторизація**

```php
public function __construct()
{
    parent::__construct(); // Перевіряє сесію
}

protected function checkAuthorization(): void
{
    parent::checkAuthorization(['admin', 'editor']);
}
```

## 🚀 Використання API Endpoint

### Приклад: Редагування групи

**Файл:** `admin/api/crud/groups_edit.php`

```php
require_once __DIR__ . '/../../bootstrap.php';
use App\Modules\Groups\Controllers\GroupController;

ob_start();
try {
    $controller = new GroupController();
    $controller->execute('edit');
} catch (Throwable $e) {
    ob_end_clean();
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'message' => 'Помилка',
        'status_code' => 500
    ]);
}
ob_end_clean();
```

**Запит:**
```
POST /admin/api/crud/groups_edit.php
Content-Type: application/json

{
    "id": "old_group_name",
    "form_im_group": "new_group_name",
    "form_gz": "galuz",
    "form_sp": "speciality"
}
```

**Відповідь (200 OK):**
```json
{
    "success": true,
    "message": "Групу та всіх прив'язаних студентів успішно оновлено",
    "status_code": 200,
    "data": {
        "g_im": "new_group_name",
        "g_galuz": "galuz",
        ...
    }
}
```

**Відповідь (403 Forbidden):**
```json
{
    "success": false,
    "message": "Доступ заборонено",
    "status_code": 403
}
```

**Відповідь (404 Not Found):**
```json
{
    "success": false,
    "message": "Група не знайдена",
    "status_code": 404
}
```

## 📝 Рефакторинг Існуючого Коду

### Було (Процедурний підхід):
```php
session_start();
if (!in_array($_SESSION['auth_user'] ?? '', ['admin', 'editor'])) {
    header('HTTP/1.1 403 Forbidden');
    include '../ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
}

$stmt = $linc->prepare("UPDATE st_group SET ... WHERE g_im = ?");
$stmt->bind_param('s', $group_id_old);
$stmt->execute();
// ... більше кода
```

### Стало (MVC ООП):
```php
class GroupController extends Controller {
    public function actionEdit(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization();
        
        $groupModel = new GroupModel();
        $groupModel->update($oldName, $data);
        
        $this->success('Успішно', $data);
    }
}
```

## ✅ Вимоги, які Задовольняються

1. ✅ **MVC + OOP** - Модулі, Контролери, Моделі, Ядро
2. ✅ **PHP 8** - strict_types, union types, nullsafe operator, constructor promotion
3. ✅ **Буферизація** - `ob_start()`, `ob_get_clean()`, обробка статус-кодів
4. ✅ **JSON API** - Всі контролери повертають JSON через ApiResponse
5. ✅ **5+ Модулів** - Groups, Students, Users, Specialties, Archives
6. ✅ **Prepared Statements** - Захист від SQL-ін'єкцій
7. ✅ **Сесії та Авторизація** - Перевірка ролей у базовому Controller

## 📊 Модулі

### ✅ Groups Module
- **GroupModel** - findByName, findById, getAll, update, updateStudents, nameExists
- **GroupController** - actionEdit, actionGet, actionList, **actionCreate**
- **Endpoints:**
  - /admin/api/crud/groups_edit.php (PUT/POST)
  - /admin/api/crud/groups_create.php (POST) — 201 Created

### ✅ Students Module
- **StudentModel** - findById, getGroupByName, calculateAge, boolToYesNo, update, **create**, getByGroup, exists
- **StudentController** - actionEdit, actionGet, actionList, **actionCreate**
- **Endpoints:**
  - /admin/api/crud/students_edit.php (POST)
  - /admin/api/crud/students_create.php (POST) — 201 Created
  - /admin/api/crud/students_delete.php (POST) — буде далі
  - /admin/api/crud/students_get.php (GET) — буде далі

**Ключові особливості StudentController:**
- Валідація обов'язкових полів (група, прізвище, ім'я, по батькові)
- Автоматичний розрахунок віку з дати народження
- Отримання даних групи для заповнення пов'язаних полів
- Обробка чекбоксів ('Так'/'Ні')
- Обробка альтернативних назв полів (форм від фронтенду)
- **actionCreate** — створення нового студента (201 Created)
- **actionEdit** — редагування студента (200 OK)
- **actionGet** — отримання даних студента
- **actionList** — список студентів групи

### ✅ Users Module
- **UserModel** - findById, findByLogin, getAll, roleToStatus, statusToRole, hashPassword, updateWithPassword, updateStatus, exists, loginExists
- **UserController** - actionEdit, actionGet, actionList
- **Endpoint** - /admin/api/crud/users_edit.php

**Ключові особливості UserController:**
- Тільки адміністратори можуть змінювати користувачів
- Ролі: user(1), viewer(8), editor(9), admin(10)
- Валідація паролів (збіг, мінімум 6 символів)
- Можливість оновлення пароля та/або ролі окремо
- Конвертація статус-кодів на назви ролей в відповіді

## ✅ Оновлено async.js
Всі посилання на старі endpoint-ки оновлені на нові:
- `crud/add_student.php` → `crud/students_create.php`
- `crud/edit_student.php` → `crud/students_edit.php`
- `crud/delete_student.php` → `crud/students_delete.php`
- `crud/add_group.php` → `crud/groups_create.php`
- `crud/edit_group.php` → `crud/groups_edit.php`
- `crud/delete_group.php` → `crud/groups_delete.php`
- `crud/add_user.php` → `crud/users_create.php`
- `crud/edit_user.php` → `crud/users_edit.php`
- ... та інші


Рефакторингу потребують файли:
- `admin/api/crud/add_group.php` → GroupController::actionCreate
- `admin/api/crud/add_student.php` → StudentController::actionCreate
- `admin/api/crud/delete_group.php` → GroupController::actionDelete
- `admin/api/crud/delete_student.php` → StudentController::actionDelete
- `admin/api/crud/filter_group.php` → GroupController::actionFilter
- `admin/api/crud/filter_student.php` → StudentController::actionFilter
- `admin/api/crud/edit_spec.php` → SpecialtyController::actionEdit
- ... та інші

Кожен файл буде перетворено на відповідний метод у контролері з використанням моделей.
