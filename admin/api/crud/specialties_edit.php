<?php
declare(strict_types=1);

require_once dirname(__DIR__, 3) . '/bootstrap.php';

use App\Modules\Specialties\Controllers\SpecialtyController;

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', dirname(__DIR__, 3) . '/error.log');

$logMessage = sprintf(
    "[%s] POST to specialties_edit.php. POST keys: %s",
    date('Y-m-d H:i:s'),
    implode(', ', array_keys($_POST))
);
error_log($logMessage);

ob_start();

try {
    $controller = new SpecialtyController();
    $controller->execute('edit');
} catch (Throwable $e) {
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');

    $errorLog = sprintf(
        "[%s] SpecialtyEdit Error: %s\nFile: %s:%d\nStack: %s",
        date('Y-m-d H:i:s'),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
    );
    error_log($errorLog);

    echo json_encode([
        'success' => false,
        'message' => 'Внутрішня помилка сервера',
        'status_code' => 500,
        'error' => $e->getMessage(),
        'debug_file' => $e->getFile(),
        'debug_line' => $e->getLine()
    ], JSON_UNESCAPED_UNICODE);
}
