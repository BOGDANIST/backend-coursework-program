<?php
declare(strict_types=1);

namespace App\Core;

use Exception;
use ReflectionClass;

/**
 * Router - routes API requests to appropriate controllers
 * Handles output buffering and proper HTTP status codes
 */
class Router
{
    private array $routes = [];
    private string $basePath = '';

    public function __construct(string $basePath = '')
    {
        $this->basePath = $basePath;
        $this->registerDefaultRoutes();
    }

    /**
     * Register a route
     * Pattern: /module/controller/action
     */
    public function register(
        string $method,
        string $pattern,
        string $controller,
        string $action
    ): self {
        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action
        ];
        return $this;
    }

    /**
     * Register default REST routes
     */
    private function registerDefaultRoutes(): void
    {
        // Module based routes
        $this->register('POST', '/api/:module/:controller/edit', ':module\\:controller', 'edit');
        $this->register('GET', '/api/:module/:controller/get', ':module\\:controller', 'get');
        $this->register('GET', '/api/:module/:controller/list', ':module\\:controller', 'list');
        $this->register('POST', '/api/:module/:controller/create', ':module\\:controller', 'create');
        $this->register('POST', '/api/:module/:controller/delete', ':module\\:controller', 'delete');
    }

    /**
     * Route the request and handle output buffering
     */
    public function dispatch(): void
    {
        ob_start();

        try {
            $path = $this->getRequestPath();
            $method = $_SERVER['REQUEST_METHOD'];

            $route = $this->matchRoute($path, $method);

            if (!$route) {
                http_response_code(404);
                $response = new ApiResponse(
                    false,
                    'Маршрут не знайдено',
                    null
                );
                $response->setStatusCode(404)->send();
            }

            // Clean buffer before calling controller
            ob_end_clean();
            ob_start();

            $this->executeRoute($route);

        } catch (Exception $e) {
            ob_end_clean();

            http_response_code(500);
            $response = new ApiResponse(
                false,
                'Внутрішня помилка сервера: ' . $e->getMessage(),
                null
            );
            $response->setStatusCode(500)->send();
        }
    }

    /**
     * Get the request path
     */
    private function getRequestPath(): string
    {
        $path = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'] ?? '/';

        if ($this->basePath && str_starts_with($path, $this->basePath)) {
            $path = substr($path, strlen($this->basePath));
        }

        return parse_url($path, PHP_URL_PATH) ?: '/';
    }

    /**
     * Match route to request path
     */
    private function matchRoute(string $path, string $method): ?array
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if ($this->patternMatches($route['pattern'], $path, $matches)) {
                return array_merge($route, ['params' => $matches]);
            }
        }

        return null;
    }

    /**
     * Check if path matches pattern
     */
    private function patternMatches(string $pattern, string $path, array &$matches = []): bool
    {
        $regex = $this->patternToRegex($pattern);
        return (bool) preg_match($regex, $path, $matches);
    }

    /**
     * Convert pattern to regex
     * /api/:module/:controller/action -> /^\/api\/(?P<module>[^/]+)\/(?P<controller>[^/]+)\/action$/
     */
    private function patternToRegex(string $pattern): string
    {
        $pattern = preg_quote($pattern, '/');
        $pattern = preg_replace('/\\\\:([a-z_]+)/i', '(?P<$1>[^/]+)', $pattern);
        return "/^{$pattern}$/i";
    }

    /**
     * Execute the matched route
     */
    private function executeRoute(array $route): void
    {
        $controllerName = $this->resolveControllerName($route['controller'], $route['params']);
        $action = $route['action'];

        $controller = new $controllerName();
        $controller->execute($action);
    }

    /**
     * Resolve controller class name
     */
    private function resolveControllerName(string $controllerPattern, array $params): string
    {
        $moduleName = $params['module'] ?? '';
        $controllerShort = $params['controller'] ?? '';

        $controllerPattern = str_replace(':module', ucfirst($moduleName), $controllerPattern);
        $controllerPattern = str_replace(':controller', ucfirst($controllerShort), $controllerPattern);

        return "App\\Modules\\{$controllerPattern}\\Controller";
    }
}
