<?php
session_start();

if (!in_array($_SESSION['auth_user'] ?? '', ['admin', 'editor', 'viewer'])) {
    header('HTTP/1.1 403 Forbidden');
    include __DIR__ . '/../api/ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
}

include '../../../include/db_connect.php';
include '../ApiResponse.php';

error_reporting(0);

try {
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? in_array((int)$_GET['limit'], [10, 25, 50, 100]) ? (int)$_GET['limit'] : 50 : 50 ;
    if(isset($_GET['limit']) && ($_GET['limit']=='all')){
        $limit = 1000000;
    }
    $offset = ($page - 1) * $limit;

    // Build query from filters
    $query_all = "1=1";

    // Contract type
    $check_vz0 = $_POST['check_vz0'] ?? '';
    $check_vz1 = $_POST['check_vz1'] ?? '';

    if ($check_vz0 || $check_vz1) {
        $vz_values = [];
        if ($check_vz0) $vz_values[] = "'" . mysqli_real_escape_string($linc, $check_vz0) . "'";
        if ($check_vz1) $vz_values[] = "'" . mysqli_real_escape_string($linc, $check_vz1) . "'";
        $query_all .= " AND s_contract IN(" . implode(',', $vz_values) . ")";
    }

    // Fields of knowledge
    $check_gz = $_POST['check_gz'] ?? [];
    // if (empty($check_gz)) {
    //     $gz_query = "SELECT DISTINCT s_galuz FROM student ORDER BY s_galuz ASC";
    //     $result = mysqli_query($linc, $gz_query);
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $check_gz[] = $row['s_galuz'];
    //     }
    // }

    if (!empty($check_gz)) {
        $escaped_gz = array_map(function ($v) use ($linc) {
            return "'" . mysqli_real_escape_string($linc, $v) . "'";
        }, $check_gz);
        $query_all .= " AND s_galuz IN(" . implode(',', $escaped_gz) . ")";
    }

//PIB
    if (!empty($_POST['s_pib'])) {
        $query_all .= " AND s_pr = '".$_POST['s_pib']."'  OR s_im = '".$_POST['s_pib']."' OR s_bat = '".$_POST['s_pib']."'";
    }

    // Specialties
    $check_sp = $_POST['check_sp'] ?? [];
    // if (empty($check_sp)) {
    //     $spec_query = "SELECT DISTINCT im_spec FROM spec ORDER BY id_spec ASC";
    //     $result = mysqli_query($linc, $spec_query);
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $check_sp[] = $row['im_spec'];
    //     }
    // }

    if (!empty($check_sp)) {
        $escaped_sp = array_map(function ($v) use ($linc) {
            return "'" . mysqli_real_escape_string($linc, $v) . "'";
        }, $check_sp);
        $query_all .= " AND s_spec IN(" . implode(',', $escaped_sp) . ")";
    }

    // Courses
    $courses = [];
    if (isset($_POST['check_kurs1']) && $_POST['check_kurs1']) $courses[] = "'1'";
    if (isset($_POST['check_kurs2']) && $_POST['check_kurs2']) $courses[] = "'2'";
    if (isset($_POST['check_kurs3']) && $_POST['check_kurs3']) $courses[] = "'3'";
    if (isset($_POST['check_kurs4']) && $_POST['check_kurs4']) $courses[] = "'4'";

    if (!empty($courses)) {
        $query_all .= " AND s_cours IN(" . implode(',', $courses) . ")";
    } else {
        $query_all .= " AND s_cours IN('1','2','3','4')";
    }

    // Graduation group
    if (isset($_POST['check_vg']) && $_POST['check_vg']) {
        $query_all .= " AND s_vip = 'Так'";
    }

    // Gender
    $genders = [];
    if (isset($_POST['check_men']) && $_POST['check_men']) $genders[] = "'Чоловік'";
    if (isset($_POST['check_women']) && $_POST['check_women']) $genders[] = "'Жінка'";

    if (!empty($genders)) {
        $query_all .= " AND s_stat IN(" . implode(',', $genders) . ")";
    }

    // Education type
    $education_types = [];
    if (isset($_POST['check_os1']) && $_POST['check_os1']) {
        $education_types[] = "'Базова загальна середня освіта'";
        $education_types[] = "'Базова середня освіта'";
    }
    if (isset($_POST['check_os2']) && $_POST['check_os2']) {
        $education_types[] = "'Повна загальна середня освіта'";
        $education_types[] = "'Повна середня освіта'";
    }
    if (isset($_POST['check_os3']) && $_POST['check_os3']) $education_types[] = "'Молодший спеціаліст'";
    if (isset($_POST['check_os4']) && $_POST['check_os4']) $education_types[] = "'Кваліфікований робітник'";

    if (!empty($education_types)) {
        $query_all .= " AND s_osvita_type IN(" . implode(',', $education_types) . ")";
    }

    // Age range
    $vik_from = isset($_POST['vik_from']) && $_POST['vik_from'] !== '' ? (int)$_POST['vik_from'] : null;
    $vik_to = isset($_POST['vik_to']) && $_POST['vik_to'] !== '' ? (int)$_POST['vik_to'] : null;

    if ($vik_from !== null && $vik_to !== null) {
        $query_all .= " AND s_vik BETWEEN $vik_from AND $vik_to";
    } elseif ($vik_from !== null) {
        $query_all .= " AND s_vik >= $vik_from";
    } elseif ($vik_to !== null) {
        $query_all .= " AND s_vik <= $vik_to";
    }

    // Group
    $form_group = $_POST['form_group'] ?? '';
    if ($form_group) {
        $query_all .= " AND s_group = '" . mysqli_real_escape_string($linc, $form_group) . "'";
    }

    // Region
    $select_region = $_POST['select_region'] ?? '';
    if ($select_region) {
        $query_all .= " AND s_region = '" . mysqli_real_escape_string($linc, $select_region) . "'";
    }

    // Housing
    $housing = [];
    if (isset($_POST['check_mp1']) && $_POST['check_mp1']) $housing[] = "'Місто'";
    if (isset($_POST['check_mp2']) && $_POST['check_mp2']) {
        $housing[] = "'Сільська місцевість'";
        $housing[] = "'Село'";
    }

    if (!empty($housing)) {
        $query_all .= " AND s_region_type IN(" . implode(',', $housing) . ")";
    }

    // Social categories
    $social_conditions = [];
    if (isset($_POST['check_sirot']) && $_POST['check_sirot']) $social_conditions[] = "s_sirota = 'Так'";
    if (isset($_POST['check_peres']) && $_POST['check_peres']) $social_conditions[] = "s_peresel = 'Так'";
    if (isset($_POST['check_chernob']) && $_POST['check_chernob']) $social_conditions[] = "s_chernob = 'Так'";
    if (isset($_POST['check_ivalid']) && $_POST['check_ivalid']) $social_conditions[] = "s_inval = 'Так'";
    if (isset($_POST['check_malozab']) && $_POST['check_malozab']) $social_conditions[] = "s_malozab = 'Так'";
    if (isset($_POST['check_ato']) && $_POST['check_ato']) $social_conditions[] = "s_ato = 'Так'";
    if (isset($_POST['check_uchbd']) && $_POST['check_uchbd']) $social_conditions[] = "s_war_act = 'Так'";
    if (isset($_POST['check_ditzag']) && $_POST['check_ditzag']) $social_conditions[] = "s_ditzag = 'Так'";
    if (isset($_POST['check_stepver']) && $_POST['check_stepver']) $social_conditions[] = "s_rada = 'Так'";
    if (isset($_POST['check_shaht']) && $_POST['check_shaht']) $social_conditions[] = "s_shahter = 'Так'";

    if (!empty($social_conditions)) {
        $query_all .= " AND (" . implode(" OR ", $social_conditions) . ")";
    }

    // Sorting
    $sort_by = $_POST['sort_by'] ?? '';
    $sort_dir = strtoupper($_POST['sort_dir'] ?? 'ASC');

    $allowed_sorts = ['s_pr', 's_group', 's_cours', 's_dnar'];
    $allowed_dirs = ['ASC', 'DESC'];

    $order_clause = '';
    if (in_array($sort_by, $allowed_sorts) && in_array($sort_dir, $allowed_dirs)) {
        if ($sort_by === 's_cours') {
            $order_clause = " ORDER BY CAST(s_cours AS UNSIGNED) $sort_dir";
        } elseif ($sort_by === 's_dnar') {
            $order_clause = " ORDER BY CAST(s_vik AS UNSIGNED) $sort_dir";
        } else {
            $order_clause = " ORDER BY $sort_by COLLATE utf8_unicode_ci $sort_dir";
        }
    }

    // Get total count
    $count_query = "SELECT COUNT(*) as total FROM student WHERE $query_all";
    $count_result = mysqli_query($linc, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total = $count_row['total'];

    // Get paginated results
    $data_query = "SELECT * FROM student WHERE $query_all $order_clause LIMIT $offset, $limit";
    $result = mysqli_query($linc, $data_query);

    if (!$result) {
        throw new Exception('Database query failed: ' . mysqli_error($linc));
    }

    $students = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }

    $response = new ApiResponse(true, "Знайдено $total студентів");
    //$response = new ApiResponse(true, "Дані успішно онолвено");
    $response->setData($students);
    $response->setPagination($total, $page, $limit);
    $response->send();
} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    $response->send();
}
