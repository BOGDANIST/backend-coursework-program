<?php
session_start();

if ($_SESSION['auth_user'] != "admin") {
    echo 'Доступ заборонений';
    unset($_SESSION['auth_user']);
    header("Location:input.php");
    exit;
} 
include ("../include/db_connect.php");
error_reporting(0);

$id_user = $_GET["user_id_edit"] ?? 0;

$result = mysqli_query($linc, "SELECT * FROM users WHERE user_id='$id_user'");
$row = mysqli_fetch_assoc($result);
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
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
</head>
<body>	
    <div id="header">
        <div class="container" >
            <div class="row col-12" >
                <div class="logo ">
                    <a href="index.html" title="">
                        <img src="../assets/img/logo2.png" alt="Logo" style="max-width: 100%;"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="body-bg">
        <?php include ("../include/adm_menu.php");?>
        <?php include ("../include/background_icon.php");?>
			
        <div class="container">
            <div id="base">
                <div id="content">
                  <div class="container background-white" style="margin:0px; padding:10px;">
                    <div class="row margin-vert-30" style="margin:10px; padding:0px;">
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                            
                            <form class="signup-page" method="POST">
                                <div class="signup-header">
                                    <h3 style="color:#C8D8E7; text-align: center;"><strong>Зміни даних користувача</strong></h3>
                                </div>
								
                                <label for="sel1">Логін</label>
                                <input type="text" class="form-control" name="login" value="<?= htmlspecialchars($row['login'] ?? '') ?>" style="background:white; color:#0c0e0c; border:none;" readonly>
                                
                                <label>Введіть новий пароль (залиште пустим, якщо не міняєте)</label>
                                <input type="password" class="form-control" name="new_password1" style="background:white; color:#0c0e0c; border:none;"> 
                                
                                <label>Підтвердіть новий пароль</label>
                                <input type="password" class="form-control" name="new_password2" style="background:white; color:#0c0e0c; border:none;"> 
                                
                                <label>Виберіть рівень доступу</label>
                                <select class="form-control" name="status" size="3" style="background:white; color:#0c0e0c;">
                                    <option value="user" <?= ($row['status'] == '1') ? 'selected' : '' ?>>Спостерігач</option>
                                    <option value="editor" <?= ($row['status'] == '9') ? 'selected' : '' ?>>Редактор</option>
                                    <option value="admin" <?= ($row['status'] == '10') ? 'selected' : '' ?>>Адміністратор</option>
                                </select>  
                                <p>
                                    <button type="button" class="form-control bg-success" style="color:white; margin-top: 15px;" onclick="AsyncRouter.editUser(<?= (int)$id_user ?>, this.form); return false;">Підтвердити</button>
                                </p>
                            </form>
                            
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div id="toast-container"></div>
        <?php include ("../include/footer.php");?>

        <script type="text/javascript" src="assets/js/toast-notifications.js"></script>
        <script type="text/javascript" src="async.js"></script>
    </body>
</html>