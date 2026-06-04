<?php
declare(strict_types=1);

namespace App\Core;

use Throwable;

/**
 * Base Controller with output buffering and authentication
 * Handles HTTP status codes and response buffering
 */
abstract class Controller
{
    protected ?string $user = null;
    protected ApiResponse $response;

    public function __construct()
    {
        $this->response = new ApiResponse();
        $this->checkAuthentication();
    }

    /**
     * Start output buffering for this request
     */
    protected function startBuffer(): void
    {
        if (ob_get_level() === 0) {
            ob_start();
        }
    }

    /**
     * Get buffered output and clean buffer
     */
    protected function getBufferedOutput(): string
    {
        return ob_get_clean() ?: '';
    }

    /**
     * Check user authentication and authorization
     * Override in child classes for specific authorization
     */
    protected function checkAuthentication(): void
    {
        // Ensure session is active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Try to get user from session
        $this->user = $_SESSION['auth_user'] ?? null;

        // If no user, return 401
        if (!$this->user) {
            $this->response
                ->setSuccess(false)
                ->setStatusCode(401)
                ->setMessage('Необхідна аутентифікація')
                ->send();
        }
    }

    /**
     * Check if user has required role
     */
    protected function checkAuthorization(array $allowedRoles): void
    {
        if (!in_array($this->user, $allowedRoles, true)) {
            $this->response
                ->setSuccess(false)
                ->setStatusCode(403)
                ->setMessage('Доступ заборонено')
                ->send();
        }
    }

    /**
     * Validate HTTP method
     */
    protected function validateMethod(string $required): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== $required) {
            $this->response
                ->setSuccess(false)
                ->setStatusCode(405)
                ->setMessage("Метод {$_SERVER['REQUEST_METHOD']} не підтримується")
                ->send();
        }
    }

    /**
     * Handle controller execution with error handling and buffering
     */
    public function execute(string $action): void
    {
        $this->startBuffer();

        try {
            $method = 'action' . ucfirst($action);

            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException(
                    "Дія '{$action}' не існує в контролері " . static::class
                );
            }

            $this->$method();

        } catch (Throwable $e) {
            http_response_code(500);
            $this->response
                ->setSuccess(false)
                ->setStatusCode(500)
                ->setMessage('Внутрішня помилка сервера: ' . $e->getMessage())
                ->send();
        }
    }

    /**
     * Send success response
     */
    protected function success(string $message = '', array|object|null $data = null): never
    {
        $this->response
            ->setSuccess(true)
            ->setStatusCode(200)
            ->setMessage($message)
            ->setData($data)
            ->send();
    }

    /**
     * Send error response with custom status code
     */
    protected function error(
        string $message = 'Помилка',
        int $statusCode = 400,
        array $errors = []
    ): never {
        $this->response
            ->setSuccess(false)
            ->setStatusCode($statusCode)
            ->setMessage($message)
            ->setErrors($errors)
            ->send();
    }

    /**
     * Send not found response
     */
    protected function notFound(string $message = 'Ресурс не знайдено'): never
    {
        $this->error($message, 404);
    }

    /**
     * Send forbidden response
     */
    protected function forbidden(string $message = 'Доступ заборонено'): never
    {
        $this->error($message, 403);
    }

    /**
     * Send created response
     */
    protected function created(string $message = '', array|object|null $data = null): never
    {
        $this->response
            ->setSuccess(true)
            ->setStatusCode(201)
            ->setMessage($message)
            ->setData($data)
            ->send();
    }
}
