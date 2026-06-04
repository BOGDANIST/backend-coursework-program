<?php
declare(strict_types=1);

require_once dirname(__DIR__, 3) . '/bootstrap.php';

use App\Modules\Specialties\Controllers\SpecialtyController;

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', dirname(__DIR__, 3) . '/error.log');

ob_start();

try {
    $controller = new SpecialtyController();
    $controller->execute('create');
} catch (Throwable $e) {
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');

    error_log("[" . date('Y-m-d H:i:s') . "] SpecialtyCreate Error: " . $e->getMessage());

    echo json_encode([
        'success' => false,
        'message' => 'Внутрішня помилка сервера',
        'status_code' => 500,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
