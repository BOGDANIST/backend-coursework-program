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
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Метод не підтримується');
    }

    if (empty($_POST['id'])) {
        throw new Exception('ID спеціальності не вказано');
    }

    $spec_id = (int)$_POST['id'];

    if (empty($_POST['im_spec'] ?? '')) {
        $errors['im_spec'] = 'Назва спеціальності обов\'язкова';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    $stmt = $linc->prepare("UPDATE spec SET
         id_galuz = ?, im_galuz = ?, id_spec = ?, im_spec = ?, im_specializ = ?
        WHERE id_sp = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

// Оголошуємо змінні
    $id_galuz = $_POST['id_galuz'] ?? '';
    $im_galuz = $_POST['im_galuz'] ?? '';
    $id_spec = $_POST['id_spec'] ?? '';
    $im_spec = $_POST['im_spec'];
    $im_specializ = $_POST['im_specializ'] ?? '';

    // Передаємо рівно 6 параметрів (5 рядків 's' та 1 число 'i')
    $stmt->bind_param(
        'sssssi',
        $id_galuz,
        $im_galuz,
        $id_spec,
        $im_spec,
        $im_specializ,
        $spec_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні спеціальності: ' . $stmt->error);
    }

    // Fetch updated spec data to return to client
    $selectStmt = $linc->prepare("SELECT * FROM spec WHERE id_sp = ?");
    if (!$selectStmt) {
        throw new Exception('Помилка при отриманні даних: ' . $linc->error);
    }
    $selectStmt->bind_param('i', $spec_id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $specData = $result->fetch_assoc();
    $selectStmt->close();

    $response = new ApiResponse(true, 'Спеціальність успішно оновлено');
    $response->setData($specData);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
