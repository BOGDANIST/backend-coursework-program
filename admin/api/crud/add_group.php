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

    // Валідація обов'язкових полів
    if (empty($_POST['form_im_group'] ?? '')) {
        $errors['form_im_group'] = 'Назва групи обов\'язкова';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Перевірка дублювання
    $check_stmt = $linc->prepare("SELECT g_id FROM st_group WHERE g_im = ? LIMIT 1");
    if (!$check_stmt) {
        throw new Exception('Помилка перевірки: ' . $linc->error);
    }

    $check_stmt->bind_param('s', $_POST['form_im_group']);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $errors['form_im_group'] = 'Така група вже існує';
        $response->setErrors($errors);
        throw new Exception('Така група вже існує');
    }

    // Вставка нової групи
    $stmt = $linc->prepare("INSERT INTO st_group (
        g_im, g_galuz, g_spec, g_specz, g_course, g_vipusc,
        g_count_stud, g_count_derg, g_count_comerc, g_nastav, g_formnavch
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param(
        'ssssssiiiis',
        $_POST['form_im_group'],
        $_POST['g_gz'] ?? '',
        $_POST['g_sp'] ?? '',
        $_POST['g_sz'] ?? '',
        $_POST['g_kurs'] ?? '',
        $_POST['g_vip'] ?? '',
        $_POST['g_count_stud'] ?? 0,
        $_POST['g_count_rz'] ?? 0,
        $_POST['g_count_contr'] ?? 0,
        $_POST['g_nast'] ?? '',
        $_POST['g_fn'] ?? ''
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при додаванні групи: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Групу успішно додано');
    $response->setData(['id' => $linc->insert_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
