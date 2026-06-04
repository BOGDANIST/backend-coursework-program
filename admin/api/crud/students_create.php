<?php
declare(strict_types=1);

/**
 * API Endpoint: Create Student
 * 
 * Refactored from procedural add_student.php to MVC architecture
 * 
 * Uses:
 * - StudentController from Modules\Students\Controllers
 * - StudentModel from Modules\Students\Models
 * - Prepared statements for SQL injection protection
 * - Output buffering (ob_start/ob_get_clean)
 * - Proper HTTP status codes
 * 
 * Usage:
 * POST /admin/api/crud/students_create.php
 * 
 * Request body (JSON or form-data):
 * {
 *   "form_group": "ІС-21",
 *   "form_pr_stud": "Прізвище",
 *   "form_im_stud": "Ім'я",
 *   "form_bat_stud": "По батькові",
 *   "form_sex": "М/Ж",
 *   "form_date_nar": "2002-05-15",
 *   "form_zamovl": "Так/Ні",
 *   "form_osvita": "Повна загальна середня освіта",
 *   "form_zscool": "2020",
 *   "form_region_type": "Місто",
 *   "form_region": "Київська",
 *   "form_sirot": true/false,
 *   "form_peres": true/false,
 *   "form_ivalid": true/false,
 *   "form_malozab": true/false,
 *   "form_uchbd": true/false,
 *   ...
 * }
 * 
 * Response (201 Created):
 * {
 *   "success": true,
 *   "message": "Студента успішно додано",
 *   "status_code": 201,
 *   "data": {
 *     "s_id": 123,
 *     "s_group": "ІС-21",
 *     "s_pr": "Прізвище",
 *     ...
 *   }
 * }
 * 
 * Response (400 Bad Request):
 * {
 *   "success": false,
 *   "message": "Помилки валідації",
 *   "status_code": 400,
 *   "errors": {
 *     "form_group": "Такої групи не існує",
 *     "form_pr_stud": "Це поле обов'язкове"
 *   }
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

// Start output buffering to ensure clean headers
ob_start();

try {
    $controller = new StudentController();
    $controller->execute('create');
} catch (Throwable $e) {
    // Clear any buffered output before error response
    if (ob_get_level() > 0) {
        ob_end_clean();
    }

    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode([
        'success' => false,
        'message' => 'Внутрішня помилка сервера',
        'status_code' => 500,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
