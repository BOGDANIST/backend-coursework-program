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
        id_sp = ?, id_galuz = ?, im_galuz = ?, id_spec = ?, im_spec = ?, im_specializ = ?
        WHERE id_sp = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param(
        'ssssssi',
        $_POST['id_sp'] ?? '',
        $_POST['id_galuz'] ?? '',
        $_POST['im_galuz'] ?? '',
        $_POST['id_spec'] ?? '',
        $_POST['im_spec'],
        $_POST['im_specializ'] ?? '',
        $spec_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні спеціальності: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Спеціальність успішно оновлено');
    $response->setData(['id' => $spec_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
