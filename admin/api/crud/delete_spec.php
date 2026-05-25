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
        throw new Exception('ID спеціальності не вказано');
    }

    $spec_id = (int)$_POST['id'];

    $stmt = $linc->prepare("DELETE FROM spec WHERE id_sp = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param('i', $spec_id);

    if (!$stmt->execute()) {
        throw new Exception('Помилка при видаленні спеціальності: ' . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        $response = new ApiResponse(true, 'Спеціальність успішно видалено');
        $response->setData(['id' => $spec_id]);
    } else {
        throw new Exception('Спеціальність не знайдено');
    }

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
}

$response->send();
?>
