<?php
declare(strict_types=1);

// Всі USE мають бути виключно на початку файлу!
use App\Config\DatabaseConfig;
use App\Core\Database;
use App\Modules\Students\Controllers\StudentController;
use App\Modules\Students\Models\StudentModel;

/**
 * Diagnostic endpoint for debugging the MVC architecture
 * Tests bootstrap, autoloader, and database connection
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

$basePath = dirname(__DIR__, 3);

// Test 1: Check if Autoloader exists
echo "TEST 1: Autoloader\n";
$autoloaderPath = $basePath . '/Autoloader.php';
if (file_exists($autoloaderPath)) {
    echo "✓ Autoloader found at: $autoloaderPath\n";
    require_once $autoloaderPath;
    echo "✓ Autoloader loaded\n";
} else {
    echo "✗ Autoloader NOT found at: $autoloaderPath\n";
}

// Test 2: Register autoloader
echo "\nTEST 2: Register Autoloader\n";
$autoloader = new Autoloader($basePath);
$autoloader->register();
echo "✓ Autoloader registered\n";

// Test 3: Load config
echo "\nTEST 3: Load Config\n";
require_once $basePath . '/config/Config.php';
echo "✓ Config loaded\n";

// Test 4: Initialize database
echo "\nTEST 4: Database Connection\n";
try {
    Database::getInstance(
        DatabaseConfig::HOST,
        DatabaseConfig::USER,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DATABASE,
        DatabaseConfig::CHARSET
    );
    echo "✓ Database connection successful\n";
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
}

// Test 5: Load StudentController
echo "\nTEST 5: Check StudentController Class\n";
if (class_exists(StudentController::class)) {
    echo "✓ StudentController class found and loaded\n";
} else {
    echo "✗ StudentController class NOT found\n";
}

// Test 6: Load StudentModel
echo "\nTEST 6: Check StudentModel Class\n";
if (class_exists(StudentModel::class)) {
    echo "✓ StudentModel class found and loaded\n";
} else {
    echo "✗ StudentModel class NOT found\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "All diagnostic tests completed!\n";
echo str_repeat("=", 50) . "\n";

// Test 7: Try to create StudentController
echo "\nTEST 7: Create StudentController Instance\n";
try {
    $_SESSION['auth_user'] = 'admin'; // Mock session for testing
    $controller = new StudentController();
    echo "✓ StudentController instance created successfully\n";
} catch (Exception $e) {
    echo "✗ StudentController instantiation failed:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
}

echo "\nDiagnostics completed.\n";

// Test 8: Test StudentModel methods
echo "\nTEST 8: Test StudentModel Methods\n";
try {
    $_SESSION['auth_user'] = 'admin';
    $model = new StudentModel();
    
    // Test exists
    echo "Testing exists() with ID 1...\n";
    $exists = $model->exists(1);
    echo "✓ exists() returned: " . ($exists ? 'true' : 'false') . "\n";
    
    // Test findById
    echo "Testing findById(1)...\n";
    $student = $model->findById(1);
    echo "✓ findById() returned: " . ($student ? 'array with ' . count($student) . ' fields' : 'null') . "\n";
    
    // Test getGroupByName
    echo "Testing getGroupByName('ІТ-11')...\n";
    $group = $model->getGroupByName('ІТ-11');
    echo "✓ getGroupByName() returned: " . ($group ? 'array with ' . count($group) . ' fields' : 'null') . "\n";
    if ($group) {
        var_dump($group);
    }
} catch (Throwable $e) {
    echo "✗ StudentModel test failed:\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
    echo "   Trace:\n" . $e->getTraceAsString() . "\n";
}
?>