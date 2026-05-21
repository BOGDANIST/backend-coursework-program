<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {   
    header("Location: admin_panel.php");
    exit;
} else {
    include ("../include/db_connect.php");
    error_reporting(0);
    
    // Отримуємо ID спеціальності для редагування з GET-параметра
    $id_spec = $_GET["id_sp_edit"];
    
    // Якщо форма була відправлена, виконуємо оновлення запису
    if (isset($_POST["submit_save"])) { 
        // Екрануємо значення для безпеки
        $id_galuz    = mysqli_real_escape_string($linc, $_POST["id_galuz"]);
        $im_galuz    = mysqli_real_escape_string($linc, $_POST["im_galuz"]);
        $id_spec     = mysqli_real_escape_string($linc, $_POST["id_spec"]);
        $im_spec     = mysqli_real_escape_string($linc, $_POST["im_spec"]);
        $im_specializ = mysqli_real_escape_string($linc, $_POST["im_specializ"]);
        
        $update_query = "UPDATE spec 
                         SET id_galuz    = '$id_galuz',
                             im_galuz    = '$im_galuz',
                             id_spec     = '$id_spec',
                             im_spec     = '$im_spec',
                             im_specializ = '$im_specializ'
                         WHERE id_spec = '$id_spec'";
                         
        if (mysqli_query($linc, $update_query)) {
            $message = '<div class="alert bg-success " style="color: white">Зміни проведені</div>';
        } else {
            $message = '<div class="alert alert-danger">Помилка оновлення: ' . mysqli_error($linc) . '</div>';
        }
    }
    
    // Отримаємо поточні дані для редагування
    $result = mysqli_query($linc, "SELECT * FROM spec WHERE id_spec='$id_spec'");
    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>єСтудент</title>
<link rel="icon" type="image/png" href="..\assets\img\logo_brouser2.png">
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Favicon -->
        <link href="favicon.ico" rel="shortcut icon">
        <!-- Bootstrap Core CSS -->
                 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
		<link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

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
    <div id="body-bg">
        <!-- Header, меню, тощо можна підключити тут, якщо потрібно -->
        <?php include ("../include/adm_menu.php"); ?>
         <?php include ("../include/background_icon.php");?>

        <div class="container my-4">
            <h2 class="text-center mb-4">Редагування спеціальності (ID: <?= htmlspecialchars($row['im_spec'])  ?>)</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="POST" class="needs-validation signup-page" novalidate>
                <div class="mb-3">
                    <label for="id_galuz" class="form-label"><strong>ID Галузі</strong></label>
                    <input type="text" name="id_galuz" class="form-control" id="id_galuz" value="<?= htmlspecialchars($row['id_galuz']) ?>" required>
                    <div class="invalid-feedback">
                        Будь ласка, введіть ID Галузі.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="im_galuz" class="form-label"><strong>Назва Галузі</strong></label>
                    <input type="text" name="im_galuz" class="form-control" id="im_galuz" value="<?= htmlspecialchars($row['im_galuz']) ?>" required>
                    <div class="invalid-feedback">
                        Будь ласка, введіть назву Галузі.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="id_spec" class="form-label"><strong>ID Спеціальності</strong></label>
                    <input type="text" name="id_spec" class="form-control" id="id_spec" value="<?= htmlspecialchars($row['id_spec']) ?>" required>
                    <div class="invalid-feedback">
                        Будь ласка, введіть ID Спеціальності.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="im_spec" class="form-label"><strong>Назва Спеціальності</strong></label>
                    <input type="text" name="im_spec" class="form-control" id="im_spec" value="<?= htmlspecialchars($row['im_spec']) ?>" required>
                    <div class="invalid-feedback">
                        Будь ласка, введіть назву Спеціальності.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="im_specializ" class="form-label"><strong>Назва Спеціалізації</strong></label>
                    <input type="text" name="im_specializ" class="form-control" id="im_specializ" value="<?= htmlspecialchars($row['im_specializ']) ?>" required>
                    <div class="invalid-feedback">
                        Будь ласка, введіть назву Спеціалізації.
                    </div>
                </div>
                <div class="d-grid">
                    <input type="submit" name="submit_save" value="Зберегти зміни" class="btn btn-primary btn-lg" id="submit-form">
                </div>
            </form>
        </div>
    </div>
    <?php include ("../include/footer.php");?>

    <!-- JavaScript для валідації форми (Bootstrap) -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')

          // Loop over them and prevent submission
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
