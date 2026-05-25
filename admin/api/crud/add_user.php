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

    if (empty($_POST['input_login'] ?? '')) {
        $errors['input_login'] = 'Логін обов\'язковий';
    }

    if (empty($_POST['input_password1'] ?? '')) {
        $errors['input_password1'] = 'Пароль обов\'язковий';
    }

    if (($_POST['input_password1'] ?? '') !== ($_POST['input_password2'] ?? '')) {
        $errors['input_password2'] = 'Паролі не збігаються';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Перевірка дублювання логіну
    $check_stmt = $linc->prepare("SELECT user_id FROM users WHERE login = ? LIMIT 1");
    if (!$check_stmt) {
        throw new Exception('Помилка перевірки: ' . $linc->error);
    }

    $check_stmt->bind_param('s', $_POST['input_login']);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $errors['input_login'] = 'Такий логін вже існує';
        $response->setErrors($errors);
        throw new Exception('Такий логін вже існує');
    }

    //映射 status
    $status_map = ['user' => '1', 'admin' => '10', 'editor' => '9', 'viewer' => '8'];
    $status = $status_map[$_POST['input_status'] ?? 'user'] ?? '1';
    $password = md5($_POST['input_password1']);

    $stmt = $linc->prepare("INSERT INTO users (login, password, status) VALUES (?, ?, ?)");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param('sss', $_POST['input_login'], $password, $status);

    if (!$stmt->execute()) {
        throw new Exception('Помилка при додаванні користувача: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Користувача успішно додано');
    $response->setData(['id' => $linc->insert_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
