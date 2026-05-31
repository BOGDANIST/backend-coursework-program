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
    //провірка
    //throw new Exception('$_POST: ' . print_r($_POST, true));
    if (empty($_POST['id'])) {
        throw new Exception('ID студента не вказано');
    }
 //throw new Exception(print_r($_POST));
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


      // 1. Спочатку отримуємо назву групи з $_POST
$form_group = $_POST['form_group'];

// 2. Ініціалізуємо змінні порожніми значеннями на випадок помилки
$form_galuz       = '';
$form_spec        = '';
$form_specz       = '';
$form_form_navch  = '';
$form_cours       = '';

// 3. Робимо безпечний запит до таблиці груп (st_group), щоб витягнути дані цієї групи
$stmt_group = $linc->prepare("SELECT g_galuz, g_spec, g_specz, g_formnavch, g_course FROM st_group WHERE g_im = ?");
if ($stmt_group) {
    $stmt_group->bind_param('s', $form_group);
    $stmt_group->execute();
    $result_group = $stmt_group->get_result();

    // Якщо таку групу знайдено в базі
    if ($row_group = $result_group->fetch_assoc()) {
        $form_galuz       = $row_group['g_galuz'];
        $form_spec        = $row_group['g_spec'];
        $form_specz       = $row_group['g_specz'];
        $form_form_navch  = $row_group['g_formnavch'];
        $form_cours       = $row_group['g_course'];
    }
    $stmt_group->close();
} else {
    throw new Exception('Помилка підготовки запиту до таблиці груп: ' . $linc->error);
}


    // Обробка чекбоксів
    $sirot = !empty($_POST['form_sirot']) ? 'Так' : 'Ні';
    $peres = !empty($_POST['form_peres']) ? 'Так' : 'Ні';
    $ivalid = $_POST['form_ivalid'] ?? $_POST['s_inval'] ?? 'Ні';
    $malozab = !empty($_POST['form_malozab']) ? 'Так' : 'Ні';
    $uchbd = !empty($_POST['form_uchbd']) ? 'Так' : 'Ні';
    $chernob = !empty($_POST['form_chernob']) ? 'Так' : 'Ні';
    $ato = !empty($_POST['form_ato']) ? 'Так' : 'Ні';
    $ditzag = !empty($_POST['form_ditzag']) ? 'Так' : 'Ні';
    $rada = !empty($_POST['form_rada']) ? 'Так' : 'Ні';
    $shahter = !empty($_POST['form_shahter']) ? 'Так' : 'Ні';
    $vip = !empty($_POST['form_vip']) ? 'Так' : 'Ні';

    // Підготовка змінних для bind_param
    $form_group = $_POST['form_group'] ?? '';
    $form_pr_stud = $_POST['form_pr_stud'] ?? '';
    $form_im_stud = $_POST['form_im_stud'] ?? '';
    $form_bat_stud = $_POST['form_bat_stud'] ?? '';
    $form_sex = $_POST['form_sex'] ?? '';
    $form_zamovl = $_POST['form_zamovl'] ?? $_POST['form_zamovl_stud'] ??'';
    $form_date_nar = $_POST['form_date_nar'] ?? '';
    $form_adres = $_POST['form_adres'] ?? '';
    $form_tel_st = $_POST['form_tel_st'] ?? '';
    $form_tel_bat = $_POST['form_tel_bat'] ?? '';
    $form_tel_mut = $_POST['form_tel_mut'] ?? '';
    $form_osvita = $_POST['form_osvita'] ?? $_POST['form_osvita_stud'] ?? '';
    $form_zscool = $_POST['form_zscool'] ?? '';
    $form_region_type = $_POST['form_reg_type'] ?? $_POST['form_reg_type_stud'] ?? '';
    $form_region = $_POST['form_region'] ?? $_POST['form_region_stud'] ??'';
    // $form_galuz = $_POST['form_galuz'] ?? '';
    // $form_spec = $_POST['form_spec'] ?? '';

    
    // Підготовлений запит
    $stmt = $linc->prepare("UPDATE student SET
        s_group = ?, s_pr = ?, s_im = ?, s_bat = ?, s_stat = ?, s_contract = ?,
        s_dnar = ?, s_vik = ?, s_adresa = ?, s_tels = ?, s_telb = ?, s_telm = ?,
        s_osvita_type = ?, s_rik_zaver = ?, s_region_type = ?, s_region = ?,
        s_galuz = ?, s_spec = ?, s_specz = ?, s_sirota = ?, s_peresel = ?, s_inval = ?,
        s_malozab = ?, s_war_act = ?, s_chernob = ?, s_ato = ?, s_ditzag = ?,
        s_rada = ?, s_shahter = ?, s_vip = ?, s_cours= ?, s_form_navch = ?
        WHERE s_id = ?");

    if (!$stmt) {
        throw new Exception('Помилка підготовки запиту: ' . $linc->error);
    }

    $stmt->bind_param(
        'sssssssssssssssssssssssssssssssss',
        $form_group,
        $form_pr_stud,
        $form_im_stud,
        $form_bat_stud,
        $form_sex,
        $form_zamovl,
        $form_date_nar,
        $vik,
        $form_adres,
        $form_tel_st,
        $form_tel_bat,
        $form_tel_mut,
        $form_osvita,
        $form_zscool,
        $form_region_type,
        $form_region,
        $form_galuz,
        $form_spec,
        $form_specz,
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
        $form_cours,
        $form_form_navch,
        $student_id
    );

    if (!$stmt->execute()) {
        throw new Exception('Помилка при оновленні студента: ' . $stmt->error);
    }

    // Fetch updated student data to return to client
    $selectStmt = $linc->prepare("SELECT * FROM student WHERE s_id = ?");
    if (!$selectStmt) {
        throw new Exception('Помилка при отриманні даних: ' . $linc->error);
    }
    $selectStmt->bind_param('i', $student_id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $studentData = $result->fetch_assoc();
    $selectStmt->close();

    $response = new ApiResponse(true, $_POST);
    $response->setData($studentData);

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    if (!empty($errors)) {
        $response->setErrors($errors);
    }
}

$response->send();
?>
