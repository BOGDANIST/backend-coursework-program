<?php
session_start();

if (!in_array($_SESSION['auth_user'] ?? '', ['admin', 'editor'])) {
    header('HTTP/1.1 403 Forbidden');
    include __DIR__ . '/../ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
}

include '../../../include/db_connect.php';
include '../ApiResponse.php';
//include '../assets/midllware.php';

$response = new ApiResponse(false, 'Невідома помилка');
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Метод не підтримується');
    }

    if (empty($_POST['id'])) {
        throw new Exception('ID групи не вказано');
    }

    // ID групи - це СТАРА назва групи (перед редагуванням)
    $group_id_old = $_POST['id'];

    if (empty($_POST['form_im_group'] ?? '')) {
        $errors['form_im_group'] = 'Назва групи обов\'язкова';
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Перша перевірка: отримуємо реальний запис групи по старій назві
    $checkStmt = $linc->prepare("SELECT * FROM st_group WHERE g_im = ? LIMIT 1");
    if (!$checkStmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }
    $checkStmt->bind_param('s', $group_id_old);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $oldGroupData = $result->fetch_assoc();
    $checkStmt->close();

    if (!$oldGroupData) {
        throw new Exception('Група не знайдена');
    }

    // Збираємо змінні для bind_param
    $g_im = $_POST['form_im_group'];
    $g_gz = $_POST['g_gz'] ?? $_POST['form_gz'] ?? '';
    $g_sp = $_POST['g_sp'] ?? $_POST['form_sp'] ?? '';
    $g_sz = $_POST['g_sz'] ?? $_POST['form_sz'] ?? '';
    $g_kurs = $_POST['g_kurs'] ?? $_POST['form_cours'] ?? '';
    $g_vipusc = $_POST['g_vp'] ?? $_POST['form_vp'] ?? '';
    $g_count_stud = (int) ($_POST['g_count_stud'] ?? $_POST['form_ks'] ?? 0);
    $g_count_rz = (int) ($_POST['g_count_rz'] ?? $_POST['form_ksd'] ?? 0);
    $g_count_contr = (int) ($_POST['g_count_contr'] ?? $_POST['form_ksk'] ?? 0);
    $g_nast = $_POST['g_nast'] ?? $_POST['form_nast'] ?? '';
    $g_fn = $_POST['g_fn'] ?? $_POST['form_fn'] ?? '';

    // 1. ОНОВЛЮЄМО САМУ ГРУПУ
    $stmt = $linc->prepare("UPDATE st_group SET
         g_im = ?, g_galuz = ?, g_spec = ?, g_specz = ?, g_course = ?,
        g_vipusc = ?, g_count_stud = ?, g_count_derg = ?, g_count_comerc = ?,
        g_nastav = ?, g_formnavch = ?
        WHERE g_im = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту для групи: ' . $linc->error);
    }

    $stmt->bind_param(
        'ssssssiiisss',
        $g_im,
        $g_gz,
        $g_sp,
        $g_sz,
        $g_kurs,
        $g_vipusc,
        $g_count_stud,
        $g_count_rz,
        $g_count_contr,
        $g_nast,
        $g_fn,
        $group_id_old
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні групи: ' . $stmt->error);
    }
    $stmt->close();


    // 2. ОНОВЛЮЄМО ВСІХ СТУДЕНТІВ ЦІЄЇ ГРУПИ
    $updateStudentsStmt = $linc->prepare("UPDATE student SET 
        s_group = ?, 
        s_galuz = ?, 
        s_spec = ?, 
        s_specz = ?, 
        s_cours = ?, 
        s_vip = ?, 
        s_form_navch = ? 
        WHERE s_group = ?");

    if (!$updateStudentsStmt) {
        throw new Exception('Помилка підготовки запиту для студентів: ' . $linc->error);
    }

    $updateStudentsStmt->bind_param(
        'ssssisss', // 'i' для курсу, решта - 's' (рядки)
        $g_im,
        $g_gz,
        $g_sp,
        $g_sz,
        $g_kurs,
        $g_vipusc,
        $g_fn,
        $group_id_old
    );

    if (!$updateStudentsStmt->execute()) {
        throw new Exception('Помилка при оновленні даних студентів: ' . $updateStudentsStmt->error);
    }
    $updateStudentsStmt->close();


    // 3. ОТРИМУЄМО ОНОВЛЕНІ ДАНІ ГРУПИ ДЛЯ ФРОНТЕНДУ
    $selectStmt = $linc->prepare("SELECT * FROM st_group WHERE g_im = ? LIMIT 1");
    if (!$selectStmt) {
        throw new Exception('Помилка при отриманні даних: ' . $linc->error);
    }
    $selectStmt->bind_param('s', $g_im);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $groupData = $result->fetch_assoc();
    $selectStmt->close();

    $response = new ApiResponse(true, 'Групу та всіх прив\'язаних студентів успішно оновлено');
    $response->setData($groupData);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>