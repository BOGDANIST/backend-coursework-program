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
            <link rel="stylesheet" href="assets/css/toast-notifications.css" rel="stylesheet">

    <!-- Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

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

    <!-- End Top Menu -->


    <!-- Portfolio -->
    <div id="portfolio" class="bottom-border-shadow">

        <div class="container bottom-border">

            <!-- End Portfolio -->

            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
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
    
    // 1. Збираємо всю таблицю spec у вигляді дерева (Галузь -> Спеціальності -> Спеціалізації)
    $spec_tree = [];
    $spec_query = "SELECT im_galuz, im_spec, im_specializ FROM spec";
    $spec_result = mysqli_query($linc, $spec_query);
    if ($spec_result) {
        while ($r = mysqli_fetch_assoc($spec_result)) {
            $g = trim($r['im_galuz']);
            $s = trim($r['im_spec']);
            $sz = trim($r['im_specializ']);
            
            if (!isset($spec_tree[$g])) $spec_tree[$g] = [];
            if (!isset($spec_tree[$g][$s])) $spec_tree[$g][$s] = [];
            if (!empty($sz) && !in_array($sz, $spec_tree[$g][$s])) {
                $spec_tree[$g][$s][] = $sz;
            }
        }
    }
    // Перетворюємо дерево в JSON для JavaScript
    $spec_json = json_encode($spec_tree, JSON_UNESCAPED_UNICODE);

    $row = mysqli_fetch_array($result);
    do {
        // Отримуємо поточні значення групи з бази даних
        $current_gz = htmlspecialchars($row['g_galuz'] ?? '');
        $current_sp = htmlspecialchars($row['g_spec'] ?? '');
        $current_sz = htmlspecialchars($row['g_specz'] ?? '');

        // Формуємо опції тільки для Галузі (інші селектори заповнить JS)
        $gz_options = '<option value="">-- Оберіть галузь --</option>';
        foreach ($spec_tree as $galuz => $specs) {
            $selected = ($galuz == $current_gz) ? 'selected' : '';
            $gz_options .= '<option value="'.htmlspecialchars($galuz).'" '.$selected.'>'.htmlspecialchars($galuz).'</option>';
        }

        // 2. Виводимо форму (зайві input-и прибрано, id для JS додано)
        echo '
        <label><strong>Назва групи</strong></label>
        <strong> <input type="text" class="form-control" name="form_im_group" value="' . htmlspecialchars($row['g_im']) . '" style="background:white; color:#0c0e0c; border:none;" required></strong>
        
        <label><strong>Форма навчання</strong></label>
        <select class="form-control" name="g_fn" style="background:white; color:#0c0e0c;">
            <option value="Денна" '.(($row['g_formnavch'] == 'Денна') ? 'selected' : '').'>Денна</option>
            <option value="Заочна" '.(($row['g_formnavch'] == 'Заочна') ? 'selected' : '').'>Заочна</option>
        </select> 
        
        <label><strong>Галузь знань</strong></label>
        <select class="form-control" name="g_gz" id="sel_galuz" size="6" style="color:#0c0e0c;" required>
            ' . $gz_options . '
        </select>
    
        <label><strong>Спеціальність</strong></label>
        <select class="form-control" name="g_sp" id="sel_spec" size="7" style="color:#0c0e0c;" disabled required>
            <option value="">-- Спочатку оберіть галузь --</option>
        </select>
        
        <label><strong>Спеціалізація</strong></label>
        <select class="form-control" name="g_sz" id="sel_specz" size="6" style="color:#0c0e0c;" disabled>
            <option value="">-- Спочатку оберіть спеціальність --</option>
        </select>
        
        <label><strong>Курс</strong></label>
        <select class="form-control" name="g_kurs" id="sel5" size="4" style="color:#0c0e0c;" required>
            <option value="1" '.(($row['g_course'] == '1') ? 'selected' : '').'>1</option>
            <option value="2" '.(($row['g_course'] == '2') ? 'selected' : '').'>2</option>
            <option value="3" '.(($row['g_course'] == '3') ? 'selected' : '').'>3</option>
            <option value="4" '.(($row['g_course'] == '4') ? 'selected' : '').'>4</option>
        </select>
        
        <label><strong>Випускна група</strong></label>	  
        <select class="form-control" name="g_vp" id="sel7" size="2" style="background:white; color:#0c0e0c;">
            <option value="Так" '.(($row['g_vipusc'] == 'Так') ? 'selected' : '').'>Так</option>
            <option value="Ні" '.(($row['g_vipusc'] == 'Ні') ? 'selected' : '').'>Ні</option>
        </select> 
        
        <label><strong>Кількість студентів</strong></label>
        <input type="text" class="form-control" name="g_count_stud" value="' . htmlspecialchars($row['g_count_stud']) . '" style="background:white; color:#0c0e0c; border:none;">
        
        <label> <strong>Кількість студентів, що навчаються за регіональним замовленням</strong></label>
        <input type="text" class="form-control" name="g_count_rz" value="' . htmlspecialchars($row['g_count_derg']) . '" style="background:white; color:#0c0e0c; border:none;">
        
        <label> <strong>Кількість студентів, що навчаються за кошти фізичних або юридичних осіб</strong></label>
        <input type="text" class="form-control" name="g_count_contr" value="' . htmlspecialchars($row['g_count_comerc']) . '" style="background:white; color:#0c0e0c; border:none;">

        <label>Наставник групи</label>	
        <input type="text" class="form-control" name="g_nast" value="' . htmlspecialchars($row['g_nastav']) . '" style="background:white; color:#0c0e0c; border:none;">	  
        ';
    } while ($row = mysqli_fetch_array($result));
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



                <!-- End Sample Menu -->
            </div>
        </div>
    </div>

    <!-- Footer -->
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
    <script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
    <!-- Async Router -->
    <script type="text/javascript" src="async.js" type="text/javascript"></script>

    <body>

