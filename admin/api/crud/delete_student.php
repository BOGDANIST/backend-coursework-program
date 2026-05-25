<?php
session_start();

if (!in_array($_SESSION['auth_user'] ?? '', ['admin', 'editor'])) {
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

    if (empty($_POST['id'])) {
        throw new Exception('ID студента не вказано');
    }

    $student_id = (int)$_POST['id'];

    // Підготовлений запит для видалення
    $stmt = $linc->prepare("DELETE FROM student WHERE s_id = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param('i', $student_id);

    if (!$stmt->execute()) {
        throw new Exception('Помилка при видаленні студента: ' . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        $response = new ApiResponse(true, 'Студента успішно видалено');
        $response->setData(['id' => $student_id]);
    } else {
        throw new Exception('Студента не знайдено');
    }

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
}

$response->send();
?>
