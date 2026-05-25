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

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if (!$id) {
    ApiResponse::error('ID студента не вказано')->send();
    exit;
}

$query = "DELETE FROM old_student WHERE s_id = ?";
$stmt = mysqli_prepare($linc, $query);

if (!$stmt) {
    ApiResponse::error('Помилка підготовки запиту')->send();
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    ApiResponse::success('Студент видалений')->send();
} else {
    ApiResponse::error('Помилка видалення')->send();
}

mysqli_stmt_close($stmt);
?>
