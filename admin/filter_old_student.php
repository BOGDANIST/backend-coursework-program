	<?php
	session_start();

	if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer']))
	{   
		header("Location: admin_panel.php");
	}   
else
	{
	include ("../include/db_connect.php");
	error_reporting(0);
		
	
	    // Якщо користувач натиснув кнопку "Очистити", видаляємо фільтри в сесії 
    if (isset($_POST['clear_search'])) {
        $_SESSION['filters'] = [];
        $_SESSION['query_all'] = "1=1";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Якщо дані надійшли методом POST, повністю замінюємо дані фільтрів у сесії
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['clear_search'])) {
        $_SESSION['filters'] = $_POST;
    }

    // Ініціалізація змінних із сесії
    $filters = $_SESSION['filters'] ?? [];

	$filter_operation     = $filters['filter_operation'] ?? '';
    $text_yer     = $filters['text_yer'] ?? '';
    $check_mp1    = isset($filters['check_mp1']) ? 'checked' : '';
    $check_mp2    = isset($filters['check_mp2']) ? 'checked' : '';
    $check_men    = isset($filters['check_men']) ? 'checked' : '';
    $check_women  = isset($filters['check_women']) ? 'checked' : '';

    $vik_from     = $filters['vik_from'] ?? '';
    $vik_to       = $filters['vik_to'] ?? '';

    $check_os1    = isset($filters['check_os1']) ? 'checked' : '';
    $check_os2    = isset($filters['check_os2']) ? 'checked' : '';
    $check_os3    = isset($filters['check_os3']) ? 'checked' : '';
    $check_os4    = isset($filters['check_os4']) ? 'checked' : '';

    $check_sirot   = isset($filters['check_sirot']) ? 'checked' : '';
    $check_peres   = isset($filters['check_peres']) ? 'checked' : '';
    $check_chernob = isset($filters['check_chernob']) ? 'checked' : '';
    $check_ivalid  = isset($filters['check_ivalid']) ? 'checked' : '';
    $check_malozab = isset($filters['check_malozab']) ? 'checked' : '';
    $check_ato     = isset($filters['check_ato']) ? 'checked' : '';
    $check_uchbd   = isset($filters['check_uchbd']) ? 'checked' : '';
    $check_ditzag  = isset($filters['check_ditzag']) ? 'checked' : '';
    $check_stepver = isset($filters['check_stepver']) ? 'checked' : '';
    $check_shaht   = isset($filters['check_shaht']) ? 'checked' : '';

    // Галузь знань
    $check_gz0 = isset($filters['check_gz0']) ? 'checked' : '';
    $check_gz1 = isset($filters['check_gz1']) ? 'checked' : '';
    $check_gz2 = isset($filters['check_gz2']) ? 'checked' : '';
    $check_gz3 = isset($filters['check_gz3']) ? 'checked' : '';
    $check_gz4 = isset($filters['check_gz4']) ? 'checked' : '';
    $check_gz5 = isset($filters['check_gz5']) ? 'checked' : '';

    // Спеціальність
    $spec = isset($filters['spec']) ? 'checked' : '';

    // Курс
    $check_kurs1 = isset($filters['check_kurs1']) ? 'checked' : '';
    $check_kurs2 = isset($filters['check_kurs2']) ? 'checked' : '';
    $check_kurs3 = isset($filters['check_kurs3']) ? 'checked' : '';
    $check_kurs4 = isset($filters['check_kurs4']) ? 'checked' : '';

    $form_group  = $filters['form_group'] ?? '';
    $check_vg    = isset($filters['check_vg']) ? 'checked' : '';

    $check_vz0   = isset($filters['check_vz0']) ? 'checked' : '';
    $check_vz1   = isset($filters['check_vz1']) ? 'checked' : '';

    $select_region = $filters['select_region'] ?? '';

	$limit = isset($_GET['limit']) && in_array((int)$_GET['limit'], [10, 25, 50, 100]) ? (int)$_GET['limit'] : 50;

    // Для сортування
    $sort_by = $filters['sort_by'] ?? ($_REQUEST['sort_by'] ?? '');
    $sort_dir = strtoupper($filters['sort_dir'] ?? ($_REQUEST['sort_dir'] ?? 'ASC'));

	// Тепер ці змінні можна використовувати для підготовки форми та подальшої логіки



	echo '
	<script>
	function confirmSpelll() 
	{
		if (confirm("Ви підтверджуєте видалення?")) 
		{
			return true;
		} else 
		{
			return false;
		}
	}
	 
	</script>
	';
	if ($_GET["id_st"]!="")
		{$id =$_GET["id_st"];
			  
			$delete = mysqli_query($linc,"DELETE FROM old_student WHERE s_id='$id'");
			echo 'Видалено студента - '.$_GET["pr_st"].' '.$_GET["im_st"].' '.$_GET["bat_st"];  
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
		
        <!-- Template CSS -->
		<link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    
    </head>
   
    <div id="body-bg">
       <!-- Phone/Email -->

            <!-- End Phone/Email -->
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
			<?php include ("../include/adm_menu.php");?>
			 <?php include ("../include/background_icon.php");?>
            <!-- End Top Menu -->

            <!-- === END HEADER === -->

		   <!-- === BEGIN CONTENT === -->
			
    <div class="container-fluid col-11 bottom-border  ">
      <div class="row padding-top-40 d-flex align-content-center">
        <div class="col-md-12">
                         
           <!-- Block filter -->         
			<div class="block_search col-lg-3 shadow-lg" style="height:auto; background:rgba(29, 123, 105, 0.88); border: 3px solid rgba(62, 112, 135, 0.91); margin-left:10px; margin-top:10px; margin-bottom:14px; padding-bottom:10px;  color: #e5e5e5;">
				<h3 class="margin-bottom-6" style="margin-left:10px ; color: #8fd5e3; text-align: center;"><strong>Пошуковий фільтр</strong></h3>     
				
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
				box-shadow: 0 0 10px rgba(0,0,0,0.1);
				color: #000000;
				max-height: 300px;
				overflow-y: auto;
				}

				.dropdown-filter-item {
				padding: 5px 0;
				}
				</style>





				
				<form method="POST" action="">
			       
					<!-- Секція сортування -->
					<div id="block-search-sort" class="mb-3 fs-3">
						<label for="sort_by" class="form-label ms-1"><strong>Сортувати за: </strong></label>
						<select name="sort_by" id="sort_by" class="form-select w-auto d-inline-block fs-5">
							<option value="">-- не сортувати --</option>
							<option value="s_pr" <?= ($sort_by=='s_pr') ? 'selected' : '' ?>>Прізвищем</option>
							<option value="s_group" <?= ($sort_by=='s_group') ? 'selected' : '' ?>>Групою</option>
							<option value="s_cours" <?= ($sort_by=='s_cours') ? 'selected' : '' ?>>Курсом</option>
							<option value="s_dnar" <?= ($sort_by=='s_dnar') ? 'selected' : '' ?>>Роком народження</option>
							<option value="operation_date" <?= ($sort_by=='operation_date') ? 'selected' : '' ?>>Датою додавання</option>
							<option value="operation_name" <?= ($sort_by=='operation_name') ? 'selected' : '' ?>>Тип операції</option>
						</select>
					</div>

					<div id="block-search-sort" class="mb-3 fs-3">
						  <label for="filter_operation" class="form-label ms-1"><strong>Фільтр типу операції:</strong></label>
						<select name="filter_operation" id="filter_operation" class="form-select w-auto d-inline-block fs-5">
							<option value="">-- всі --</option>
							<option value="Випущений/а" <?= ($filter_operation=='Випущений/а') ? 'selected' : '' ?>>Випущений/а</option>
							<option value="Відрахований/а" <?= ($filter_operation=='Відрахований/а') ? 'selected' : '' ?>>Відрахований/а</option>
							<option value="Пішов/ла в академ відпустку" <?= ($filter_operation=='Пішов/ла в академ відпустку') ? 'selected' : '' ?>>Пішов/ла в академ відпустку</option>
							<option value="Видалено із бази даних" <?= ($filter_operation=='Видалено із бази даних') ? 'selected' : '' ?>>Видалено із бази даних</option>
							<option value="Інша причина" <?= ($filter_operation=='Інша причина') ? 'selected' : '' ?>>Інша причина</option>
						</select>
					</div>	


						<div id="block-search-sort" class="mb-3 fs-3">
						<label for="sort_dir" class="form-label ms-1"><strong>Порядок: </strong></label>
						<select name="sort_dir" id="sort_dir" class="form-select w-auto d-inline-block fs-5">
						
							<option value="ASC" <?= ($sort_dir=='ASC') ? 'selected' : '' ?>>від A до Я (зростання)</option>
							<option value="DESC" <?= ($sort_dir=='DESC') ? 'selected' : '' ?>>від Я до A (спадання)</option>
						</select>
						</div>


					<div class="dropdown dropdown-filter-wrapper mb-3">
					<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownVzMenu" aria-expanded="false" aria-controls="dropdownVzMenu">
						Вид замовлення
					</button>

					<div id="dropdownVzMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
						<ul class="list-unstyled m-0">
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_vz0" value="Ні" <?= $check_vz0 ?>> навч. за регіон. замовл.</label></li>
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_vz1" value="Так" <?= $check_vz1 ?>> навч. за кошти фіз. або юридич. осіб</label></li>
						</ul>
					</div>
					</div>


					
					<div class="dropdown dropdown-filter-wrapper mb-3">
					<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" 
							type="button" data-bs-toggle="collapse" data-bs-target="#dropdownGzMenu" 
							aria-expanded="false" aria-controls="dropdownGzMenu">
						Галузь знань
					</button>
					<div id="dropdownGzMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
						<ul class="list-unstyled m-0">
						<?php
					
						
						// Отримуємо масив вибраних значень із форми (якщо вони передачені POST-ом)
						$selected = isset($_POST['check_gz']) ? $_POST['check_gz'] : array();


						$gz_query = "SELECT DISTINCT im_galuz AS gz FROM spec ORDER BY im_galuz ASC";
						$gz_result = mysqli_query($linc, $gz_query);
						if ($gz_result) {
							while ($row_gz = mysqli_fetch_assoc($gz_result)) {
								$value = htmlspecialchars($row_gz['gz']);
								// Якщо вибране значення міститься у масиві $selected – встановлюємо checked
								$isChecked = in_array($value, $selected) ? 'checked' : '';
								echo '<li class="dropdown-gz-item">
										<label>
											<input type="checkbox" name="check_gz[]" value="' . $value . '" ' . $isChecked . '> ' . $value . '
										</label>
										</li>';
							}
						}
						?>
						</ul>
					</div>
					</div>


					<div class="dropdown dropdown-filter-wrapper mb-3">
					<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownSpecialtyMenu" aria-expanded="false" aria-controls="dropdownGzMenu">
						Спеціальність
					</button>
					<div id="dropdownSpecialtyMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
						<ul class="list-unstyled m-0">
						<?php
						

						// Отримання масиву вибраних спеціальностей із форми
						$selected = isset($_POST['check_sp']) ? $_POST['check_sp'] : array();

						// Запит для отримання унікальних спеціальностей.
						// Припускаємо, що потрібне значення – це поле im_spec (замість CONCAT, якщо лише одне поле)
						$spec_query = "SELECT DISTINCT im_spec AS spec FROM spec ORDER BY id_spec ASC";
						$spec_result = mysqli_query($linc, $spec_query);
						if ($spec_result) {
							while ($row_spec = mysqli_fetch_assoc($spec_result)) {
								$spec = htmlspecialchars($row_spec['spec']);
								// Якщо ця спеціальність була вибрана, додаємо checked
								$isChecked = in_array($spec, $selected) ? 'checked' : '';
								echo '<li class="dropdown-specialty-item">
										<label>
											<input type="checkbox" name="check_sp[]" value="' . $spec . '" ' . $isChecked . '> ' . $spec . '
										</label>
										</li>';
							}
						}
						?>
						</ul>
					</div>
					</div>



					
					<div class="dropdown dropdown-filter-wrapper mb-3">
					<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownCourseMenu" aria-expanded="false" aria-controls="dropdownCourseMenu">
						Курс
					</button>

					<div id="dropdownCourseMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
						<ul class="list-unstyled m-0">
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_kurs1" value="1" <?= $check_kurs1 ?>> I курс</label></li>
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_kurs2" value="2" <?= $check_kurs2 ?>> II курс</label></li>
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_kurs3" value="3" <?= $check_kurs3 ?>> III курс</label></li>
						<li class="dropdown-filter-item"><label><input type="checkbox" name="check_kurs4" value="4" <?= $check_kurs4 ?>> IV курс</label></li>
						</ul>
					</div>
					</div>

						<!-- ОСВІТА -->

						<div class="dropdown dropdown-filter-wrapper mb-3">
						<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownOsvitaMenu" aria-expanded="false" aria-controls="dropdownOsvitaMenu">
							Освіта
						</button>

						<div id="dropdownOsvitaMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
							<ul class="list-unstyled m-0"><label> 
							<li class="dropdown-filter-item"><input type="checkbox" name="check_os1" value="Базова загальна середня освіта" <?= isset($check_os1) && $check_os1 ? 'checked' : '' ?> style="margin:0px;">Базова загальна середня освіта</li>
							<li class="dropdown-filter-item"><input type="checkbox" name="check_os2" value="Повна загальна середня освіта" <?= isset($check_os2) && $check_os2 ? 'checked' : '' ?> style="margin:0px;">Повна загальна середня освіта</li>
							<li class="dropdown-filter-item"><input type="checkbox" name="check_os3" value="Молодший спеціаліст" <?= isset($check_os3) && $check_os3 ? 'checked' : '' ?> style="margin:0px;">Молодший спеціаліст</li>
							<li class="dropdown-filter-item"><input type="checkbox" name="check_os4" value="Кваліфікований робітник" <?= isset($check_os4) && $check_os4 ? 'checked' : '' ?> style="margin:0px;">Кваліфікований робітник</li>
							</label>
						</ul>
						</div>
						</div>
					
						
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong></strong></p>

						<?php
						$query_group = mysqli_query($linc, "SELECT * FROM old_st_group GROUP BY g_im");

						echo '<div class="mb-3 fs-3">';
						echo '<label for="form_group" class="form-label fs-3">Оберіть групу</label>';
						echo '<select class="form-select fs-4" name="form_group" id="form_group">';

						echo '<option value="">-- Виберіть групу --</option>';

						while ($temp = mysqli_fetch_assoc($query_group)) {
							$selected = ($form_group == $temp['g_im']) ? 'selected' : '';
							echo '<option value="' . htmlspecialchars($temp['g_im']) . '" ' . $selected . '>' . htmlspecialchars($temp['g_im']) . '</option>';
						}

						echo '</select>';
						echo '</div>';
						?>

					</div>

					<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_vg" value="Так" <?= $check_vg ?> style="margin:0px;"> випускна група</li>
					</ul>
					</div>

						
						<!-- СТАТЬ -->
						<div id="block-search-left">
						<div id="block-category">
							<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Стать:</strong></p>
							<ul id="ul-category" style="columns: 2; list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
							<li><input type="checkbox" name="check_men" value="Чоловік" <?= $check_men ?> style="margin:0px;"> чоловік</li>
							<li><input type="checkbox" name="check_women" value="Жінка" <?= $check_women ?> style="margin:0px;"> жінка</li>
							</ul>
						</div>
						</div>

						<!-- ВІК -->
						<div id="block-search-left">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Вік</strong></p>
						<div id="block-category">
							<label style="font-size: 15px;">від</label>
							<input type="number" name="vik_from" value="<?= htmlspecialchars($vik_from) ?>" style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
							<label style="font-size: 15px;">до</label>
							<input type="number" name="vik_to" value="<?= htmlspecialchars($vik_to) ?>" style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
							<label style="font-size: 15px;">років</label>
						</div>
						</div>

						


					<!-- РІК ЗАВЕРШЕННЯ ШКОЛИ -->
					<div id="block-search-left">
					<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Рік завершення школи</strong></p>
					<div id="block-category">
						<label style="font-size: 15px;">Рік</label>
						<input type="text" name="text_yer" value="<?= htmlspecialchars($text_yer) ?>" style="width:50px; height: 25px; background:white; font-size: 15px;margin-top:5px; margin-bottom:5px; border:1px solid #cccccc; color:#030303;">
					</div>
					</div>

					<!-- ПРОЖИВАННЯ -->
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Проживання:</strong></p>
						<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_mp1" value="Місто" <?= $check_mp1 ?> style="margin:0px;">місто</li>
						<li><input type="checkbox" name="check_mp2" value="Сільська місцевість" <?= $check_mp2 ?> style="margin:0px;">сільська місцевість</li>
						</ul>
					</div>
					</div>
				
					<div class="dropdown dropdown-filter-wrapper mb-3">
					<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownRegionMenu" aria-expanded="false" aria-controls="dropdownRegionMenu">
						Область проживання
					</button>

					<div id="dropdownRegionMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
						<ul class="list-unstyled m-0">
						<?php
						$regions = [
							"Вінницька", "Волинська", "Дніпропетровська", "Донецька", "Житомирська",
							"Закарпатська", "Запорізська", "Івано-Франківська", "Київська", "Кіровоградська",
							"Луганська", "Львівська", "Миколаївська", "Одеська", "Полтавська",
							"Рівненська", "Сумська", "Тернопільська", "Харкіська", "Херсонська",
							"Хмельницька", "Черкаська", "Чернівецька", "Чернігівська", "АР Крим"
						];

						foreach ($regions as $region) {
							$checked = ($select_region === $region) ? 'checked' : '';
							echo '<li class="dropdown-filter-item"><label>';
							echo '<input type="radio" name="select_region" value="' . htmlspecialchars($region) . '" ' . $checked . '> ' . htmlspecialchars($region);
							echo '</label></li>';
						}
						?>
						</ul>
					</div>
					</div>


					
					<div id="block-search-left">
					<div id="block-category">
						<div class="dropdown dropdown-filter-wrapper mb-3">
						<button class="btn btn-outline-secondary dropdown-toggle dropdown-filter-btn w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownSocialMenu" aria-expanded="false" aria-controls="dropdownSocialMenu">
							Соціальна категорія
						</button>

						<div id="dropdownSocialMenu" class="collapse dropdown-filter-menu border rounded p-3 mt-2" style="font-size: 15px;">
							<ul class="list-unstyled m-0">
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_sirot" value="Так" <?= $check_sirot ?>> діти-сироти та діти позбавлені батьківського піклування</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_peres" value="Так" <?= $check_peres ?>> переселенці</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_chernob" value="Так" <?= $check_chernob ?>> чорнобильці</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_ivalid" value="Так" <?= $check_ivalid ?>> інваліди</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_malozab" value="Так" <?= $check_malozab ?>> малозабезпечені</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_ato" value="Так" <?= $check_ato ?>> діти учасників АТО</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_uchbd" value="Так" <?= $check_uchbd ?>> учасники бойових дій та їх діти</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_ditzag" value="Так" <?= $check_ditzag ?>> діти загиблих майданівців</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_stepver" value="Так" <?= $check_stepver ?>> стипендіати Верховної ради</label></li>
							<li class="dropdown-filter-item"><label><input type="checkbox" name="check_shaht" value="Так" <?= $check_shaht ?>> шахтарі і діти шахтарів</label></li>
							</ul>
						</div>
						</div>

					</div>
					</div>

		<div  style=" border-top:2px solid #cccccc; margin-bottom:0px; margin-top: 10px;">
                        <input class="col-4 form-control bg-success fs-3" type="submit" name="submit_search" id="submit-filter" value="Пошук" style="margin-top:10px; border-radius:5px;color: #ddfff0;"/>
						<button  class="form-control bg-danger fs-3" type="submit" name="clear_search" style="margin-top:10px; border-radius:5px; color: #ffffff;">
						Очистити
						</button>					   
						<button class="col-6 form-control fs-3" type="submit" name="download_excel" value="yes" formaction="test\search_excel.php" style="background-color: #d9d368; margin-top:10px; border-radius:5px; color: #000000;">Завантажити Excel</button>

		</div>
			 </form>
             
			 </div>
              <!-- End Block filter -->
			
	<!-- Block list -->
			<div class="row">
                 <div class="col-md-12" style="margin-top:10px;">
                     <div class="tab-content ">
                        <div class="tab-pane active in fade" id="faq">
                            <div class="panel-group" id="accordion">
                                               
												
	<?php  
	
	//Формування запиту
	if($_POST["submit_search"])
	{ $query_all='';
		
		//Вид замовлення
		$vz='';
						$check_vz0=$_POST ["check_vz0"];
				 		$check_vz1=$_POST ["check_vz1"];
						
						if($check_vz0!="")
							{$query_vz0="'".$check_vz0."'";
							 $vz=",";
							 }
						
						if($check_vz1!="")$query_vz1=$vz."'".$check_vz1."'";

						if($check_vz0=="" and  $check_vz1=="")
						{$query_vz="s_contract IN('Так','Ні','')";}
				         else {$query_vz="s_contract IN(".$query_vz0.$query_vz1.")";
						 }				 
		
		//Галузь знань
		$gz='';
		$selectedGz = isset($_POST['check_gz']) ? $_POST['check_gz'] : array();

		// Якщо нічого не вибрано – витягуємо всі унікальні значення із бази
		if (empty($selectedGz)) {
			$allGz = array();
			$gz_query_all = "SELECT DISTINCT s_galuz AS gz FROM old_student ORDER BY s_galuz ASC";
			$result_all = mysqli_query($linc, $gz_query_all);
			if ($result_all) {
				while ($row = mysqli_fetch_assoc($result_all)) {
					$allGz[] = $row['gz'];
				}
			}
			$selectedGz = $allGz;
		}

		// Екрануємо значення та формуємо список для SQL‑умови
		$escapedGz = array();
		foreach ($selectedGz as $gz) {
			$escapedGz[] = "'" . mysqli_real_escape_string($linc, $gz) . "'";
		}

		// Фінальна SQL умова для галузей знань
		$query_gz = " AND s_galuz IN(" . implode(',', $escapedGz) . ")";
		//echo $query_gz;


		
		///////Спеціальність
		$sp='';
		$selected_specs = isset($_POST['check_sp']) ? $_POST['check_sp'] : array();

		// Якщо нічого не вибрано, беремо всі спеціальності з бази
		if (empty($selected_specs)) {
			$all_specs = array();
			$spec_query = "SELECT DISTINCT CONCAT( im_spec) AS spec FROM spec ORDER BY id_spec ASC";
			$spec_result = mysqli_query($linc, $spec_query);
			if ($spec_result) {
				while ($row = mysqli_fetch_assoc($spec_result)) {
					$all_specs[] = $row['spec'];
				}
			}
			// Тепер якщо нічого не вибрано, беремо умовно всі спеціальності як вибрані
			$selected_specs = $all_specs;
		}

		// Екрануємо значення та формуємо рядок для SQL IN(...)
		$escaped_specs = array();
		foreach ($selected_specs as $spec) {
			$escaped_specs[] = "'" . mysqli_real_escape_string($linc, $spec) . "'";
		}

		// Формуємо фінальний рядок для додавання до SQL-запиту
		$query_sp = " AND s_spec IN(" . implode(',', $escaped_specs) . ")";

		// Для перевірки можна вивести $query_sp, наприклад:
		//echo $sp;



		//Курс
		$sk='';
						$check_sk1=$_POST ["check_kurs1"];
						$check_sk2=$_POST ["check_kurs2"];
						$check_sk3=$_POST ["check_kurs3"];
						$check_sk4=$_POST ["check_kurs4"];
						if($check_sk1=="1")
							{$query_sk1="'".$check_sk1."'";
							 $sk=',';}
						if($check_sk2=="2")
							{$query_sk2=$sk."'".$check_sk2."'";
							 $sk=",";}
						if($check_sk3=="3")
							{$query_sk3=$sk."'".$check_sk3."'";
						     $sk=",";}
						if($check_sk4=="4") $query_sk4=$sk."'".$check_sk4."'";
						if($check_sk1=="" and  $check_sk2=="" and  $check_sk3=="" and  $check_sk4=="")
						{$query_sk=" AND s_cours IN('1','2','3','4')";}
						else $query_sk=" AND s_cours IN(".$query_sk1.$query_sk2.$query_sk3.$query_sk4.")";
						
		//Випускна група
					
						$check_vg=$_POST ["check_vg"];
						if($check_vg=="Так") $query_vg=" AND s_vip IN('Так')";
						else $query_vg=" AND s_vip IN('Так','Ні','')";
							 
		//Стать
		$st='';
						$check_men=$_POST ["check_men"];
				 		$check_women=$_POST ["check_women"];
						
						if($check_men=="Чоловік")
							{$query_st0="'".$check_men."'";
							 $st=",";
							 }
						
						if($check_women=="Жінка")$query_st1=$st."'".$check_women."'";

						if($check_men=="" and  $check_women=="")
						{$query_st=" AND s_stat IN('Чоловік','Жінка')";}
				         else {$query_st=" AND s_stat IN(".$query_st0.$query_st1.")";
						 }			
	
		//Освіта
		$os='';
						//echo $check_os1=$_POST ["check_os1"];
				 		//echo $check_os2=$_POST ["check_os2"];
						 $check_os1 = isset($_POST["check_os1"]) ? $_POST["check_os1"] : "";
						$check_os2 = isset($_POST["check_os2"]) ? $_POST["check_os2"] : "";
						$check_os3 = isset($_POST["check_os3"]) ? $_POST["check_os3"] : "";
						 $check_os4 = isset($_POST["check_os4"]) ? $_POST["check_os4"] : "";

						$query_os1 = "";
						$query_os2 = "";
						$query_os3 = "";
						$query_os4 = "";

						if ($check_os1 == "Базова загальна середня освіта") {
							$query_os1 = "'".$check_os1."','Базова середня освіта'";
						}

						if ($check_os2 == "Повна загальна середня освіта") {
							$query_os2 = ($query_os1 ? "," : "") . "'".$check_os2."','Повна середня освіта'";
						}

						if ($check_os3 == "Молодший спеціаліст") {
							$query_os3 = "'".$check_os3."'";
						}
						if ($check_os4 == "Кваліфікований робітник") {
							$query_os4 = "'".$check_os4."'";
						}
						if (empty($check_os1) && empty($check_os2)&& empty($check_os3)&& empty($check_os4)) {
							$query_os = "";
							//$query_os = " AND s_osvita_type IN('Базова загальна середня освіта','Повна загальна середня освіта','Базова середня освіта','Повна середня освіта')";
						} else {
							$query_os = " AND s_osvita_type IN(".$query_os1.$query_os2.$query_os3.$query_os4.")";
						}
		
		//Вік
					
					//	echo $text_vik=$_POST ["text_vik"];
						if($text_vik!="") 
						{$query_vik0="'".$text_vik."'";
						$query_vik=" AND s_vik IN(".$query_vik0.")";
						}
						else $query_vik="";
						
		//Рік завершення школи
				
					//	echo $text_yer=$_POST ["text_yer"];
						if($text_yer!="") 
						{$text_yer0="'".$text_yer."'";
						$query_yer=" AND s_rik_zaver IN(".$text_yer.")";
						}
						else $query_yer="";
		
		//Місце проживання
				$mp='';
						$check_mp1=$_POST ["check_mp1"];
				 		$check_mp2=$_POST ["check_mp2"];
						
						if($check_mp1=="Місто")
							{$query_mp1="'".$check_mp1."'";
							 $mp=",";
							 }
						
						if($check_mp2=="Сільська місцевість") {$query_mp2=$mp."'".$check_mp2."' ,'Село'";}

						if($check_mp1=="" and  $check_mp2=="")
						{$query_mp=" AND s_region_type IN('Місто','Сільська місцевість','Село')";}
				         else {
							 $query_mp=" AND s_region_type IN(".$query_mp1.$query_mp2.")";
						 }	

						if (!empty($select_region)) {
							$query_region = " AND s_region = '" . mysqli_real_escape_string($linc, $select_region) . "'";
						} else {
							$query_region = ""; // якщо область не вибрана — не фільтруємо
						}
		
						// Дитина-сирота
				$check_sirot = $_POST["check_sirot"] ?? "";
				$query_sirot = ($check_sirot == "Так") ? " AND s_sirota IN ('Так')" : "";

				// Збираємо умови для соціальних категорій
				$social_conditions = [];

				if (isset($_POST["check_sirot"]) && $_POST["check_sirot"] === "Так") {
					$social_conditions[] = "s_sirota = 'Так'";
				}
				if (isset($_POST["check_peres"]) && $_POST["check_peres"] === "Так") {
					$social_conditions[] = "s_peresel = 'Так'";
				}
				if (isset($_POST["check_chernob"]) && $_POST["check_chernob"] === "Так") {
					$social_conditions[] = "s_chernob = 'Так'";
				}
				if (isset($_POST["check_ivalid"]) && $_POST["check_ivalid"] === "Так") {
					$social_conditions[] = "s_inval = 'Так'";
				}
				if (isset($_POST["check_malozab"]) && $_POST["check_malozab"] === "Так") {
					$social_conditions[] = "s_malozab = 'Так'";
				}
				if (isset($_POST["check_ato"]) && $_POST["check_ato"] === "Так") {
					$social_conditions[] = "s_ato = 'Так'";
				}
				if (isset($_POST["check_uchbd"]) && $_POST["check_uchbd"] === "Так") {
					$social_conditions[] = "s_war_act = 'Так'";
				}
				if (isset($_POST["check_ditzag"]) && $_POST["check_ditzag"] === "Так") {
					$social_conditions[] = "s_ditzag = 'Так'";
				}
				if (isset($_POST["check_stepver"]) && $_POST["check_stepver"] === "Так") {
					$social_conditions[] = "s_rada = 'Так'";
				}
				if (isset($_POST["check_shaht"]) && $_POST["check_shaht"] === "Так") {
					$social_conditions[] = "s_shahter = 'Так'";
				}

				if (!empty($social_conditions)) {
					// Об'єднуємо умови через OR й заносимо їх у групу
					$query_social = " AND (" . implode(" OR ", $social_conditions) . ")";
				} else {
					$query_social = "";
				}


				///По групі
				$check_group = $_POST["form_group"] ?? "";
				$query_group = ($check_group != "") ? " AND s_group = '" . mysqli_real_escape_string($linc, $check_group) . "'" : "";

				///Вік
				$vik_from = $_POST["vik_from"] ?? '';
				$vik_to   = $_POST["vik_to"] ?? '';
				$query_vik = "";

				// Перевірка, чи введені числа
				if ($vik_from !== '' && $vik_to !== '') {
					$query_vik = " AND s_vik BETWEEN " . intval($vik_from) . "  AND " . intval($vik_to);
				} elseif ($vik_from !== '') {
					$query_vik = "  AND s_vik >= " . intval($vik_from). " ";
				} elseif ($vik_to !== '') {
					$query_vik = " AND s_vik <= " . intval($vik_to). " "	;
				}


				// Сортування
				$sort_by = $_REQUEST['sort_by'] ?? '';
				$sort_dir = strtoupper($_REQUEST['sort_dir'] ?? 'ASC');

				$allowed_sorts = ['s_pr', 's_group', 's_cours', 's_dnar', 'operation_date', 'operation_name'];
				$allowed_dirs = ['ASC', 'DESC'];
				$order_clause = '';
	
				if (in_array($sort_by, $allowed_sorts) && in_array($sort_dir, $allowed_dirs)) {
					if ($sort_by === 's_cours') {
						// Приведення s_cours до числового значення для правильного сортування
						$order_clause = " ORDER BY CAST(s_cours AS UNSIGNED) $sort_dir ";
					} elseif ($sort_by === 's_dnar') {
						// Якщо потрібно сортувати віком шляхом перетворення, використовуйте відповідну логіку
						$order_clause = " ORDER BY CAST(s_vik AS UNSIGNED) $sort_dir ";
					} elseif ($sort_by === 'operation_date') {
						$order_clause = " ORDER BY operation_date $sort_dir ";
					} elseif ($sort_by === 'operation_name') {
						$order_clause = " ORDER BY operation_name $sort_dir ";
					} else {
						$order_clause = " ORDER BY $sort_by COLLATE utf8_unicode_ci $sort_dir ";
					}
				}
				
				// Додаємо умову фільтра operation_name
				$where_filter = "";
				if ($filter_operation !== "") {
					$filter_safe = mysqli_real_escape_string($linc, $filter_operation);
					$where_filter = " AND operation_name IN ('$filter_safe') ";
				}

	 $query_all = 
	 $query_vz . $query_gz . $query_sp . $query_sk . $query_vg . $query_st . $query_os  . $query_yer . $query_mp .
	$query_sr . $query_sirot . $query_peres . $query_chernob . $query_ivalid . $query_malozab . $query_ato .
	$query_uchbd . $query_ditzag . $query_stepver . $query_shaht . $query_group . $query_vik . $where_filter. $query_region . $query_social . $order_clause;

		 $query_all;
	session_start();
	$_SESSION['query_all'] = $query_all;

	$result_to_xlsx = "SELECT * FROM old_student WHERE $query_all";
	$_SESSION['result_to_xlsx'] = $result_to_xlsx;	
			}
	$i=1;
	$query_all = $_SESSION['query_all'];
	$result_searh = mysqli_query($linc, "SELECT * FROM old_student WHERE $query_all");
		

	
