<?php
session_start();

if (!in_array($_SESSION['auth_user'] ?? '', ['admin', 'editor', 'viewer'])) {
    header('HTTP/1.1 403 Forbidden');
    include __DIR__ . '/../ApiResponse.php';
    (new ApiResponse(false, 'Доступ заборонено'))->send();
}

include '../../../include/db_connect.php';
include '../ApiResponse.php';

error_reporting(0);

try {
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? in_array((int)$_GET['limit'], [10, 25, 50, 100]) ? (int)$_GET['limit'] : 50 : 50;
    $offset = ($page - 1) * $limit;

    // Build query from filters
    $query_all = "1=1";

    // Courses
    $courses = [];
    if (isset($_POST['check_kurs1']) && $_POST['check_kurs1']) $courses[] = "'1'";
    if (isset($_POST['check_kurs2']) && $_POST['check_kurs2']) $courses[] = "'2'";
    if (isset($_POST['check_kurs3']) && $_POST['check_kurs3']) $courses[] = "'3'";
    if (isset($_POST['check_kurs4']) && $_POST['check_kurs4']) $courses[] = "'4'";

    if (!empty($courses)) {
        $query_all .= " AND g_course IN(" . implode(',', $courses) . ")";
    }

    // Year of graduation range
    $year_from = isset($_POST['year_from']) && $_POST['year_from'] !== '' ? (int)$_POST['year_from'] : null;
    $year_to = isset($_POST['year_to']) && $_POST['year_to'] !== '' ? (int)$_POST['year_to'] : null;

    if ($year_from !== null && $year_to !== null) {
        $query_all .= " AND g_year_vipusc BETWEEN $year_from AND $year_to";
    } elseif ($year_from !== null) {
        $query_all .= " AND g_year_vipusc >= $year_from";
    } elseif ($year_to !== null) {
        $query_all .= " AND g_year_vipusc <= $year_to";
    }

    // Sorting
    $sort_by = $_POST['sort_by'] ?? '';
    $sort_dir = strtoupper($_POST['sort_dir'] ?? 'ASC');

    $allowed_sorts = ['g_im', 'g_course', 'g_year_vipusc'];
    $allowed_dirs = ['ASC', 'DESC'];

    $order_clause = '';
    if (in_array($sort_by, $allowed_sorts) && in_array($sort_dir, $allowed_dirs)) {
        if ($sort_by === 'g_course' || $sort_by === 'g_year_vipusc') {
            $order_clause = " ORDER BY CAST($sort_by AS UNSIGNED) $sort_dir";
        } else {
            $order_clause = " ORDER BY $sort_by COLLATE utf8_unicode_ci $sort_dir";
        }
    }

    // Get total count
    $count_query = "SELECT COUNT(*) as total FROM old_group WHERE $query_all";
    $count_result = mysqli_query($linc, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total = $count_row['total'];

    // Get paginated results
    $data_query = "SELECT * FROM old_group WHERE $query_all $order_clause LIMIT $offset, $limit";
    $result = mysqli_query($linc, $data_query);

    if (!$result) {
        throw new Exception('Database query failed: ' . mysqli_error($linc));
    }

    $groups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $groups[] = $row;
    }

    $response = new ApiResponse(true, "Знайдено $total груп");
    $response->setData($groups);
    $response->setPagination($total, $page, $limit);
    $response->send();

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    $response->send();
}
?>
