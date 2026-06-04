<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
    header("Location: admin_panel.php");
    exit;
} else {
    include("../include/db_connect.php");
    error_reporting(0);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додавання спеціальності</title>

        <!-- Bootstrap Core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
		<!-- Toast Notifications CSS -->
		<link rel="stylesheet" href="assets/css/toast-notifications.css">

    <!-- Ваші додаткові стилі -->
    <link rel="stylesheet" href="../css/my_style.css">

</head>
<body>
                <div id="header">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="logo col-md-12">
                            <a href="index.html" title="">
                              <img style="width: 100%;" src="../assets/img/logo.png" alt="Logo" />
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>

    <!-- Можна підключити верхнє меню або шапку -->
    <?php include("../include/adm_menu.php"); ?>
<?php include ("../include/background_icon.php");?>
    <div class="container my-4">
        <h2 class="text-center mb-4">Додавання спеціальності</h2>

        <form id="add-spec-form" class="needs-validation signup-page" novalidate>


            <div class="mb-3">
                <label for="id_galuz" class="form-label"><strong>ID Галузі</strong></label>
                <input type="text" name="id_galuz" id="id_galuz" class="form-control" required>
                <div class="invalid-feedback">
                    Будь ласка, введіть ID Галузі.
                </div>
            </div>
            <div class="mb-3">
                <label for="im_galuz" class="form-label"><strong>Назва Галузі</strong></label>
                <input type="text" name="im_galuz" id="im_galuz" class="form-control" required>
                <div class="invalid-feedback">
                    Будь ласка, введіть назву Галузі.
                </div>
            </div>
            <div class="mb-3">
                <label for="id_spec" class="form-label"><strong>ID Спеціальності</strong></label>
                <input type="text" name="id_spec" id="id_spec" class="form-control" required>
                <div class="invalid-feedback">
                    Будь ласка, введіть ID Спеціальності.
                </div>
            </div>
            <div class="mb-3">
                <label for="im_spec" class="form-label"><strong>Назва Спеціальності</strong></label>
                <input type="text" name="im_spec" id="im_spec" class="form-control" required>
                <div class="invalid-feedback">
                    Будь ласка, введіть назву Спеціальності.
                </div>
            </div>
            <div class="mb-3">
                <label for="im_specializ" class="form-label"><strong>Назва Спеціалізації</strong></label>
                <input type="text" name="im_specializ" id="im_specializ" class="form-control" required>
                <div class="invalid-feedback">
                    Будь ласка, введіть назву Спеціалізації.
                </div>
            </div>
            <div class="d-grid">
                <button type="button" id="submit-form" onclick="AsyncRouter.addSpec(this.form.closest('form')); return false;" class="btn btn-success">
                    Додати спеціальність
                </button>
            </div>
        </form>
    </div>

    <!-- Toast Notifications Container -->
    <div id="toast-container"></div>

        <!-- Footer -->
 	<?php include ("../include/footer.php");?>

    <!-- Toast Notifications -->
    <script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
    <!-- Async Router -->
    <script type="text/javascript" src="async.js" type="text/javascript"></script>

    <!-- JavaScript для валідації форми (Bootstrap) -->
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>

