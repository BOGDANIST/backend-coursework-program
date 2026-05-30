<?php
if (!(isset($_POST['download_excel']) && $_POST['download_excel'] === 'yes')) { 
    exit('Invalid request');
}

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Отримуємо дані безпосередньо з POST-запиту
$jsonData = $_POST['export_data'] ?? '[]';
$results = json_decode($jsonData, true);

if (empty($results)) {
    die('Немає результатів для експорту.');
}

try {
    // Створити Excel-файл
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Формуємо заголовки (беремо ключі з першого масиву)
    $columns = array_keys($results[0]);
    $colIndex = 1;
    foreach ($columns as $col) {
        $sheet->setCellValueByColumnAndRow($colIndex++, 1, $col);
    }

    // Заповнюємо дані
    $rowIndex = 2;
    foreach ($results as $row) {
        $colIndex = 1;
        foreach ($row as $value) {
            $sheet->setCellValueByColumnAndRow($colIndex++, $rowIndex, $value);
        }
        $rowIndex++;
    }

    // Відправляємо файл користувачу
    $date_now = date("Y-m-d");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Звіт_по_студентам_на_'.$date_now.'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    echo 'Помилка: ' . $e->getMessage();
}
?>