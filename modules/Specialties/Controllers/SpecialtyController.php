<?php
declare(strict_types=1);

namespace App\Modules\Specialties\Controllers;

use App\Core\Controller;
use App\Modules\Specialties\Models\SpecialtyModel;
use Exception;

/**
 * SpecialtyController - handles specialties management
 * PHP 8 implementation with proper MVC pattern and API responses
 */
class SpecialtyController extends Controller
{
    private SpecialtyModel $specialtyModel;

    public function __construct()
    {
        parent::__construct();
        $this->specialtyModel = new SpecialtyModel();
    }

    /**
     * Edit specialty action - handles POST requests
     */
    public function actionEdit(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            $id = (string)($_POST['id'] ?? '');

            if (empty($id)) {
                $this->error('ID спеціальності не вказано', 400);
            }

            if (empty($_POST['im_spec'] ?? '')) {
                $this->error('Назва спеціальності обов\'язкова', 400, ['im_spec' => 'Обов\'язкове поле']);
            }

            $data = [
                'id_galuz' => (string)($_POST['id_galuz'] ?? ''),
                'im_galuz' => (string)($_POST['im_galuz'] ?? ''),
                'id_spec' => (string)($_POST['id_spec'] ?? ''),
                'im_spec' => (string)($_POST['im_spec'] ?? ''),
                'im_specializ' => (string)($_POST['im_specializ'] ?? ''),
            ];

            if (!$this->specialtyModel->update($id, $data)) {
                $this->error('Не вдалося оновити спеціальність', 500);
            }

            $updatedSpec = $this->specialtyModel->findById($id);

            if (!$updatedSpec) {
                $this->error('Помилка при отриманні оновлених даних', 500);
            }

            $this->success('Спеціальність успішно оновлено', $updatedSpec);

        } catch (Exception $e) {
            $this->error('Помилка обробки запиту: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Create specialty action
     */
    public function actionCreate(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            if (empty($_POST['im_spec'] ?? '')) {
                $this->error('Назва спеціальності обов\'язкова', 400, ['im_spec' => 'Обов\'язкове поле']);
            }

            $data = [
                'id_sp' => (string)($_POST['id_sp'] ?? ''),
                'id_galuz' => (string)($_POST['id_galuz'] ?? ''),
                'im_galuz' => (string)($_POST['im_galuz'] ?? ''),
                'id_spec' => (string)($_POST['id_spec'] ?? ''),
                'im_spec' => (string)($_POST['im_spec'] ?? ''),
                'im_specializ' => (string)($_POST['im_specializ'] ?? ''),
            ];

            if (!$this->specialtyModel->create($data)) {
                $this->error('Не вдалося створити спеціальність', 500);
            }

            $this->success('Спеціальність успішно додано', $data, 201);

        } catch (Exception $e) {
            $this->error('Помилка обробки запиту: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete specialty action
     */
    public function actionDelete(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            $id = (string)($_POST['id'] ?? '');

            if (empty($id)) {
                $this->error('ID спеціальності не вказано', 400);
            }

            // Перевіримо, чи існує вона
            $spec = $this->specialtyModel->findById($id);
            if (!$spec) {
                $this->notFound('Спеціальність не знайдена');
            }

            if (!$this->specialtyModel->delete($id)) {
                $this->error('Помилка при видаленні спеціальності', 500);
            }

            $this->success('Спеціальність успішно видалено', ['id_sp' => $id]);

        } catch (Exception $e) {
            $this->error('Помилка обробки запиту: ' . $e->getMessage(), 500);
        }
    }

    /**
     * List all specialties action
     */
    public function actionList(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin', 'editor', 'viewer']);

        try {
            $specs = $this->specialtyModel->getAll();
            $this->success('Список спеціальностей отримано', $specs);
        } catch (Exception $e) {
            $this->error('Помилка обробки запиту: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get single specialty by ID action
     */
    public function actionGet(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin', 'editor', 'viewer']);

        try {
            $id = (string)($_GET['id'] ?? '');
            if (empty($id)) {
                $this->error('ID спеціальності не вказано', 400);
            }
            $spec = $this->specialtyModel->findById($id);
            if (!$spec) {
                $this->notFound('Спеціальність не знайдена');
            }
            $this->success('Спеціальність отримано', $spec);
        } catch (Exception $e) {
            $this->error('Помилка обробки запиту: ' . $e->getMessage(), 500);
        }
    }
}