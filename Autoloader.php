<?php
declare(strict_types=1);

/**
 * PSR-4 Autoloader for the application
 * Automatically loads classes from App namespace
 */
class Autoloader
{
    private string $prefix = 'App\\';
    private string $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = rtrim($baseDir, '/\\') . DIRECTORY_SEPARATOR;
    }

    public function register(): void
    {
        spl_autoload_register([$this, 'load']);
    }

    public function load(string $class): void
    {
        if (strpos($class, $this->prefix) !== 0) {
            return;
        }

        $relative = substr($class, strlen($this->prefix));
        $file = $this->baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
}
