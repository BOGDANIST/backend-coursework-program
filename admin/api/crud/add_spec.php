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

    if (empty($_POST['im_spec'] ?? '')) {
        $errors['im_spec'] = 'Назва спеціальності обов\'язкова';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    $stmt = $linc->prepare("INSERT INTO spec (
        id_sp, id_galuz, im_galuz, id_spec, im_spec, im_specializ
    ) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $id_sp = $_POST['id_sp'] ?? '';
    $id_galuz = $_POST['id_galuz'] ?? '';
    $im_galuz = $_POST['im_galuz'] ?? '';
    $id_spec = $_POST['id_spec'] ?? '';
    $im_spec = $_POST['im_spec'];
    $im_specializ = $_POST['im_specializ'] ?? '';

    $stmt->bind_param(
        'ssssss',
        $id_sp,
        $id_galuz,
        $im_galuz,
        $id_spec,
        $im_spec,
        $im_specializ
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при додаванні спеціальності: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Спеціальність успішно додано');
    $response->setData(['id' => $linc->insert_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
