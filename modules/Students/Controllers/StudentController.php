<?php
declare(strict_types=1);

namespace App\Modules\Students\Controllers;

use App\Core\Controller;
use App\Modules\Students\Models\StudentModel;
use Exception;

/**
 * StudentController - handles student management
 * PHP 8 implementation with proper MVC pattern and buffering
 */
class StudentController extends Controller
{
    private StudentModel $studentModel;

    public function __construct()
    {
        parent::__construct();
        $this->studentModel = new StudentModel();
    }

    /**
     * Edit student action - handles POST requests
     * Filter students action
     */
public function actionEdit(): void
    {
        $this->validateMethod('POST');
        // Викликаємо метод батьківського класу і передаємо ролі напряму
        $this->checkAuthorization(['admin', 'editor']);

        try {
            // Validate required fields
            if (empty($_POST['id'] ?? null)) {
                $this->error('ID студента не вказано', 400, ['id' => 'Поле обов\'язкове']);
            }

            $studentId = (int) $_POST['id'];

            // Check if student exists
            if (!$this->studentModel->exists($studentId)) {
                $this->notFound('Студент не знайдено');
            }

            // Validate required fields
            $requiredFields = ['form_group', 'form_pr_stud', 'form_im_stud', 'form_bat_stud'];
            $validationErrors = $this->validateRequired($requiredFields);

            if (!empty($validationErrors)) {
                $this->error('Помилки валідації', 400, $validationErrors);
            }

            // Get group data to populate related fields
            $groupName = $_POST['form_group'] ?? '';
            $groupData = $this->studentModel->getGroupByName($groupName);

            if (!$groupData) {
                $this->error('Група не знайдена', 400, ['form_group' => 'Такої групи не існує']);
            }

            // Calculate age from birth date
            $age = null;
            if (!empty($_POST['form_date_nar'])) {
                $age = StudentModel::calculateAge($_POST['form_date_nar']);
            }

            // Build student data array from POST
            $studentData = $this->buildStudentData(
                $_POST,
                $groupData,
                $age
            );

            // Update student in database
            if (!$this->studentModel->update($studentId, $studentData)) {
                $this->error('Не удалось обновить студента', 500);
            }

            // Get updated student data
    //$updatedStudent = $this->studentModel->findById($studentId);

            // if (!$updatedStudent) {
            //     $this->error('Помилка при отриманні оновлених даних', 500);
            // }

            $this->success(
                'Студента успішно оновлено',
           
            );

        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }


     public function actionFilter(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor', 'viewer']);

        try {
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $limitParam = $_GET['limit'] ?? 50;
            $limit = ($limitParam === 'all') ? 'all' : (int)$limitParam;
            
            $offset = 0;
            if ($limit !== 'all') {
                $offset = ($page - 1) * $limit;
            }

            $filters = $_POST;
            $total = 0;

            $students = $this->studentModel->filter($filters, $limit, $offset, $total);

            $data = [
                'items' => $students,
                'pagination' => [
                    'total' => $total,
                    'page' => $page,
                    'limit' => $limit,
                    'totalPages' => ($limit === 'all' || $limit == 0) ? 1 : ceil($total / $limit)
                ]
            ];

            $this->success("Знайдено $total студентів", $data);

        } catch (Exception $e) {
            $this->error('Помилка фільтрації: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get student action - handles GET requests
     */
    public function actionGet(): void
    {
        $this->validateMethod('GET');
        // Додаємо 'viewer' для отримання даних (читання)
        $this->checkAuthorization(['admin', 'editor', 'viewer']);

        try {
            $studentId = (int)($_GET['id'] ?? 0); // Default to 0 if not set, then check if it's valid

            if ($studentId <= 0) { // Check for valid ID
                $this->error('ID студента не вказано або недійсне', 400);
            }

            $student = $this->studentModel->findById($studentId);

            if (!$student) {
                $this->notFound('Студент не знайдено');
            }

            $this->success('Дані студента отримані', $student);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні студента: ' . $e->getMessage(), 500);
        }
    }
          

    /**
     * List students by group action
     */
    public function actionList(): void
    {
        $this->validateMethod('GET');
        $this->checkAuthorization(['admin', 'editor', 'viewer']);

        try {
            if (empty($_GET['group'] ?? null)) {
                $this->error('Назва групи не вказана', 400);
            }

            $groupName = $_GET['group'] ?? '';
            $students = $this->studentModel->getByGroup($groupName);

            $this->success('Список студентів отримано', $students);

        } catch (Exception $e) {
            $this->error('Помилка при отриманні списку студентів: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Create student action - handles POST requests
     */
    public function actionCreate(): void
    {
        $this->validateMethod('POST');
        $this->checkAuthorization(['admin', 'editor']);

        try {
            // Validate required fields
            $requiredFields = ['form_group', 'form_pr_stud', 'form_im_stud', 'form_bat_stud'];
            $validationErrors = $this->validateRequired($requiredFields);

            if (!empty($validationErrors)) {
                $this->error('Помилки валідації', 400, $validationErrors);
            }

            // Get group data to populate related fields
            $groupName = $_POST['form_group'] ?? '';
            $groupData = $this->studentModel->getGroupByName($groupName);

            if (!$groupData) {
                $this->error('Група не знайдена', 400, ['form_group' => 'Такої групи не існує']);
            }

            // Calculate age from birth date
            $age = null;
            if (!empty($_POST['form_date_nar'])) {
                $age = StudentModel::calculateAge($_POST['form_date_nar']);
            }

            // Build student data array from POST
            $studentData = $this->buildStudentData(
                $_POST,
                $groupData,
                $age
            );

            // Create student in database
            $studentId = $this->studentModel->create($studentData);

            if (!$studentId) {
                $this->error('Не удалось создать студента', 500);
            }

            // Get created student data
            $createdStudent = $this->studentModel->findById($studentId);

            if (!$createdStudent) {
                $this->error('Помилка при отриманні даних створеного студента', 500);
            }

            $this->created(
                'Студента успішно додано',
                $createdStudent
            );

        } catch (Exception $e) {
            $this->error(
                'Помилка обробки запиту: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Validate required fields from POST
     */
    private function validateRequired(array $fields): array
    {
        $errors = [];

        foreach ($fields as $field) {
            if (empty($_POST[$field] ?? '')) {
                $errors[$field] = 'Це поле обов\'язкове';
            }
        }

        return $errors;
    }

    /**
     * Build student data array from POST data and group info
     */
    private function buildStudentData(array $post, array $groupData, ?int $age): array
    {
        return [
            's_group' => $post['form_group'] ?? '',
            's_pr' => $post['form_pr_stud'] ?? '',
            's_im' => $post['form_im_stud'] ?? '',
            's_bat' => $post['form_bat_stud'] ?? '',
            's_stat' => $post['form_sex'] ?? '',
            's_contract' => $post['form_zamovl'] ?? $post['form_zamovl_stud'] ?? '',
            's_dnar' => $post['form_date_nar'] ?? '',
            's_vik' => $age ?? 0,
            's_adresa' => $post['form_adres'] ?? '',
            's_tels' => $post['form_tel_st'] ?? '',
            's_telb' => $post['form_tel_bat'] ?? '',
            's_telm' => $post['form_tel_mut'] ?? '',
            's_osvita_type' => $post['form_osvita'] ?? $post['form_osvita_stud'] ?? '',
            's_rik_zaver' => $post['form_zscool'] ?? '',
            's_region_type' => $post['form_reg_type'] ?? $post['form_reg_type_stud'] ?? '',
            's_region' => $post['form_region'] ?? $post['form_region_stud'] ?? '',
            's_galuz' => $groupData['g_galuz'] ?? '',
            's_spec' => $groupData['g_spec'] ?? '',
            's_specz' => $groupData['g_specz'] ?? '',
            's_sirota' => StudentModel::boolToYesNo(!empty($post['form_sirot'])),
            's_peresel' => StudentModel::boolToYesNo(!empty($post['form_peres'])),
            's_inval' => $post['form_ivalid'] ?? $post['s_inval'] ?? 'Ні',
            's_malozab' => StudentModel::boolToYesNo(!empty($post['form_malozab'])),
            's_war_act' => StudentModel::boolToYesNo(!empty($post['form_uchbd'])),
            's_chernob' => StudentModel::boolToYesNo(!empty($post['form_chernob'])),
            's_ato' => StudentModel::boolToYesNo(!empty($post['form_ato'])),
            's_ditzag' => StudentModel::boolToYesNo(!empty($post['form_ditzag'])),
            's_rada' => StudentModel::boolToYesNo(!empty($post['form_rada'])),
            's_shahter' => StudentModel::boolToYesNo(!empty($post['form_shahter'])),
            's_vip' => StudentModel::boolToYesNo(!empty($post['form_vip'])),
            's_cours' => (int) ($groupData['g_course'] ?? 1),
            's_form_navch' => $groupData['g_formnavch'] ?? '',
        ];
    }
}