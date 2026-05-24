<?php

class ApiResponse {
    private $success;
    private $message;
    private $data;
    private $total;
    private $page;
    private $limit;
    private $totalPages;
    private $errors;

    public function __construct($success = true, $message = '') {
        $this->success = $success;
        $this->message = $message;
        $this->data = null;
        $this->total = 0;
        $this->page = 1;
        $this->limit = 50;
        $this->totalPages = 0;
        $this->errors = [];
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setPagination($total, $page, $limit) {
        $this->total = $total;
        $this->page = $page;
        $this->limit = $limit;
        $this->totalPages = ceil($total / $limit);
        return $this;
    }

    public function setErrors($errors) {
        $this->errors = $errors;
        return $this;
    }

    public function addError($field, $message) {
        $this->errors[$field] = $message;
        return $this;
    }

    public function send() {
        header('Content-Type: application/json; charset=utf-8');

        $response = [
            'success' => $this->success,
            'message' => $this->message
        ];

        if ($this->data !== null) {
            $response['data'] = $this->data;
        }

        if ($this->total > 0) {
            $response['total'] = $this->total;
            $response['page'] = $this->page;
            $response['limit'] = $this->limit;
            $response['totalPages'] = $this->totalPages;
        }

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>
