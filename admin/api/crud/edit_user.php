<?php
session_start();

if (!in_array($_SESSION['auth_user'] ?? '', ['admin'])) {
    header('HTTP/1.1 403 Forbidden');
    include __DIR__ . '/../ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
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

    if (empty($_POST['old_password'] ?? '')) {
        $errors['old_password'] = 'Старий пароль обов\'язковий';
    }

    if (empty($_POST['new_password1'] ?? '')) {
        $errors['new_password1'] = 'Новий пароль обов\'язковий';
    }

    if (($_POST['new_password1'] ?? '') !== ($_POST['new_password2'] ?? '')) {
        $errors['new_password2'] = 'Паролі не збігаються';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Перевірка старого пароля
    $get_stmt = $linc->prepare("SELECT password FROM users WHERE user_id = ?");
    if (!$get_stmt) {
        throw new Exception('Помилка перевірки: ' . $linc->error);
    }

    $get_stmt->bind_param('i', $user_id);
    $get_stmt->execute();
    $get_stmt->bind_result($old_pwd);
    $get_stmt->fetch();
    $get_stmt->close();

    if (md5($_POST['old_password']) !== $old_pwd) {
        throw new Exception('Старий пароль невірний');
    }

    // Оновлення паролю та статусу
    $status_map = ['user' => '1', 'admin' => '10', 'editor' => '9', 'viewer' => '8'];
    $status = $status_map[$_POST['input_status'] ?? 'user'] ?? '1';
    $new_password = md5($_POST['new_password1']);

    $stmt = $linc->prepare("UPDATE users SET password = ?, status = ? WHERE user_id = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param('ssi', $new_password, $status, $user_id);

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні користувача: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Користувача успішно оновлено');
    $response->setData(['id' => $user_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
