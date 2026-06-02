<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor', 'viewer'])) {
    header("Location: admin_panel.php");
} else {
    include("../include/db_connect.php");
    error_reporting(0);
    ?>

    <!-- === BEGIN HEADER === -->
    <!DOCTYPE html>
    <html lang="en">

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
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <!-- Template CSS -->
        <link rel="stylesheet" href="../css/my_style.css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Toast Notifications -->
        <link rel="stylesheet" href="assets/css/toast-notifications.css">
    </head>

    <div id="body-bg">
        <!-- Header -->
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
        <!-- End Header -->

        <!-- Top Menu -->
        <?php include("../include/adm_menu.php"); ?>
        <?php include("../include/background_icon.php"); ?>
        <!-- End Top Menu -->

        <!-- === END HEADER === -->

        <!-- === BEGIN CONTENT === -->

        <div class="container-fluid col-11 bottom-border  ">
            <div class="row padding-top-40 d-flex align-content-center">
                <div class="col-md-12">
                    <!-- Block filter -->
                    <div class="block_search col-lg-3 shadow-lg"
                        style="height:auto; background:#256279; border: 3px solid #004768; margin-left:10px; margin-top:10px; margin-bottom:14px; padding-bottom:10px;  color: #e5e5e5;">
                        <h3 class="margin-bottom-6" style="margin-left:10px ; color: #8fd5e3; text-align: center;">
                            <strong>Пошуковий фільтр</strong>
                        </h3>

                        <style>
                            /* Усі фільтри */
                            .dropdown-filter-btn {
                                background-color: #f8f9fa;
                                border: 1px solid #6c757d;
                                font-weight: bold;
                                font-size: 16px;
                            }

                            .dropdown-filter-menu {
                                background-color: #ffffff;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                color: #000000;
                                max-height: 300px;
                                overflow-y: auto;
                            }

                            .dropdown-filter-item {
                                padding: 5px 0;
                            }
                        </style>

                        <form id="filter-form" method="POST" style="display: contents;">
                            <!-- Секція сортування -->
                            <div id="block-search-sort" class="mb-3 fs-3">
                                <label for="sort_by" class="form-label ms-1"><strong>Сортувати за: </strong></label>
                                <select name="sort_by" id="sort_by" class="form-select w-auto d-inline-block fs-5">
                                    <option value="">-- не сортувати --</option>
                                    <option value="s_pr">Прізвищем</option>
                                    <option value="s_group">Групою</option>
                                    <option value="s_cours">Курсом</option>
                                    <option value="s_dnar">Роком народження</option>
                                </select>
                            </div>
                            <div id="block-search-sort" class="mb-3 fs-3">
                                <label for="sort_dir" class="form-label ms-1"><strong>Порядок: </strong></label>
                                <select name="sort_dir" id="sort_dir" class="form-select w-auto d-inline-block fs-5">
                                    <option value="ASC">від A до Я (зростання)</option>
                                    <option value="DESC">від Я до A (спадання)</option>
                                </select>
                            </div>

                            <!-- РІК ЗАВЕРШЕННЯ ШКОЛИ -->
                            <div id="block-search-left mb-5" style="margin-bottom:15px;">
                                <p class="header-title"
                                    style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Пошук
                                        студентів за ПІБ</strong></p>
                                <div class="" id="block-category">
                                    <label class="col-2" style="font-size: 15px;">ПІБ:</label>
                                    <input class="col-9" type="text" name="s_pib" value="" style=width:80%; height: 25px;
                                        background:white; font-size: 15px;margin-top:5px; border:1px solid #cccccc;
                                        color:#030303; padding-left:10px; border-radius:10px; ">
                                            </div>
                                        </div>

                                        <!-- Вид замовлення -->
                                        <div class=" dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownVzMenu"
                                        aria-expanded="false">
                                        Вид замовлення
                                    </button>
                                    <div id="dropdownVzMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_vz0"
                                                        value="Ні"> навч. за регіон. замовл.</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_vz1"
                                                        value="Так"> навч. за кошти фіз. або юридич. осіб</label></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Галузь знань -->
                                <div class="dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownGzMenu"
                                        aria-expanded="false">
                                        Галузь знань
                                    </button>
                                    <div id="dropdownGzMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <?php
                                            $gz_query = "SELECT DISTINCT im_galuz AS gz FROM spec ORDER BY im_galuz ASC";
                                            $gz_result = mysqli_query($linc, $gz_query);
                                            if ($gz_result) {
                                                while ($row_gz = mysqli_fetch_assoc($gz_result)) {
                                                    $value = htmlspecialchars($row_gz['gz']);
                                                    echo '<li class="dropdown-gz-item">
                                                        <label>
                                                            <input type="checkbox" name="check_gz[]" value="' . $value . '"> ' . $value . '
                                                        </label>
                                                    </li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Спеціальність -->
                                <div class="dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownSpecialtyMenu"
                                        aria-expanded="false">
                                        Спеціальність
                                    </button>
                                    <div id="dropdownSpecialtyMenu"
                                        class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <?php
                                            $spec_query = "SELECT DISTINCT im_spec AS spec FROM spec ORDER BY id_spec ASC";
                                            $spec_result = mysqli_query($linc, $spec_query);
                                            if ($spec_result) {
                                                while ($row_spec = mysqli_fetch_assoc($spec_result)) {
                                                    $spec = htmlspecialchars($row_spec['spec']);
                                                    echo '<li class="dropdown-specialty-item">
                                                        <label>
                                                            <input type="checkbox" name="check_sp[]" value="' . $spec . '"> ' . $spec . '
                                                        </label>
                                                    </li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Курс -->
                                <div class="dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownCourseMenu"
                                        aria-expanded="false">
                                        Курс
                                    </button>
                                    <div id="dropdownCourseMenu"
                                        class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <li class="dropdown-filter-item"><label><input type="checkbox"
                                                        name="check_kurs1" value="1"> I курс</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox"
                                                        name="check_kurs2" value="2"> II курс</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox"
                                                        name="check_kurs3" value="3"> III курс</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox"
                                                        name="check_kurs4" value="4"> IV курс</label></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- ОСВІТА -->
                                <div class="dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownOsvitaMenu"
                                        aria-expanded="false">
                                        Освіта
                                    </button>
                                    <div id="dropdownOsvitaMenu"
                                        class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_os1"
                                                        value="Базова загальна середня освіта"> Базова загальна середня
                                                    освіта</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_os2"
                                                        value="Повна загальна середня освіта"> Повна загальна середня
                                                    освіта</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_os3"
                                                        value="Молодший спеціаліст"> Молодший спеціаліст</label></li>
                                            <li class="dropdown-filter-item"><label><input type="checkbox" name="check_os4"
                                                        value="Кваліфікований робітник"> Кваліфікований робітник</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Група -->
                                <div id="block-search-left">
                                    <div id="block-category">
                                        <p class="header-title"
                                            style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;">
                                            <strong></strong>
                                        </p>
                                        <div class="mb-3 fs-3">
                                            <label for="form_group" class="form-label fs-3">Оберіть групу</label>
                                            <select class="form-select fs-4" name="form_group" id="form_group">
                                                <option value="">-- Виберіть групу --</option>
                                                <?php
                                                $query_group = mysqli_query($linc, "SELECT * FROM st_group");
                                                while ($temp = mysqli_fetch_assoc($query_group)) {
                                                    echo '<option value="' . htmlspecialchars($temp['g_im']) . '">' . htmlspecialchars($temp['g_im']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <ul id="ul-category"
                                        style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
                                        <li><input type="checkbox" name="check_vg" value="Так" style="margin:0px;"> випускна
                                            група</li>
                                    </ul>
                                </div>

                                <!-- СТАТЬ -->
                                <div id="block-search-left">
                                    <div id="block-category">
                                        <p class="header-title"
                                            style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;">
                                            <strong>Стать:</strong>
                                        </p>
                                        <ul id="ul-category"
                                            style="columns: 2; list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
                                            <li><input type="checkbox" name="check_men" value="Чоловік" style="margin:0px;">
                                                чоловік</li>
                                            <li><input type="checkbox" name="check_women" value="Жінка" style="margin:0px;">
                                                жінка</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- ВІК -->
                                <div id="block-search-left">
                                    <p class="header-title"
                                        style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;">
                                        <strong>Вік</strong>
                                    </p>
                                    <div id="block-category">
                                        <label style="font-size: 15px;">від</label>
                                        <input type="number" name="vik_from" value=""
                                            style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
                                        <label style="font-size: 15px;">до</label>
                                        <input type="number" name="vik_to" value=""
                                            style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
                                        <label style="font-size: 15px;">років</label>
                                    </div>
                                </div>

                                <!-- РІК ЗАВЕРШЕННЯ ШКОЛИ -->
                                <div id="block-search-left">
                                    <p class="header-title"
                                        style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;">
                                        <strong>Рік завершення школи</strong>
                                    </p>
                                    <div id="block-category">
                                        <label style="font-size: 15px;">Рік</label>
                                        <input type="text" name="text_yer" value=""
                                            style="width:50px; height: 25px; background:white; font-size: 15px;margin-top:5px; margin-bottom:5px; border:1px solid #cccccc; color:#030303;">
                                    </div>
                                </div>

                                <!-- ПРОЖИВАННЯ -->
                                <div id="block-search-left">
                                    <div id="block-category">
                                        <p class="header-title"
                                            style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;">
                                            <strong>Проживання:</strong>
                                        </p>
                                        <ul id="ul-category"
                                            style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
                                            <li><input type="checkbox" name="check_mp1" value="Місто"
                                                    style="margin:0px;">місто</li>
                                            <li><input type="checkbox" name="check_mp2" value="Сільська місцевість"
                                                    style="margin:0px;">сільська місцевість</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Область проживання -->
                                <div class="dropdown dropdown-filter-wrapper mb-3">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#dropdownRegionMenu"
                                        aria-expanded="false">
                                        Область проживання
                                    </button>
                                    <div id="dropdownRegionMenu"
                                        class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                        style="font-size: 15px;">
                                        <ul class="list-unstyled m-0">
                                            <?php
                                            $regions = [
                                                "Вінницька",
                                                "Волинська",
                                                "Дніпропетровська",
                                                "Донецька",
                                                "Житомирська",
                                                "Закарпатська",
                                                "Запорізька",
                                                "Івано-Франківська",
                                                "Київська",
                                                "Кіровоградська",
                                                "Луганська",
                                                "Львівська",
                                                "Миколаївська",
                                                "Одеська",
                                                "Полтавська",
                                                "Рівненська",
                                                "Сумська",
                                                "Тернопільська",
                                                "Харкіська",
                                                "Херсонська",
                                                "Хмельницька",
                                                "Черкаська",
                                                "Чернівецька",
                                                "Чернігівська",
                                                "АР Крим"
                                            ];
                                            foreach ($regions as $region) {
                                                echo '<li class="dropdown-filter-item"><label>';
                                                echo '<input type="radio" name="select_region" value="' . htmlspecialchars($region) . '"> ' . htmlspecialchars($region);
                                                echo '</label></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Соціальна категорія -->
                                <div id="block-search-left">
                                    <div id="block-category">
                                        <div class="dropdown dropdown-filter-wrapper mb-3">
                                            <button
                                                class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#dropdownSocialMenu"
                                                aria-expanded="false">
                                                Соціальна категорія
                                            </button>
                                            <div id="dropdownSocialMenu"
                                                class="collapse dropdown-filter-menu border rounded p-3 mt-2"
                                                style="font-size: 15px;">
                                                <ul class="list-unstyled m-0">
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_sirot" value="Так"> діти-сироти та діти
                                                            позбавлені батьківського піклування</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_peres" value="Так"> переселенці</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_chernob" value="Так"> чорнобильці</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_ivalid" value="Так"> інваліди</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_malozab" value="Так"> малозабезпечені</label>
                                                    </li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_ato" value="Так"> діти учасників АТО</label>
                                                    </li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_uchbd" value="Так"> учасники бойових дій та їх
                                                            діти</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_ditzag" value="Так"> діти загиблих
                                                            майданівців</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_stepver" value="Так"> стипендіати Верховної
                                                            ради</label></li>
                                                    <li class="dropdown-filter-item"><label><input type="checkbox"
                                                                name="check_shaht" value="Так"> шахтарі і діти
                                                            шахтарів</label></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Кнопки -->
                                <div style=" border-top:2px solid #cccccc; margin-bottom:0px; margin-top: 10px;">
                                    <button class="col-4 form-control bg-success fs-3" type="button" id="submit-filter"
                                        style="margin-top:10px; border-radius:5px;color: #ddfff0;">Пошук</button>
                                    <button class="form-control bg-danger fs-3" type="button" id="clear-filter"
                                        style="margin-top:10px; border-radius:5px; color: #ffffff;">Очистити</button>
                                    <button type="button" class="col-6 form-control fs-3" id="submit-excel-export"
                                        style="background-color: #d9d368; margin-top:10px; border-radius:5px; color: #000000;">
                                        Завантажити Excel
                                    </button>
                                </div>
                        </form>
                    </div>
                    <!-- End Block filter -->

                    <!-- Block list -->
                    <div class="row">
                        <div class="col-md-12" style="margin-top:10px;">
                            <div class="tab-content">
                                <div class="tab-pane active in fade" id="faq">
                                    <div id="results-table" class="table-responsive">
                                        <!-- Results will be rendered here by JavaScript -->
                                    </div>

                                    <!-- Pagination container -->
                                    <div id="pagination-container">
                                        <!-- Pagination will be rendered here -->
                                    </div>

                                    <!-- Records per page selector -->
                                    <div class="container-fluid d-flex justify-content-end align-items-center mt-3">
                                        <form id="limit-form" method="GET"
                                            style="display: inline-flex; gap: 10px; align-items: center;">
                                            <label for="limit">Записів на сторінці:</label>
                                            <select name="limit" id="limit"
                                                onchange="AsyncRouter.filterStudents(document.getElementById('filter-form'), 1, this.value)">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50" selected>50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Block list -->
                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <?php include("../include/footer.php"); ?>
    </div>

    <body>
        <!-- Scripts -->
        <script src="assets/js/toast-notifications.js"></script>
        <script src="async.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const submitBtn = document.getElementById('submit-filter');
                const clearBtn = document.getElementById('clear-filter');
                const excelExport = document.getElementById('submit-excel-export');
                const form = document.getElementById('filter-form');

                // 1. Спочатку підтягуємо збережені фільтри з пам'яті (якщо вони є)
                const savedFilters = AsyncRouter.loadFiltersFromLocalStorage();
                if (savedFilters) {
                    AsyncRouter.applyFiltersToForm(form, savedFilters);
                }

                // 2. Робимо ЄДИНИЙ стартовий виклик для завантаження таблиці
                AsyncRouter.filterStudents(form, 1, document.getElementById('limit').value);

                // Обробник кнопки "Пошук"
                submitBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    AsyncRouter.filterStudents(form, 1, document.getElementById('limit').value);
                });

                // Обробник кнопки "Очистити"
                clearBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    form.reset();
                    AsyncRouter.clearFiltersFromLocalStorage();
                    document.getElementById('results-table').innerHTML = '';
                    document.getElementById('pagination-container').innerHTML = '';
                    ToastNotification.info('Фільтри очищені');

                    AsyncRouter.filterStudents(form, 1, document.getElementById('limit').value);
                });

                // Обробник експорту в Excel
                if (excelExport && form) {
                    excelExport.addEventListener('click', function (e) {
                        e.preventDefault();
                        const filters = AsyncRouter.collectFilterData(form);
                        AsyncRouter.saveFiltersToLocalStorage(filters);
                        AsyncRouter.exportStudentsToExcel(form);
                    });
                }
            });
        </script>
    </body>

    </html>

    <?php
}
?>