<?php
declare(strict_types=1);

namespace App\Modules\Users\Controllers;

use App\Core\Controller;
use App\Modules\Users\Models\UserModel;
use Exception;

/**
 * UserController - handles user management
 * PHP 8 implementation with proper MVC pattern and buffering
 * Only admins can manage users
 */
class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }


    /**
     * Edit user action - handles POST requests
     * Can update password and/or status (role)
     */
    public function actionEdit(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin']);

        try {
            // Validate required user_id
            if (empty($_POST['user_id'] ?? null)) {
                $this->error('ID користувача не вказано', 400, ['user_id' => 'Поле обов\'язкове']);
            }

            $userId = (int) $_POST['user_id'];

            // Check if user exists
            if (!$this->userModel->exists($userId)) {
                $this->notFound('Користувач не знайдено');
            }

            // Check if password change is requested
            $isPasswordChange = !empty($_POST['new_password1'] ?? null);
            $validationErrors = [];

            // Validate password if changing
            if ($isPasswordChange) {
                $validationErrors = $this->validatePasswordChange(
                    $_POST['new_password1'] ?? '',
                    $_POST['new_password2'] ?? ''
                );
            }

            if (!empty($validationErrors)) {
                $this->error('Помилки валідації', 400, $validationErrors);
            }

            // Get role/status from POST (default: 'user')
            $role = $_POST['status'] ?? 'user';

            try {
                $status = UserModel::roleToStatus($role);
            } catch (Exception $e) {
                $this->error(
                    'Невідома роль користувача',
                    400,
                    ['status' => $e->getMessage()]
                );
            }

            // Perform update
            if ($isPasswordChange) {
                $passwordHash = UserModel::hashPassword($_POST['new_password1']);
                $success = $this->userModel->updateWithPassword($userId, $passwordHash, $status);
                $message = 'Пароль та роль користувача успішно оновлено';
            } else {
                $success = $this->userModel->updateStatus($userId, $status);
                $message = 'Роль користувача успішно оновлено';
            }

      // Сувора перевірка: реагуємо ТІЛЬКИ якщо база повернула помилку (false), 
            // // а не "0 змінених рядків"
            if ($success === false) {
                $this->error('Не вдалося оновити користувача', 500);
            }

            // // Get updated user data
            $updatedUser = $this->userModel->findById($userId);

            if (!$updatedUser) {
                $this->error('Помилка при отриманні оновлених даних', 500);
            }

            // ;
            // Convert status back to role name for response
            // $updatedUser['role'] = UserModel::statusToRole($updatedUser['status']);

            $this->success($message);

        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get user action - handles GET requests
     */
    public function actionGet(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin']);

        try {
            if (empty($_GET['id'] ?? null)) {
                $this->error('ID користувача не вказано', 400);
            }

            $userId = (int) $_GET['id'];
            $user = $this->userModel->findById($userId);

            if (!$user) {
                $this->notFound('Користувач не знайдено');
            }

            // Convert status to role name
            $user['role'] = UserModel::statusToRole($user['status']);

            $this->success('Дані користувача отримані', $user);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні користувача: ' . $e->getMessage(), 500);
        }
    }

    /**
     * List all users action
     */
    public function actionList(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin']);

        try {
            $users = $this->userModel->getAll();

            // Convert status to role names for all users
            foreach ($users as &$user) {
                $user['role'] = UserModel::statusToRole($user['status']);
            }

            $this->success('Список користувачів отримано', $users);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні списку користувачів: ' . $e->getMessage(), 500);
        }
    }

    public function actionCreate(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin']);

        try {
            $requiredFields = ['login', 'password1', 'password2', 'status'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field] ?? null)) {
                    $this->error("Поле '{$field}' обов'язкове", 400, [$field => 'Поле обов\'язкове']);
                }
            }

            if ($_POST['password1'] !== $_POST['password2']) {
                $this->error('Паролі не збігаються', 400, ['password2' => 'Паролі не збігаються']);
            }

             $login = $_POST['login'] ?? '';

            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['status'] ?? 'user';

            if ($this->userModel->findByLogin($login)) {
                $this->error('Користувач з таким логіном вже існує', 400, ['login' => 'Логін уже занят']);
            }

            try {
                $status = UserModel::roleToStatus($role);
            } catch (Exception $e) {
                $this->error(
                    'Невідома роль користувача',
                    400,
                    ['status' => $e->getMessage()]
                );
            }

            $passwordHash = UserModel::hashPassword($password);
            $newUserId = $this->userModel->create($login, $passwordHash, $status);

            if (!$newUserId) {
                $this->error('Не вдалося створити користувача', 500);
            }

            // Get created user data
            $newUser = $this->userModel->findById((int) $newUserId);

            if (!$newUser) {
                $this->error('Помилка при отриманні даних нового користувача', 500);
            }

            // Convert status to role name for response
            // $newUser['role'] = UserModel::statusToRole($newUser['status']);

            $this->success('Користувача успішно створено', $newUser);
        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Validate password change input
     * Returns array of errors, or empty array if valid
     */
    private function validatePasswordChange(string $password1, string $password2): array
    {
        $errors = [];

        if (empty($password1)) {
            $errors['new_password1'] = 'Пароль обов\'язковий';
        }

        if (empty($password2)) {
            $errors['new_password2'] = 'Підтвердження пароля обов\'язкове';
        }

        if (!empty($password1) && !empty($password2) && $password1 !== $password2) {
            $errors['new_password2'] = 'Паролі не збігаються';
        }

        if (!empty($password1) && strlen($password1) < 6) {
            $errors['new_password1'] = 'Пароль має бути мінімум 6 символів';
        }

        return $errors;
    }


}