</html>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Отримуємо наше дерево галузей і спеціальностей з PHP
    const specTree = <?= $spec_json ?? '{}' ?>;
    
    // 2. Отримуємо поточні значення групи з бази даних (для сторінки редагування)
    const currentGaluz = "<?= $current_gz ?? '' ?>";
    const currentSpec  = "<?= $current_sp ?? '' ?>";
    const currentSpecz = "<?= $current_sz ?? '' ?>";

    // 3. Знаходимо наші випадаючі списки на сторінці
    const selGaluz = document.getElementById('sel_galuz');
    const selSpec  = document.getElementById('sel_spec');
    const selSpecz = document.getElementById('sel_specz');

    if (!selGaluz || !selSpec || !selSpecz) return;

    // Функція оновлення Спеціальностей (розблоковує поле)
    function updateSpec(selectedGaluz, autoSelectSpec = '') {
        selSpec.innerHTML = '<option value="">-- Оберіть спеціальність --</option>';
        selSpecz.innerHTML = '<option value="">-- Спочатку оберіть спеціальність --</option>';
        selSpecz.disabled = true; // Блокуємо спеціалізацію

        // Якщо нічого не обрано, блокуємо і спеціальність
        if (!selectedGaluz || !specTree[selectedGaluz]) {
            selSpec.disabled = true;
            selSpec.innerHTML = '<option value="">-- Спочатку оберіть галузь --</option>';
            return;
        }

        // Розблоковуємо та заповнюємо
        selSpec.disabled = false;
        const specs = specTree[selectedGaluz];
         selSpec.innerHTML = "";
        for (const sp in specs) {
            const isSelected = (sp === autoSelectSpec) ? 'selected' : '';
            selSpec.innerHTML += `<option value="${sp}" ${isSelected}>${sp}</option>`;
        }
    }

    // Функція оновлення Спеціалізацій (розблоковує поле)
    function updateSpecz(selectedGaluz, selectedSpec, autoSelectSpecz = '') {
        selSpecz.innerHTML = '<option value="">-- Оберіть спеціалізацію --</option>';
        
        if (!selectedGaluz || !selectedSpec || !specTree[selectedGaluz] || !specTree[selectedGaluz][selectedSpec]) {
            selSpecz.disabled = true;
            selSpecz.innerHTML = '<option value="">-- Спочатку оберіть спеціальність --</option>';
            return;
        }

        const speczs = specTree[selectedGaluz][selectedSpec];
        
        // Якщо для цієї спеціальності взагалі не існує спеціалізацій
        if (speczs.length == 0) {
            selSpecz.innerHTML = '<option value="">-- Немає спеціалізацій --</option>';
            selSpecz.disabled = true; // Залишаємо заблокованим
            return;
        }

        // Розблоковуємо та заповнюємо
        selSpecz.disabled = false;
        selSpecz.innerHTML = ``;
        speczs.forEach(sz => {
            const isSelected = (sz === autoSelectSpecz) ? 'selected' : '';
            selSpecz.innerHTML += `<option value="${sz}" ${isSelected}>${sz}</option>`;
        });
    }

    // 4. Вішаємо слухачі подій (що робити, коли користувач клікає на список)
    selGaluz.addEventListener('change', function() {
        updateSpec(this.value); // Оновлюємо спеціальності
    });

    selSpec.addEventListener('change', function() {
        updateSpecz(selGaluz.value, this.value); // Оновлюємо спеціалізації
    });

    // 5. Ініціалізація при завантаженні сторінки (щоб підтягнути дані з бази при редагуванні)
    if (currentGaluz) {
        updateSpec(currentGaluz, currentSpec);
        if (currentSpec) {
            updateSpecz(currentGaluz, currentSpec, currentSpecz);
        }
    }
});
</script>