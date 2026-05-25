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
        throw new Exception('ID студента не вказано');
    }

    $student_id = (int)$_POST['id'];

    // Валідація обов'язкових полів
    $required = ['form_group', 'form_pr_stud', 'form_im_stud', 'form_bat_stud'];
    foreach ($required as $field) {
        if (empty($_POST[$field] ?? '')) {
            $errors[$field] = 'Це поле обов\'язкове';
        }
    }

    if (!empty($errors)) {
        $response->setErrors($errors);
        throw new Exception('Помилки валідації');
    }

    // Розрахунок віку у повних роках
    $vik = null;
    if (isset($_POST['form_date_nar']) && $_POST['form_date_nar']) {
        $birthday = new DateTime($_POST['form_date_nar']);
        $interval = $birthday->diff(new DateTime);
        $vik = $interval->y;
    }

    // Обробка чекбоксів
    $sirot = !empty($_POST['form_sirot']) ? 'Так' : 'Ні';
    $peres = !empty($_POST['form_peres']) ? 'Так' : 'Ні';
    $ivalid = !empty($_POST['form_ivalid']) ? 'Так' : 'Ні';
    $malozab = !empty($_POST['form_malozab']) ? 'Так' : 'Ні';
    $uchbd = !empty($_POST['form_uchbd']) ? 'Так' : 'Ні';
    $chernob = !empty($_POST['form_chernob']) ? 'Так' : 'Ні';
    $ato = !empty($_POST['form_ato']) ? 'Так' : 'Ні';
    $ditzag = !empty($_POST['form_ditzag']) ? 'Так' : 'Ні';
    $rada = !empty($_POST['form_rada']) ? 'Так' : 'Ні';
    $shahter = !empty($_POST['form_shahter']) ? 'Так' : 'Ні';
    $vip = !empty($_POST['form_vip']) ? 'Так' : 'Ні';

    // Підготовлений запит
    $stmt = $linc->prepare("UPDATE student SET
        s_group = ?, s_pr = ?, s_im = ?, s_bat = ?, s_stat = ?, s_contract = ?,
        s_dnar = ?, s_vik = ?, s_adresa = ?, s_tels = ?, s_telb = ?, s_telm = ?,
        s_osvita_type = ?, s_rik_zaver = ?, s_region_type = ?, s_region = ?,
        s_galuz = ?, s_spec = ?, s_sirota = ?, s_peresel = ?, s_inval = ?,
        s_malozab = ?, s_war_act = ?, s_chernob = ?, s_ato = ?, s_ditzag = ?,
        s_rada = ?, s_shahter = ?, s_vip = ?
        WHERE s_id = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param(
        'sssssssissssssssssssssssssi',
        $_POST['form_group'],
        $_POST['form_pr_stud'],
        $_POST['form_im_stud'],
        $_POST['form_bat_stud'],
        $_POST['form_sex'] ?? '',
        $_POST['form_zamovl'] ?? '',
        $_POST['form_date_nar'] ?? '',
        $vik,
        $_POST['form_adres'] ?? '',
        $_POST['form_tel_st'] ?? '',
        $_POST['form_tel_bat'] ?? '',
        $_POST['form_tel_mut'] ?? '',
        $_POST['form_osvita'] ?? '',
        $_POST['form_zscool'] ?? '',
        $_POST['form_region_type'] ?? '',
        $_POST['form_region'] ?? '',
        $_POST['form_galuz'] ?? '',
        $_POST['form_spec'] ?? '',
        $sirot,
        $peres,
        $ivalid,
        $malozab,
        $uchbd,
        $chernob,
        $ato,
        $ditzag,
        $rada,
        $shahter,
        $vip,
        $student_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні студента: ' . $stmt->error);
    }

    $response = new ApiResponse(true, 'Студента успішно оновлено');
    $response->setData(['id' => $student_id]);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
