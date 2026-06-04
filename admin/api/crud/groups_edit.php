<?php
declare(strict_types=1);

/**
 * API Endpoint: Edit Group
 * 
 * New Architecture (MVC):
 * - Uses GroupController from Modules\Groups\Controllers
 * - GroupController handles business logic
 * - GroupModel handles database operations
 * - All database operations use prepared statements
 * - Output buffering ensures clean headers
 * - Proper HTTP status codes (403, 404, 500, etc.)
 * 
 * Usage:
 * POST /admin/api/crud/groups/edit
 * 
 * Request body (JSON or form-data):
 * {
 *   "id": "group_name",
 *   "form_im_group": "new_group_name",
 *   "form_gz": "galuz",
 *   "form_sp": "specialization",
 *   ...
 * }
 */

require_once dirname(__DIR__, 3) . '/bootstrap.php';

use App\Modules\Groups\Controllers\GroupController;

// Start output buffering to ensure clean headers
ob_start();

try {
    $controller = new GroupController();
    $controller->execute('edit');
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
