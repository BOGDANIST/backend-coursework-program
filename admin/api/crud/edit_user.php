<?php
session_start();

// Перевірка доступу (тільки адмін може змінювати користувачів)
if (!in_array($_SESSION['auth_user'] ?? '', ['admin'])) {
    header('HTTP/1.1 403 Forbidden');
    include __DIR__ . '/../ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
    exit;
}

include '../../../include/db_connect.php';
include '../ApiResponse.php';

$response = new ApiResponse(false, 'Невідома помилка');
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Метод не підтримується');
    }

    if (empty($_POST['user_id'])) {
        throw new Exception('ID користувача не вказано');
    }

    $user_id = (int)$_POST['user_id'];
    
    // Перевіряємо, чи ввів адміністратор новий пароль
    $is_password_change = !empty($_POST['new_password1'] ?? '');

    // Якщо пароль введено, перевіряємо, чи збігається він з другим полем
    if ($is_password_change) {
        if ($_POST['new_password1'] !== ($_POST['new_password2'] ?? '')) {
            $errors['new_password2'] = 'Паролі не збігаються';
        }
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Читаємо статус (ВИПРАВЛЕНО: тепер читаємо з $_POST['status'])
    $status_map = ['user' => '1', 'admin' => '10', 'editor' => '9', 'viewer' => '8'];
    $status = $status_map[$_POST['status'] ?? 'user'] ?? '1';

    if ($is_password_change) {
        // Якщо є пароль - оновлюємо пароль і статус
        $new_password = md5($_POST['new_password1']);
        $stmt = $linc->prepare("UPDATE users SET password = ?, status = ? WHERE user_id = ?");
        
        if (!$stmt) throw new Exception('Помилка підготовки запиту: ' . $linc->error);
        $stmt->bind_param('ssi', $new_password, $status, $user_id);
    } else {
        // Якщо пароля немає - оновлюємо тільки статус
        $stmt = $linc->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        
        if (!$stmt) throw new Exception('Помилка підготовки запиту: ' . $linc->error);
        $stmt->bind_param('si', $status, $user_id);
    }

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Дані користувача успішно оновлено');

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>