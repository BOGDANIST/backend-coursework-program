<?php

session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
    header("Location: admin_panel.php");
} else {
    session_start();
    //define('myagency', true);
    include("../include/db_connect.php");
    // mysqli_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    // mysqli_query("SET CHARACTER SET 'utf8'");

    $id_group = $_GET["g_im_edit"];
    //$name_group_old=$_POST["form_group"];
    
    // if ($_POST["submit_save_gr"]) {
    //     if ($_POST["form_group"] != '') {
    //         $name_group = $_POST["form_group"];
    //     }


    //     mysqli_query($linc, "UPDATE st_group SET g_count_stud='{$_POST["form_ks"]}' WHERE g_im='$id_group'");
    //     mysqli_query($linc, "UPDATE st_group SET g_count_derg='{$_POST["form_ksd"]}' WHERE g_im='$id_group'");
    //     mysqli_query($linc, "UPDATE st_group SET g_count_comerc='{$_POST["form_ksk"]}' WHERE g_im='$id_group'");
    //     mysqli_query($linc, "UPDATE st_group SET g_nastav='{$_POST["form_nast"]}' WHERE g_im='$id_group'");


    //     if ($_POST["g_fn"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_formnavch='{$_POST["g_fn"]}' WHERE  g_im='$id_group'");
    //     }
    //     if ($_POST["g_gz"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_galuz='{$_POST["g_gz"]}' WHERE  g_im='$id_group'");
    //     }
    //     if ($_POST["g_sp"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_spec='{$_POST["g_sp"]}' WHERE  g_im='$id_group'");
    //     }
    //     if ($_POST["g_sz"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_specz='{$_POST["g_sz"]}' WHERE  g_im='$id_group'");
    //     }
    //     if ($_POST["g_kurs"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_course='{$_POST["g_kurs"]}' WHERE  g_im='$id_group'");
    //     }
    //     if ($_POST["g_vp"] != '') {
    //         mysqli_query($linc, "UPDATE st_group SET g_vipusc='{$_POST["g_vp"]}' WHERE  g_im='$id_group'");
    //     }

    //     if ($_POST["form_im_gr"] != '')
    //         mysqli_query($linc, "UPDATE st_group SET g_im='{$_POST["form_im_gr"]}' WHERE g_im='$id_group'");


    //     $success = 'Зміни проведені успішно';

    //     if ($_POST["g_kurs"] != '')
    //         mysqli_query($linc, "UPDATE student SET s_cours='{$_POST["g_kurs"]}' WHERE  s_group='$id_group'");

    //     if ($_POST["g_vp"] != '') {
    //         mysqli_query($linc, "UPDATE student SET s_vip='{$_POST["g_vp"]}' WHERE  s_group='$id_group'");
    //     }
    //     if ($_POST["form_im_gr"] != '')
    //         mysqli_query($linc, "UPDATE student SET s_group='{$_POST["form_im_gr"]}' WHERE  s_group='$id_group'");
    // }
    // ;




    // Припустимо, що з'єднання з базою даних збережене в змінній $linc

    if (isset($_POST["move_group_to_history"])) {

        // Отримуємо значення з форми
        $id_group = $_POST["id_group"]; // ідентифікатор групи
        $operation_date = $_POST["operation_date"]; // дата операції
        $operation_name = $_POST["operation_name"]; // причина операції

        // Перевіряємо чи задані ідентифікатор групи, дата та причина
        if (empty($id_group) || empty($operation_date) || empty($operation_name)) {
            $error = "Заповніть, будь ласка, дату операції, причину та визначте групу.";
            exit;
        }

        // Починаємо транзакцію для забезпечення цілісності операції

        // Переміщення даних групи до історичної таблиці "old_st_group"
        // Припускаємо, що таблиці st_group та old_st_group мають однакову структуру,
        // а також в таблиці old_st_group додані два поля для збереження інформації про операцію:
        // operation_date та operation_name.
        $insert_query = "INSERT INTO old_st_group (
                            g_vipusc, 
                            g_im, 
                            g_galuz, 
                            g_spec, 
                            g_specz, 
                            g_course, 
                            g_count_stud, 
                            g_count_derg, 
                            g_count_comerc, 
                            g_nastav, 
                            g_formnavch, 
                            g_id_sp,
                            operation_date, 
                            operation_name
                        )
                        SELECT 
                            g_vipusc, 
                            g_im, 
                            g_galuz, 
                            g_spec, 
                            g_specz, 
                            g_course, 
                            g_count_stud, 
                            g_count_derg, 
                            g_count_comerc, 
                            g_nastav, 
                            g_formnavch, 
                            g_id_sp,
                            '$operation_date', 
                            '$operation_name'
                        FROM st_group
                        WHERE g_im = '$id_group'";

        if (!mysqli_query($linc, $insert_query)) {
            mysqli_rollback($linc);
            $error = "Помилка переміщення групи до історії: " . mysqli_error($linc);
            exit;
        }

        // Видаляємо запис групи з таблиці st_group
        $delete_query = "DELETE FROM st_group WHERE g_im = '$id_group'";
        if (!mysqli_query($linc, $delete_query)) {
            mysqli_rollback($linc);
            $error = "Помилка видалення групи з основної таблиці: " . mysqli_error($linc);
            exit;
        }


        mysqli_commit($linc);
        $success = "Групу успішно переміщено до історії.";

        $operation_date = $_POST["operation_date"]; // дата операції
        $operation_name = "Випущений/а";
        // 2. Переміщення студентів з заданої групи до історичної таблиці "old_student"
        $insert_student_query = "INSERT INTO old_student (
                                s_id, s_pr, s_im, s_bat, s_stat, s_galuz, s_spec, s_specz, s_group,
                                s_form_navch, s_vip, s_cours, s_contract, s_dnar, s_vik, s_adresa,
                                s_tels, s_telb, s_telm, s_osvita_type, s_rik_zaver, s_region_type,
                                s_region, s_sirota, s_peresel, s_chernob, s_inval, s_malozab, s_ato,
                                s_war_act, s_ditzag, s_rada, s_shahter,
                                operation_date, operation_name
                             )
                             SELECT 
                                s_id, s_pr, s_im, s_bat, s_stat, s_galuz, s_spec, s_specz, s_group,
                                s_form_navch, s_vip, s_cours, s_contract, s_dnar, s_vik, s_adresa,
                                s_tels, s_telb, s_telm, s_osvita_type, s_rik_zaver, s_region_type,
                                s_region, s_sirota, s_peresel, s_chernob, s_inval, s_malozab, s_ato,
                                s_war_act, s_ditzag, s_rada, s_shahter,
                                '$operation_date', '$operation_name'
                             FROM student
                             WHERE s_group = '$id_group'";

        if (!mysqli_query($linc, $insert_student_query)) {
            mysqli_rollback($linc);
            $error = "Помилка переміщення студентів до історії: " . mysqli_error($linc);
            exit;
        }

        // Видалення студентів з основної таблиці даних
        $delete_student_query = "DELETE FROM student WHERE s_group = '$id_group'";
        if (!mysqli_query($linc, $delete_student_query)) {
            mysqli_rollback($linc);
            $error = "Помилка видалення студентів з групи: " . mysqli_error($linc);
            exit;
        }

        mysqli_commit($linc);


        header("Location: filter_group.php?success='Групу та всіх студентів цієї групи успішно переміщено до історії'");


    }

}
?>



