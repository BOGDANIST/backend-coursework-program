<?php
if (!(isset($_POST['download_excel']) && $_POST['download_excel'] === 'yes')) { exit;}
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Параметри підключення до БД
require '../../include/db_connect.php';

$host = $db_host;
$user = $db_user;
$pass = $db_pass;
$db   = $db_database; 
$charset = $db_charset;

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

////////////////////////////////////////////////////////

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    session_start();
    $query_all = $_SESSION['query_all'] ?? '';
    $result_to_xlsx = $_SESSION['result_to_xlsx'] ?? '';

    $query = $result_to_xlsx;
    $stmt = $pdo->query($query);

    $results = $stmt->fetchAll();

    if (!$results) {
        die('Немає результатів.');
    }

    // Створити Excel-файл
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Заголовки
    $columns = array_keys($results[0]);
    $colIndex = 1;
    foreach ($columns as $col) {
        $sheet->setCellValueByColumnAndRow($colIndex++, 1, $col);
    }

    // Дані
    $rowIndex = 2;
    foreach ($results as $row) {
        $colIndex = 1;
        foreach ($row as $value) {
            $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $value);
        }
        $rowIndex++;
    }

    // Відправити файл користувачу
    $date_now=date("Y-m-d");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Звіт_по_студентам_на_'.$date_now.'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    echo 'Помилка: ' . $e->getMessage();
}
