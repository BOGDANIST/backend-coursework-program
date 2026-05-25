<?php
session_start();
include("../../include/db_connect.php");
include("../ApiResponse.php");

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
    ApiResponse::error('Немає доступу', 403)->send();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ApiResponse::error('Лише POST запити', 400)->send();
    exit;
}

$id = isset($_POST['id']) ? $_POST['id'] : '';

if (!$id) {
    ApiResponse::error('ID групи не вказано')->send();
    exit;
}

$id = mysqli_real_escape_string($linc, $id);

$query = "DELETE FROM old_group WHERE g_im = ?";
$stmt = mysqli_prepare($linc, $query);

if (!$stmt) {
    ApiResponse::error('Помилка підготовки запиту')->send();
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $id);

if (mysqli_stmt_execute($stmt)) {
    ApiResponse::success('Група видалена')->send();
} else {
    ApiResponse::error('Помилка видалення')->send();
}

mysqli_stmt_close($stmt);
?>
