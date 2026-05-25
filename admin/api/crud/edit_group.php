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
        throw new Exception('ID групи не вказано');
    }

    $group_id = (int)$_POST['id'];

    if (empty($_POST['form_im_group'] ?? '')) {
        $errors['form_im_group'] = 'Назва групи обов\'язкова';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    $stmt = $linc->prepare("UPDATE st_group SET
         g_galuz = ?, g_spec = ?, g_specz = ?, g_course = ?,
        g_vipusc = ?, g_count_stud = ?, g_count_derg = ?, g_count_comerc = ?,
        g_nastav = ?, g_formnavch = ?
        WHERE g_im = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    // Prepare variables because bind_param requires variables (not expressions)
    $g_im = $_POST['form_im_group'];
    $g_gz = $_POST['g_gz'] ?? '';
    $g_sp = $_POST['g_sp'] ?? '';
    $g_sz = $_POST['g_sz'] ?? '';
    $g_kurs = $_POST['g_kurs'] ?? '';
    $g_vip = $_POST['g_vip'] ?? '';
    $g_count_stud = (int)($_POST['g_count_stud'] ?? 0);
    $g_count_rz = (int)($_POST['g_count_rz'] ?? 0);
    $g_count_contr = (int)($_POST['g_count_contr'] ?? 0);
    $g_nast = $_POST['g_nast'] ?? '';
    $g_fn = $_POST['g_fn'] ?? '';

    $stmt->bind_param(
        'ssssiiiiisi',
        $g_gz,
        $g_sp,
        $g_sz,
        $g_kurs,
        $g_vip,
        $g_count_stud,
        $g_count_rz,
        $g_count_contr,
        $g_nast,
        $g_fn,
        $group_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні групи: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Групу успішно оновлено');
    $response->setData(['id' => $group_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
