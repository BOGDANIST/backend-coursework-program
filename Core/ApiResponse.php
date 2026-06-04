<?php
declare(strict_types=1);

namespace App\Core;

/**
 * API Response class - handles all JSON responses with proper HTTP status codes
 * PHP 8 implementation with strict types and constructor promotion
 */
class ApiResponse
{
    private int $statusCode = 200;
    private array $errors = [];

    public function __construct(
        private bool $success = true,
        private string $message = '',
        private array|object|null $data = null
    ) {}

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    public function setSuccess(bool $success): self
    {
        $this->success = $success;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array|object|null $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function addError(string $field, string $message): self
    {
        $this->errors[$field] = $message;
        return $this;
    }

    /**
     * Send JSON response with proper HTTP status code
     * Uses output buffering to ensure clean headers
     */
    public function send(): never
    {
        http_response_code($this->statusCode);
        header('Content-Type: application/json; charset=utf-8');

        $response = [
            'success' => $this->success,
            'message' => $this->message,
            'status_code' => $this->statusCode
        ];

        if ($this->data !== null) {
            $response['data'] = $this->data;
        }

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function toArray(): array
    {
        $response = [
            'success' => $this->success,
            'message' => $this->message,
            'status_code' => $this->statusCode
        ];

        if ($this->data !== null) {
            $response['data'] = $this->data;
        }

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        return $response;
    }
}
