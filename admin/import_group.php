<?php
session_start();
 
	if (!in_array($_SESSION['auth_user'], ['admin', 'editor']))
	{   unset($_SESSION['auth_user']);
		header("Location:../admin/input.php");
	}   
else
	{
  
            require '../include/db_connect.php';


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["csv_file"])) {
    $file = $_FILES["csv_file"]["tmp_name"];

    if (is_uploaded_file($file)) {
        $handle = fopen($file, "r");

        if (!$handle) {
            echo "<p style='color: red;'>Не вдалося відкрити файл.</p>";
            exit;
        }

        // Визначаємо роздільник (кома або крапка з комою)
        $firstLine = fgets($handle);
        rewind($handle);

        $delimiter = ",";
        if (substr_count($firstLine, ";") > substr_count($firstLine, ",")) {
            $delimiter = ";";
        }

        // Пропускаємо заголовок
        fgetcsv($handle, 1000, $delimiter);

        $successs = 0;
        $failed = 0;

        while (($data = fgetcsv($handle, 10000, $delimiter)) !== FALSE) {
            if (count($data) < 12) {
                $failed++;
                continue;
            }

            $sql = "INSERT INTO st_group (
                        g_vipusc, g_im, g_galuz, g_spec, g_specz, g_course, g_count_stud, 
                        g_count_derg, g_count_comerc, g_nastav, g_formnavch, g_id_sp
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $linc->prepare($sql);

            if ($stmt) {
                $stmt->bind_param(
                    "ssssssssssss",
                    $data[0], $data[1], $data[2], $data[3], $data[4], $data[5],
                    $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]
                );

                if ($stmt->execute()) {
                    $successs++;
                } else {
                    $failed++;
                    // Для налагодження: echo $stmt->error;
                }

                $stmt->close();
            } else {
                $failed++;
            }
        }

        fclose($handle);

       if($successs>0){
            $success = "Успішно імпортовано: $successs рядків";
        }
        if($failed>0){
            $error = "Не вдалося імпортувати: $failed рядків";
        }
 
    } else {
        $error = "Помилка завантаження файлу";
      
    }
}



    }

?>



<!DOCTYPE html>
<html>

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
                 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
		 <link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">

        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

        
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  

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
    			<!-- Top Menu -->
			<?php include ("../include/adm_menu.php");?>
            <?php include ("../include/background_icon.php");?>
            <!-- End Top Menu -->


    <div class="container text-center   d-flex align-items-center justify-content-center ">
        <form class=" signup-page col-9" method="POST"  enctype="multipart/form-data">
            <div class="signup-header">
                <h2 style="color:#76d5fa;"><center><strong>Імпорт груп з CSV</strong></center></h2>

            </div>

				<div class="row g-0  m-3">
                <div class="col-sm-6 col-md-8 text-start ">
                    <label >Оберіть CSV файл:</label>								
                <input type="file" name="csv_file" accept=".csv" required>
                </div>
                <div class="col-6 col-md-4  ">
                <p class="">
                <input type="submit" class="form-control bg-success" id="submit-form" name="submit_add_student" value="Додати" style="color:#0c0e0c; border: 2px solid #c1aaaa; margin-top:10px;">
                </p>        
                </div>
                </div>
                
                
                <div class="container my-5 text-start">

                <!-- Карта з інструкцією з імпорту даних -->
                    <div class="card" class="signup-page">
                    <div class="card-header text-black" data-toggle="collapse" data-target="#importHelp" aria-expanded="false" aria-controls="importHelp" style="background-color: #74daef;">
                        <h4 class="mb-0">Інструкція з імпорту даних через CSV</h4>
                    </div>
                    <div id="importHelp" class="collapse">
                        <div class="card-body">
                        <ol class="mb-3">
                            <li>
                            <strong>Підготовка CSV-файлу:</strong>
                            <ul>
                                <li>Створіть файл у форматі CSV з розширенням <code>.csv</code>.</li>
                                <li>В першому рядку вкажіть заголовки: <code class="text-wrap">s_pr s_im s_bat s_stat s_galuz s_spec s_specz s_group s_form_navch s_vip s_cours s_contract s_dnar s_vik s_adresa s_tels s_telb s_telm s_osvita_type s_rik_zaver s_region_type s_region</code>.</li>
                                <li>У наступних рядках розміщуйте дані студентів у відповідному порядку.</li>
                            </ul>
                            </li>
                            <li>
                            <strong>Завантаження файлу:</strong>
                            <ul>
                                <li>Клікніть кнопку для вибору файлу та знайдіть CSV-файл на вашому комп'ютері.</li>
                                <li>Переконайтеся, що файл має розширення <code>.csv</code>.</li>
                            </ul>
                            </li>
                            <li>
                            <strong>Запуск імпорту:</strong>
                            <ul>
                                <li>Після вибору файлу натисніть кнопку «Імпортувати».</li>
                                <li>Скрипт обробить файл та покаже повідомлення з кількістю успішно імпортованих та неімпортованих рядків.</li>
                            </ul>
                            </li>
                            <li>
                            <strong>Перевірка результатів:</strong>
                            <ul>
                                <li>Перегляньте результати імпорту. Якщо виникли помилки, перевірте формат даних і виправте їх у CSV-файлі.</li>
                            </ul>
                            </li>
                        </ol>
                        <p class="mb-0">
                            <em>Рекомендації:</em> завжди робіть резервне копіювання бази даних перед імпортом та перевіряйте формат і кодування CSV-файлу.
                        </p>
                        </div>
                    </div>
                    </div>

                    <!-- Карта з описом поширених помилок імпорту -->
                    <div class="card mt-4">
                <div class="card-header text-white" data-toggle="collapse" data-target="#errorsHelp" aria-expanded="false" aria-controls="errorsHelp"  style="background-color: #ff6161;">
                    <h4 class="mb-0">Найпоширеніші помилки при імпорті даних</h4>
                </div>
                <div id="errorsHelp" class="collapse">
                    <div class="card-body">
                    <ul>
                        <li>
                        <strong>Невідповідність структури файлу:</strong> кількість колонок у CSV не співпадає з очікуваннями бази даних.
                        </li>
                        <li>
                        <strong>Неправильний роздільник:</strong> дані можуть бути розділені не комами, а іншим символом (наприклад, крапкою з комою).
                        </li>
                        <li>
                        <strong>Проблеми з кодуванням:</strong> невідповідність кодування ( Windows-1251 ) може призвести до некоректного відображення символів. Збергіати файл потрібно у кодувані UTF-8
                        </li>
                        <li>
                        <strong>Неправильний формат даних:</strong> невірно відформатовані дати або числові значення можуть зупинити імпорт.
                        </li>
                        <li>
                        <strong>Дублювання даних або порушення унікальних обмежень:</strong> дублікати або конфлікти з унікальними значеннями можуть бути відхилені.
                        </li>
                        <li>
                        <strong>Порожні рядки або пропущені значення:</strong> відсутність даних у обов’язкових полях призводить до помилок.
                        </li>
                        <li>
                        <strong>Обмеження по розміру файлу:</strong> великі файли можуть перевищувати встановлені серверні обмеження.
                        </li>
                    </ul>
                    </div>
                </div>
                

            </div>
              <div class="container mt-4 text-start d-flex justify-content-center">
                <!-- Кнопка для завантаження файлу -->
                <a href="example/import_group.csv" download class="btn  btn-lg" style="background-color: #95fc93;">
                Скачати приклад CSV файлу
                </a>
            </div>
		</form>
    
    
  </div>



   
</body>
</html>