// Визначаємо кількість записів на сторінку


// Якщо номер сторінки передається GET-параметром, використовуємо його; якщо ні — перша сторінка
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

// Обчислюємо зсув (offset)
$offset = ($page - 1) * $limit;

// Якщо фільтр було застосовано, він має бути в $_SESSION['query_all']
// Якщо ні — встановлюємо фільтрацію за замовчуванням, напр., "1=1"
if (!isset($_SESSION['query_all']) || $_SESSION['query_all'] == '') {
    $_SESSION['query_all'] = "1=1";
}
$query_all = $_SESSION['query_all'];

// Спочатку отримуємо загальну кількість записів за умовою
$query_count = "SELECT COUNT(*) as total FROM old_student WHERE $query_all";
$result_count = mysqli_query($linc, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total = $row_count['total'];
$totalPages = ceil($total / $limit);

// Отримуємо лише потрібну частину записів за умовою з пагінацією
$query_with_limit = "SELECT * FROM old_student WHERE $query_all LIMIT $offset, $limit";
$result_searh = mysqli_query($linc, $query_with_limit);

if (mysqli_num_rows($result_searh) == 0) {
    echo '<h3 class="margin-bottom" style="margin-left:0px; text-align:center; color:#56693c;"><strong>Пошук не дав результатів</strong></h3>';
} else {
    echo '<h3 class="margin-bottom" style="margin-left:0px; text-align:center; color:#56693c;"><strong>Результат виконання запиту: знайдено ' . $total . ' студентів</strong></h3>';
    echo '<div class="col-md-12 ">
            <table class="table table-primary mx-auto rounded-1 table-striped  table-responsive-md fs-3 fs-sm-1">';
    
    $i = $offset + 1;
    while ($row = mysqli_fetch_array($result_searh)) {
        echo '<tr>
                <td style="white-space: nowrap;"><strong>' . $i . '</strong></td>
				<td class="col-md-2 white-space: nowrap; fs-4 text-center align-middle "><strong>' . $row['operation_name'] . '</strong></td>
                <td class="col-md-2"><strong>' . $row['s_pr'] . '</strong></td>
                <td class="col-md-2"><strong>' . $row['s_im'] . '</strong></td>
                <td class="col-md-2"><strong>' . $row['s_bat'] . '</strong></td>
                <td class="text-center" style="white-space: nowrap;"><strong>' . $row['s_group'] . '</strong></td>
                <td style="white-space: nowrap;" class=" text-center"><strong>курс &nbsp' . $row['s_cours'] . '</strong></td>
                <td class="text-center" style="text-decoration-line: underline; padding-left:5px; width: 250px;">
                    <strong>
                        <a href="view_old_student.php?id_st=' . $row["s_id"] . '">Перегляд</a> 
                       	 ';
                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                echo ' 
								';
                            }
                            
                            echo '
                    </strong>
                </td>
             </tr>';
        $i++;
    }
    echo '</table></div>';
    
    // Вивід пагінації
	echo '<div class="container-fluid d-flex justify-content-center align-items-center ">';

    echo '<nav aria-label="Сторінкова навігація"  >';
    echo '<ul class="pagination justify-content-center "  >';
    
    // Посилання "Попередня"
    if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo; Попередня</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">&laquo; Попередня</span></li>';
    }
    
    // Виводимо посилання для кожної сторінки (можна використовувати оптимізацію, якщо сторінок дуже багато)

	for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo '<li class="page-item ' . $active . '">
        <a class="page-link" href="?page=' . $i . '&limit=' . $limit . '">' . $i . '</a>
    </li>';
}
    
    // Посилання "Наступна"
    if ($page < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Наступна &raquo;</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">Наступна &raquo;</span></li>';
    }
    
    echo '</ul>';
    echo '</nav>
	</div>';
}
	 


	?>   
							<!-- Вибір кількості записів на сторінці -->
				<div class="container-fluid d-flex justify-content-end align-items-center ">

				<form method="GET" action="" >
					<label for="limit">Записів на сторінці:</label>
					<select name="limit" id="limit" onchange="this.form.submit()">
						<?php foreach ([10, 25, 50, 100] as $opt): ?>
							<option value="<?php echo $opt; ?>" <?php if ($opt == $limit) echo 'selected'; ?>><?php echo $opt; ?></option>
						<?php endforeach; ?>
					</select>
					<input type="hidden" name="page" value="1">
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
	<!--End Block list -->  
	<!-- Footer -->        
 	<?php include ("../include/footer.php");?>

 
 <body>
</html>