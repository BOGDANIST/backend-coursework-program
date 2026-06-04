<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
    header("Location: admin_panel.php");
    exit;
} else {
    // Завантажуємо середовище MVC
    require_once dirname(__DIR__) . '/bootstrap.php';

    error_reporting(0);
    
    // Отримуємо правильний параметр, який передає async.js (id_sp)
    $id_sp = $_GET["id_sp"] ?? '';
    
    // Використовуємо модель замість прямих запитів до бази
    $specialtyModel = new \App\Modules\Specialties\Models\SpecialtyModel();
    $row = $specialtyModel->findById($id_sp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>єСтудент</title>
    <link rel="icon" type="image/png" href="..\assets\img\logo_brouser2.png">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="favicon.ico" rel="shortcut icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/toast-notifications.css">
</head>
<body>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="logo col-md-12">
                    <a href="index.html" title="">
                      <img style="width: 100%;" src="../assets/img/logo.png" alt="Logo" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="body-bg">
        <?php include ("../include/adm_menu.php"); ?>
        <?php include ("../include/background_icon.php");?>

        <div class="container my-4">
            <h2 class="text-center mb-4">Редагування спеціальності (<?= htmlspecialchars($row['im_spec'] ?? 'Не знайдено') ?>)</h2>
            
            <form method="POST" class="needs-validation signup-page" novalidate id="edit-spec-form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id_sp) ?>">
                
                <div class="mb-3">
                    <label for="id_galuz" class="form-label"><strong>ID Галузі</strong></label>
                    <input type="text" name="id_galuz" class="form-control" id="id_galuz" value="<?= htmlspecialchars($row['id_galuz'] ?? '') ?>" required>
                    <div class="invalid-feedback">Будь ласка, введіть ID Галузі.</div>
                </div>
                <div class="mb-3">
                    <label for="im_galuz" class="form-label"><strong>Назва Галузі</strong></label>
                    <input type="text" name="im_galuz" class="form-control" id="im_galuz" value="<?= htmlspecialchars($row['im_galuz'] ?? '') ?>" required>
                    <div class="invalid-feedback">Будь ласка, введіть назву Галузі.</div>
                </div>
                <div class="mb-3">
                    <label for="id_spec" class="form-label"><strong>Старий ID Спеціальності</strong></label>
                    <input type="text" name="id_spec" class="form-control" id="id_spec" value="<?= htmlspecialchars($row['id_spec'] ?? '') ?>" required>
                    <div class="invalid-feedback">Будь ласка, введіть ID Спеціальності.</div>
                </div>
                <div class="mb-3">
                    <label for="im_spec" class="form-label"><strong>Назва Спеціальності</strong></label>
                    <input type="text" name="im_spec" class="form-control" id="im_spec" value="<?= htmlspecialchars($row['im_spec'] ?? '') ?>" required>
                    <div class="invalid-feedback">Будь ласка, введіть назву Спеціальності.</div>
                </div>
                <div class="mb-3">
                    <label for="im_specializ" class="form-label"><strong>Назва Спеціалізації</strong></label>
                    <input type="text" name="im_specializ" class="form-control" id="im_specializ" value="<?= htmlspecialchars($row['im_specializ'] ?? '') ?>" required>
                    <div class="invalid-feedback">Будь ласка, введіть назву Спеціалізації.</div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" id="submit-form">Зберегти зміни</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include ("../include/footer.php");?>

    <script>
        document.getElementById('edit-spec-form').addEventListener('submit', function (event) {
            // Зупиняємо стандартну поведінку форми (перезавантаження сторінки)
            event.preventDefault();
            
            // Якщо поля не заповнені, показуємо червоні підказки
            if (!this.checkValidity()) {
                event.stopPropagation();
            } else {
                // Якщо все добре, викликаємо наш AsyncRouter
                AsyncRouter.editSpec('<?= htmlspecialchars($id_sp) ?>', this);
            }
            
            this.classList.add('was-validated');
        });
    </script>
    
    <script type="text/javascript" src="assets/js/toast-notifications.js"></script>
    <script type="text/javascript" src="async.js"></script>
</body>
</html>