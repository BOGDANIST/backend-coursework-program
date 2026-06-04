<?php
declare(strict_types=1);

/**
 * API Endpoint: Edit Student
 * 
 * Refactored from procedural edit_student.php to MVC architecture
 * 
 * Uses:
 * - StudentController from Modules\Students\Controllers
 * - StudentModel from Modules\Students\Models
 * - Prepared statements for SQL injection protection
 * - Output buffering (ob_start/ob_get_clean)
 * - Proper HTTP status codes
 * 
 * Usage:
 * POST /admin/api/crud/students_edit.php
 * 
 * Request body (JSON or form-data):
 * {
 *   "id": 123,
 *   "form_group": "ІС-21",
 *   "form_pr_stud": "Прізвище",
 *   "form_im_stud": "Ім'я",
 *   "form_bat_stud": "По батькові",
 *   "form_sex": "М/Ж",
 *   "form_date_nar": "2002-05-15",
 *   ...
 * }
 * 
 * Response (200 OK):
 * {
 *   "success": true,
 *   "message": "Студента успішно оновлено",
 *   "status_code": 200,
 *   "data": { ... student data ... }
 * }
 * 
 * Response (403 Forbidden):
 * {
 *   "success": false,
 *   "message": "Доступ заборонено",
 *   "status_code": 403
 * }
 */

require_once dirname(__DIR__, 3) . '/bootstrap.php';

use App\Modules\Students\Controllers\StudentController;

// Enable detailed error logging
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', dirname(__DIR__, 3) . '/error.log');

// Log request details for debugging
$logMessage = sprintf(
    "[%s] POST to students_edit.php. POST keys: %s",
    date('Y-m-d H:i:s'),
    implode(', ', array_keys($_POST))
);
error_log($logMessage);

// Start output buffering to ensure clean headers
ob_start();

try {
    $controller = new StudentController();
    $controller->execute('edit');
} catch (Throwable $e) {
    // Clear any buffered output before error response
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');

    // Log detailed error for debugging
    $errorLog = sprintf(
        "[%s] StudentEdit Error: %s\nFile: %s:%d\nStack: %s",
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
