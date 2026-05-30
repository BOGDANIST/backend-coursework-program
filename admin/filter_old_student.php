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
		
	
    // Серверсайдне збереження фільтрів видалено — фільтрація робиться через AJAX

    // Ініціалізація змінних (за замовчуванням порожні). Фільтри обробляються на клієнті/через AJAX.
    $filter_operation = '';
    $text_yer = '';
    $check_mp1 = $check_mp2 = $check_men = $check_women = '';
    $vik_from = $vik_to = '';

    $check_os1 = $check_os2 = $check_os3 = $check_os4 = '';
    $check_sirot = $check_peres = $check_chernob = $check_ivalid = $check_malozab = $check_ato = $check_uchbd = $check_ditzag = $check_stepver = $check_shaht = '';

    // Галузь знань
    $check_gz0 = $check_gz1 = $check_gz2 = $check_gz3 = $check_gz4 = $check_gz5 = '';

    // Спеціальність
    $spec = '';

    // Курс
    $check_kurs1 = $check_kurs2 = $check_kurs3 = $check_kurs4 = '';

    $form_group = '';
    $check_vg = '';

    $check_vz0 = $check_vz1 = '';
    $select_region = '';

    $limit = isset($_GET['limit']) && in_array((int)$_GET['limit'], [10, 25, 50, 100]) ? (int)$_GET['limit'] : 50;

    // Для сортування
    $sort_by = $_REQUEST['sort_by'] ?? '';
    $sort_dir = strtoupper($_REQUEST['sort_dir'] ?? 'ASC');

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
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        
        <!-- Template CSS -->
		<link rel="stylesheet" href="../css/my_style.css">
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





				
				<form id="filter-form" method="POST" style="display: contents;">
			       
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
						<button  class="form-control bg-danger fs-3" type="button" id="clear-filter" name="clear_search" style="margin-top:10px; border-radius:5px; color: #ffffff;">
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
                         <div id="results-table" class="table-responsive"></div>
                        <div class="tab-pane active in fade" id="faq">
                            <div class="panel-group" id="accordion">
                                               
												
	
							<!-- Вибір кількості записів на сторінці -->
				</div>
						<div class="container-fluid d-flex justify-content-end align-items-center ">

				<form method="GET" action="" >
					<label for="limit">Записів на сторінці:</label>
					<select name="limit" id="limit" onchange="AsyncRouter.filterOldStudents(document.getElementById('filter-form'), 1, this.value)">
						<?php foreach ([10, 25, 50, 100] as $opt): ?>
							<option value="<?php echo $opt; ?>" <?php if ($opt == $limit) echo 'selected'; ?>><?php echo $opt; ?></option>
						<?php endforeach; ?>
					</select>
					<input type="hidden" name="page" value="1">
				</form>
				<div id="pagination-container" style="margin-top: 20px;"></div>				
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
        <!-- Scripts -->
        <script src="assets/js/toast-notifications.js"></script>
        <script src="async.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submit-filter');
            const clearBtn = document.getElementById('clear-filter');
            const form = document.getElementById('filter-form');

			 AsyncRouter.filterOldStudents(form, 1, document.getElementById('limit') ? document.getElementById('limit').value : 50);
            // Submit filter
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    AsyncRouter.filterOldStudents(form, 1, document.getElementById('limit') ? document.getElementById('limit').value : 50);
                });
            }

            // Clear filters
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (form) form.reset();
                    AsyncRouter.clearFiltersFromLocalStorage();
                    const results = document.getElementById('results-table');
                    if (results) results.innerHTML = '';
                    const pag = document.getElementById('pagination-container');
                    if (pag) pag.innerHTML = '';
                    ToastNotification.info('Фільтри очищені');

					 AsyncRouter.filterOldStudents(form, 1, document.getElementById('limit') ? document.getElementById('limit').value : 50);
                });
            }

            const savedFilters = AsyncRouter.loadFiltersFromLocalStorage && AsyncRouter.loadFiltersFromLocalStorage();
            if (savedFilters && form) {
                AsyncRouter.applyFiltersToForm(form, savedFilters);
                AsyncRouter.filterOldStudents(form, 1, document.getElementById('limit') ? document.getElementById('limit').value : 50);
            }
        });
        </script>
</html>