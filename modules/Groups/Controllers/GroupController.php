<?php
declare(strict_types=1);

namespace App\Modules\Groups\Controllers;

use App\Core\Controller;
use App\Modules\Groups\Models\GroupModel;
use Exception;

/**
 * GroupController - handles group management
 * PHP 8 implementation with proper MVC pattern and buffering
 */
class GroupController extends Controller
{
    private GroupModel $groupModel;

    public function __construct()
    {
        parent::__construct();
        $this->groupModel = new GroupModel();
    }

    /**
     * Check authorization for group operations
     */
    // protected function checkAuthorization(): void
    // {
    //     parent::checkAuthorization(['admin', 'editor']);
    // }

    /**
     * Edit group action - handles POST requests
     */
    public function actionEdit(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            // Validate required fields
            if (empty($_POST['id'] ?? null)) {
                $this->error('ID групи не вказано', 400, ['id' => 'Поле обов\'язкове']);
            }

            if (empty($_POST['form_im_group'] ?? null)) {
                $this->error('Назва групи обов\'язкова', 400, ['form_im_group' => 'Поле обов\'язкове']);
            }

            $oldGroupName = $_POST['id'];

            // Check if old group exists
            $oldGroup = $this->groupModel->findByName($oldGroupName);
            if (!$oldGroup) {
                $this->notFound('Група не знайдена');
            }

            // Build group data array
            $groupData = [
                'g_im' => $_POST['form_im_group'] ?? '',
                'g_galuz' => $_POST['g_gz'] ?? $_POST['form_gz'] ?? '',
                'g_spec' => $_POST['g_sp'] ?? $_POST['form_sp'] ?? '',
                'g_specz' => $_POST['g_sz'] ?? $_POST['form_sz'] ?? '',
                'g_course' => (int) ($_POST['g_kurs'] ?? $_POST['form_cours'] ?? 1),
                'g_vipusc' => $_POST['g_vp'] ?? $_POST['form_vp'] ?? '',
                'g_count_stud' => (int) ($_POST['g_count_stud'] ?? $_POST['form_ks'] ?? 0),
                'g_count_derg' => (int) ($_POST['g_count_rz'] ?? $_POST['form_ksd'] ?? 0),
                'g_count_comerc' => (int) ($_POST['g_count_contr'] ?? $_POST['form_ksk'] ?? 0),
                'g_nastav' => $_POST['g_nast'] ?? $_POST['form_nast'] ?? '',
                'g_formnavch' => $_POST['g_fn'] ?? $_POST['form_fn'] ?? ''
            ];

            // Update group
            if (!$this->groupModel->update($oldGroupName, $groupData)) {
                $this->error('Не удалось обновить группу', 500);
            }

            // Update all students of this group
            $this->groupModel->updateStudents($oldGroupName, $groupData);

            // Get updated group data
            $updatedGroup = $this->groupModel->findByName($groupData['g_im']);

            if (!$updatedGroup) {
                $this->error('Помилка при отриманні оновлених даних', 500);
            }

            $this->success(
                'Групу та всіх прив\'язаних студентів успішно оновлено',
                $updatedGroup
            );

        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get group action - handles GET requests
     */
    public function actionGet(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            if (empty($_GET['id'] ?? null)) {
                $this->error('ID групи не вказано', 400);
            }

            $group = $this->groupModel->findByName($_GET['id']);

            if (!$group) {
                $this->notFound('Група не знайдена');
            }

            $this->success('Дані групи отримані', $group);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні групи: ' . $e->getMessage(), 500);
        }
    }

    /**
     * List all groups action
     */
    public function actionList(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            $groups = $this->groupModel->getAll();
            $this->success('Список груп отримано', $groups);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні списку груп: ' . $e->getMessage(), 500);
        }
    }


    public function actionCreate(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            $requiredFields = ['form_im_group', 'g_gz', 'g_sp', 'g_sz', 'g_kurs', 'g_count_stud', 'g_fn'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || trim((string) $_POST[$field]) === '') {
                    $this->error("Поле '{$field}' обов'язкове", 400, [$field => 'Поле обов\'язкове']);
                }
            }
            if ($this->groupModel->findByName($_POST['form_im_group'])) {
                $this->error('Група з такою назвою вже існує', 400, ['form_im_group' => 'Група вже існує']);
            }
            // if(!empty($validationErrors = $this->groupModel->validateGroupData($_POST))) {
            //     $this->error('Помилка валідації даних', 400, $validationErrors);
            // }
            $groupData = [
                'g_im' => $_POST['form_im_group'],
                'g_galuz' => $_POST['g_gz'],
                'g_spec' => $_POST['g_sp'],
                'g_specz' => $_POST['g_sz'],
                'g_course' => (int) $_POST['g_kurs'],
                'g_vipusc' => $_POST['g_vp'] ?? 'Ні',
                'g_count_stud' => (int) ($_POST['g_count_stud'] ?? 0),
                'g_count_derg' => (int) ($_POST['g_count_rz'] ?? 0),
                'g_count_comerc' => (int) ($_POST['g_count_contr'] ?? 0),
                'g_nastav' => $_POST['g_nast'] ?? '',
                'g_formnavch' => $_POST['g_fn'] ?? 'Денна'
            ];
            if (!$this->groupModel->create($groupData)) {
                $this->error('Не вийшло створити группу', 500);
            }
            $newGroup = $this->groupModel->findByName($groupData['g_im']);
            if (!$newGroup) {
                $this->error('Помилка при отриманні даних нової групи', 500);
            }
            $this->success('Групу успішно створено', $newGroup);

        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }
}