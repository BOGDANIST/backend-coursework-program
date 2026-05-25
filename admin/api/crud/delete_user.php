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

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Метод не підтримується');
    }

    if (empty($_POST['user_id'])) {
        throw new Exception('ID користувача не вказано');
    }

    $user_id = (int)$_POST['user_id'];

    $stmt = $linc->prepare("DELETE FROM users WHERE user_id = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param('i', $user_id);

    if (!$stmt->execute()) {
        throw new Exception('Помилка при видаленні користувача: ' . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        $response = new ApiResponse(true, 'Користувача успішно видалено');
        $response->setData(['id' => $user_id]);
    } else {
        throw new Exception('Користувача не знайдено');
    }

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
}

$response->send();
?>
