<?php
declare(strict_types=1);

/**
 * API Endpoint: Edit User
 * 
 * Refactored from procedural edit_user.php to MVC architecture
 * 
 * Uses:
 * - UserController from Modules\Users\Controllers
 * - UserModel from Modules\Users\Models
 * - Prepared statements for SQL injection protection
 * - Output buffering (ob_start/ob_get_clean)
 * - Only admin role has access
 * - Proper HTTP status codes
 * 
 * Usage:
 * POST /admin/api/crud/users_edit.php
 * 
 * Request body - Update password and role:
 * {
 *   "user_id": 5,
 *   "status": "admin",
 *   "new_password1": "newPassword123",
 *   "new_password2": "newPassword123"
 * }
 * 
 * Request body - Update role only:
 * {
 *   "user_id": 5,
 *   "status": "editor"
 * }
 * 
 * Available roles:
 * - user (status 1) - Default user
 * - viewer (status 8) - Read-only access
 * - editor (status 9) - Edit access
 * - admin (status 10) - Full admin access
 * 
 * Response (200 OK):
 * {
 *   "success": true,
 *   "message": "Пароль та роль користувача успішно оновлено",
 *   "status_code": 200,
 *   "data": {
 *     "user_id": 5,
 *     "login": "john",
 *     "status": "10",
 *     "role": "admin"
 *   }
 * }
 * 
 * Response (403 Forbidden - not admin):
 * {
 *   "success": false,
 *   "message": "Доступ заборонено",
 *   "status_code": 403
 * }
 * 
 * Response (404 Not Found):
 * {
 *   "success": false,
 *   "message": "Користувач не знайдено",
 *   "status_code": 404
 * }
 */

require_once dirname(__DIR__, 3) . '/bootstrap.php';

use App\Modules\Users\Controllers\UserController;

// Start output buffering to ensure clean headers
ob_start();

try {
    $controller = new UserController();
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
