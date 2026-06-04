<?php
declare(strict_types=1);

namespace App\Config;

/**
 * Database configuration
 */
class DatabaseConfig
{
    public const HOST = 'localhost';
    public const USER = 'root';
    public const PASSWORD = '';
    public const DATABASE = 'college';
    public const CHARSET = 'utf8mb4';

    public const DEBUG = true;
}

/**
 * Application configuration
 */
class AppConfig
{
    public const APP_NAME = 'College Management System';
    public const APP_VERSION = '2.0.0';
    public const TIMEZONE = 'Europe/Kyiv';

    // Authorized roles
    public const ADMIN_ROLES = ['admin', 'editor'];
    public const USER_ROLES = ['admin', 'editor', 'user'];
}