<!-- === BEGIN HEADER === -->


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <!-- Title -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Template CSS -->
    <link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
    <!-- Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <script src="assets/js/toast-notifications.js"></script>
              <link rel="stylesheet" href="assets/css/toast-notifications.css">
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>

</head>

<div id="body-bg">
    <!-- Phone/Email -->

    <!-- End Phone/Email -->
    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="logo">
                    <a href="../admin/admin_panel.php" title="">
                        <img src="../assets/img/logo.png" alt="Logo" />
                    </a>
                </div>
                <!-- End Logo -->
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Top Menu -->
    <?php include("../include/adm_menu.php"); ?>
    <?php include("../include/background_icon.php"); ?>


    <div id="portfolio" class="bottom-border-shadow">

        <div class="container bottom-border">
            <div id="base">
                <div id="content">
                    <div class="container background-white" style="margin:0px; padding:10px;">
                        <div class="row margin-vert-30" style="margin:10px; padding:0px;">
                            <!-- Register Box -->
                            <div class="col-md-6 col-md-offset-3 col-sm-offset-3">

                                <form class="signup-page" method="POST">
                                    <div class="signup-header" style="text-align:center;">
                                        <p style="color:#C8D8E7; text-align: center;"><strong>Перегляд та редагування
                                                даних про групу
                                                <?php
                                                echo $id_group;
                                                ?>
                                            </strong></p>
                                    </div>
                                    <?php
                                    $result = mysqli_query($linc, "SELECT * FROM st_group WHERE g_im='$id_group'");
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_array($result);
                                        do {

                                            echo '
                               <label><strong>Назва групи</strong></label>
								<strong> <input type="text" class="form-control" name="form_im_group" value="' . $row['g_im'] . '" style="background:white; color:#0c0e0c; border:none;"  ></strong>
								
								<label><strong><strong>Форма навчання</strong></label>
								 <input type="text" class="form-control" name="form_fn" value="' . $row['g_formnavch'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								<select class="form-control"  name="g_fn"   style="background:white; color:#0c0e0c;">
									<option value="Денна">Денна</option>
									<option value="Заочна">Заочна</option>
								  </select> 
								
								<label><strong>Галузь знань</strong></label>
								 <input type="text" class="form-control" name="form_gz" value="' . $row['g_galuz'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								<select class="form-control" name="g_gz" id="sel2" size="6" style="color:#0c0e0c;">
								<option value="01 Освіта">01 Освіта</option>
								<option value="05 Соціальні і поведінкові науки">05 Соціальні і поведінкові науки</option>
								<option value="07 Управління та адміністрування">07 Управління та адміністрування</option>
								<option value="08 Право">08 Право</option>
								<option value="12 Інформаційні технології">12 Інформаційні технології</option>
								<option value="13 Механічна інженерія">13 Механічна інженерія</option>
								</select>
							
								<label><strong>Спціальність</strong></label>
								 <input type="text" class="form-control" name="form_sp" value="' . $row['g_spec'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								<select class="form-control" name="g_sp" id="sel3" size="7" style="color:#0c0e0c;">
								<option value="017 Фізична культура і спорт">017 Фізична культура і спорт</option>
								<option value="051 Економіка">051 Економіка</option>
								<option value="072 Фінанси, банківська справа та страхування">072 Фінанси, банківська справа та страхування</option>
								<option value="081 Право">081 Право</option>
								<option value="121 Інженерія програмного забезпечення">121 Інженерія програмного забезпечення</option>
								<option value="133 Галузеве машинобудування">133 Галузеве машинобудування</option>
								<option value="136 Металургія">136 Металургія</option>
								</select>
								
								<label><strong>Спеціалізація</strong></label>
								 <input type="text" class="form-control" name="form_sz value="' . $row['g_specz'] . '" style="background:white; color:#0c0e0c; border:none;" >
								<select class="form-control" name="g_sz" id="sel4" size="6" style="color:#0c0e0c;">
								<option value=""></option>
								<option value="Ливарне виробництво чорних і кольорових металів і сплавів">Ливарне виробництво чорних і кольорових металів і сплавів</option>
								<option value="Художнє та ювелірне литво">Художнє та ювелірне литво</option>
								<option value="Хімічне і нафтове машинобудуванняя">Хімічне і нафтове машинобудування</option>
								<option value="Експлуатація та ремонт обладнання харчових виробництв">Експлуатація та ремонт обладнання харчових виробництв</option>
								<option value="Технологія обробки матеріалів на верстатах та автоматичних лініях">Технологія обробки матеріалів на верстатах та автоматичних лініях/option>
								<option value="Сучасні комп"ютерні технології в машинобудуванні">Сучасні комп"ютерні технології в машинобудуванні</option>
								</select>
								
								<label><strong>Курс</strong></label>
								<input type="text" class="form-control" name="form_cours" value="' . $row['g_course'] . '" style="background:white; color:#0c0e0c; border:none;"  >
									<select class="form-control" name="g_kurs" id="sel5" size="4" style="color:#0c0e0c;">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									</select>
									
									<label><strong>Випускна група</strong></label>	
									<input type="text" class="form-control" name="form_vp" value="' . $row['g_vipusc'] . '" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="g_vp" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								  
									<label><strong>Кількість студентів</strong></label>
									<input type="text" class="form-control" name="form_ks" value="' . $row['g_count_stud'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								 
									<label> <strong>Кількість студентів, що навчаються за регіональним замовленням</strong></label>
								    <input type="text" class="form-control" name="form_ksd" value="' . $row['g_count_derg'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								  
									<label> <strong>Кількість студентів, що навчаються за кошти фізичних або юридичних осіб</strong></label>
								    <input type="text" class="form-control" name="form_ksk" value="' . $row['g_count_comerc'] . '" style="background:white; color:#0c0e0c; border:none;"  >

									<label>Наставник групи</label>	
									<input type="text" class="form-control" name="form_nast" value="' . $row['g_nastav'] . '" style="background:white; color:#0c0e0c; border:none;"  >	  
								 ';
                                        }

                                        while ($row = mysqli_fetch_array($result));
                                    }
                                    ?>


                                    <p>
                                        <button type="button" class="form-control bg-success" id="submit-form"
                                        
                                            onclick="console.log(this.form.closest('form'));  AsyncRouter.editGroup('<?= isset($id_group) ? $id_group : '' ?>', this.form.closest('form')); return false;">
                                            Зберегти зміни
                                        </button>
                                    </p>

                                </form>
                                <div class="card shadow-lg rounded-2 border-2"
                                    style="background-color: #94c7f6; border: #4ea6ee; margin-top: 15px; padding: 7px;">
                                    <div class="card-header" data-bs-toggle="collapse"
                                        data-bs-target="#moveGroupHistoryForm" aria-expanded="false"
                                        aria-controls="moveGroupHistoryForm" style="cursor: pointer;">
                                        <h5 class="mb-0 text-center fs-2 fw-bold">Перемістити групу до історії</h5>
                                    </div>
                                    <div id="moveGroupHistoryForm" class="collapse">
                                        <div class="card-body">
                                            <!-- Форма включає прихований id групи, поле для вибору дати та комбо-бокс для вибору причини операції -->
                                            <form method="post" action="">
                                                <!-- Прихований input із ідентифікатором групи -->
                                                <input type="hidden" name="id_group"
                                                    value="<?= isset($id_group) ? htmlspecialchars($id_group) : '' ?>">

                                                <div class="mb-3">
                                                    <label for="operation_date" class="form-label"><strong>Дата
                                                            операції</strong></label>
                                                    <input type="date" name="operation_date" id="operation_date"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="operation_name" class="form-label"><strong>Причина
                                                            операції</strong></label>
                                                    <select name="operation_name" id="operation_name"
                                                        class="form-select" required style="font-size: 14px;">
                                                        <option value="">Виберіть причину</option>
                                                        <option value="Завершення навчання">Завершення навчання</option>
                                                        <option value="Реорганізація групи">Реорганізація групи</option>
                                                        <option value="Інша причина">Інша причина</option>
                                                    </select>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" name="move_group_to_history"
                                                        class="btn btn-danger btn-lg">
                                                        Перемістити групу до історії
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include("../include/footer.php"); ?>

    <!-- End Footer -->
    <!-- Toast Notifications Container -->
    <div id="toast-container"></div>


    <!-- <script type="text/javascript" src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    Isotope - Portfolio Sorting 
    <script type="text/javascript" src="assets/js/jquery.isotope.js" type="text/javascript"></script>
    // Mobile Menu - Slicknav 
    <script type="text/javascript" src="assets/js/jquery.slicknav.js" type="text/javascript"></script>
    // Animate on Scroll/>
    <script type="text/javascript" src="assets/js/jquery.visible.js" charset="utf-8"></script>
    // Sticky Div />
    <script type="text/javascript" src="assets/js/jquery.sticky.js" charset="utf-8"></script>
    // Slimbox2/>
    <script type="text/javascript" src="assets/js/slimbox2.js" charset="utf-8"></script> />
    // Modernizr 
    <script src="assets/js/modernizr.custom.js" type="text/javascript"></script>-->
    <!-- Toast Notifications -->

        <script src="async.js"></script>


    <body>

</html>