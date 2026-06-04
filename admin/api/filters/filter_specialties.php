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

    // Fields of knowledge
    $check_gz = $_POST['check_gz'] ?? [];
    if (empty($check_gz)) {
        $gz_query = "SELECT DISTINCT id_galuz FROM spec ORDER BY id_galuz ASC";
        $result = mysqli_query($linc, $gz_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $check_gz[] = $row['id_galuz'];
        }
    }

    if (!empty($check_gz)) {
        $escaped_gz = array_map(function($v) use ($linc) {
            return "'" . mysqli_real_escape_string($linc, $v) . "'";
        }, $check_gz);
        $query_all .= " AND id_galuz IN(" . implode(',', $escaped_gz) . ")";
    }

    // Sorting
    $sort_by = $_POST['sort_by'] ?? '';
    $sort_dir = strtoupper($_POST['sort_dir'] ?? 'ASC');

    $allowed_sorts = ['im_spec', 'im_galuz'];
    $allowed_dirs = ['ASC', 'DESC'];

    $order_clause = '';
    if (in_array($sort_by, $allowed_sorts) && in_array($sort_dir, $allowed_dirs)) {
        $order_clause = " ORDER BY $sort_by COLLATE utf8_unicode_ci $sort_dir";
    }

    // Get total count
    $count_query = "SELECT COUNT(*) as total FROM spec WHERE $query_all";
    $count_result = mysqli_query($linc, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total = $count_row['total'];

    // Get paginated results
    $data_query = "SELECT * FROM spec WHERE $query_all $order_clause LIMIT $offset, $limit";
    $result = mysqli_query($linc, $data_query);

    if (!$result) {
        throw new Exception('Database query failed: ' . mysqli_error($linc));
    }

    $specs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $specs[] = $row;
    }

    $response = new ApiResponse(true, $specs);
    $response->setData($specs);
    $response->setPagination($total, $page, $limit);
    $response->send();

} catch (Exception $e) {
    $response = new ApiResponse(false, $e->getMessage());
    $response->send();
}
?>
