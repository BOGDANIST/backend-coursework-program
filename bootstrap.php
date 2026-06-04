<?php
declare(strict_types=1);

/**
 * Bootstrap file - initializes the application
 * Include this at the start of every API endpoint
 */

// Ensure we're using strict types
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('log_errors', '1');

// Set timezone
date_default_timezone_set('Europe/Kiev');

// Get the base path
$basePath = __DIR__;

// Require autoloader
require_once 'C:\Users\owner\Desktop\Politeh\backend\backend-coursework-program\Autoloader.php';

// Register autoloader
$autoloader = new Autoloader($basePath);
$autoloader->register();

// Load configuration
require_once 'C:\Users\owner\Desktop\Politeh\backend\backend-coursework-program\config\Config.php';

// Use configuration classes
use App\Config\DatabaseConfig;
use App\Core\Database;

// Initialize database connection
try {
    Database::getInstance(
        DatabaseConfig::HOST,
        DatabaseConfig::USER,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DATABASE,
        DatabaseConfig::CHARSET
    );
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Не удалось подключиться к базе данных',
        'status_code' => 500
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
