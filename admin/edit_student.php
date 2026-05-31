<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
	header("Location: admin_panel.php");
} else {
	include("../include/db_connect.php");
	error_reporting(0);

	$id_st = $_GET["id_st"];
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
	<!-- Toast Notifications CSS -->
	<link rel="stylesheet" href="assets/css/toast-notifications.css">
	<!-- Google Fonts-->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

<body>
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
						<a href="index.html" title="">
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


		<!-- === BEGIN CONTENT === -->

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
										<div class="signup-header">
											<p class="fs-1" style="color:#ecf6ff; text-align: center;"><strong>Перегляд
													та редагування даних про студента</strong></p>
										</div>
										<?php
										$result = mysqli_query($linc, "SELECT * FROM student WHERE s_id='$id_st'");
										if (mysqli_num_rows($result) > 0) {
											$row = mysqli_fetch_array($result);
											do {
												//echo print_r($row, true);
												echo '
                               <label><strong>Прізвище</strong></label>
								<strong> <input type="text" class="form-control" name="form_pr_stud" value="' . $row['s_pr'] . '" style="background:white; color:#0c0e0c; border:none;"  ></strong>

								<label><strong><strong>Ім"я</strong></label>
								 <input type="text" class="form-control" name="form_im_stud" value="' . $row['s_im'] . '" style="background:white; color:#0c0e0c; border:none;"  >

								<label><strong>По батькові</strong></label>
								 <input type="text" class="form-control" name="form_bat_stud" value="' . $row['s_bat'] . '" style="background:white; color:#0c0e0c; border:none;"  >

								<label><strong>Стать</strong></label>
								 <input type="text" class="form-control" name="form_sex" value="' . $row['s_stat'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								<select class="form-control"  name="form_stat_select" size="2" style="background:white; color:#0c0e0c;">
									<option value="Чоловік">Чоловік</option>
									<option value="Жінка">Жінка</option>
								  </select>

								<label><strong>Дата народження</strong></label>
								 <input type="date" class="form-control" name="form_date_nar" value="' . $row['s_dnar'] . '" style="background:white; color:#0c0e0c; border:none;" >

								<label><strong>Група</strong></label>
								<input type="text" class="form-control" name="form_group" value="' . $row['s_group'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								';

												$query_group = mysqli_query($linc, "SELECT * FROM st_group");
												echo '<select class="form-control" name="form_group" size="5" style="color:#0c0e0c;">';
												echo '<option value=""></option>';
												while ($temp = mysqli_fetch_assoc($query_group)) {
													echo '<option style="color:#0c0e0c;" value=' . $temp['g_im'] . '>' . $temp['g_im'] . '</option>';
												}
												echo '</select>

									<label><strong>Навчання за регіональним замовленням</strong></label>
									<input type="text" class="form-control" name="form_zamovl_stud" value="' . $row['s_contract'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								  <select class="form-control"  name="form_zamovl" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>

									<label><strong>Рік завершення школи</strong></label>
									<input type="text" class="form-control" name="form_zscool" value="' . $row['s_rik_zaver'] . '" style="background:white; color:#0c0e0c; border:none;"  >


									<label> <strong>Освіта</strong></label>
								    <input type="text" class="form-control" name="form_osvita_stud" value="' . $row['s_osvita_type'] . '" style="background:white; color:#0c0e0c; border:none;"  >
								  <select class="form-control"  name="form_osvita" size="3" style="background:white; color:#0c0e0c;">

										<option value="Базова загальна середня освіта">Базова загальна середня освіта</option>
										<option value="Повна загальна середня освіта">Повна загальна середня освіта</option>
										<option value="Молодший спеціаліст">Молодший спеціаліст</option>
										<option value="Кваліфікований робітник">Кваліфікований робітник</option>

									  </select>

										<label> <strong>Регіон проживання</strong></label>
									    <input type="text" class="form-control" name="form_reg_type_stud" value="' . $row['s_region_type'] . '" style="background:white; color:#0c0e0c; border:none;"  >
									  <select class="form-control"  name="form_reg_type" size="2" style="background:white; color:#0c0e0c;">
										<option value="Місто">Місто</option>
										<option value="Сільська місцевість">Сільська місцевість</option>
									  </select>

									  <label> <strong>Область проживання</strong></label>
									    <input type="text" class="form-control" name="form_region_stud" value="' . $row['s_region'] . '" style="background:white; color:#0c0e0c; border:none;"  >

									  <select class="form-control" name="form_region" size="8" style="background:white; color:#0c0e0c;">
										<option value="Вінницька">Вінницька</option>
										<option value="Волинська">Волинська</option>
										<option value="Дніпропетровська">Дніпропетровська</option>
										<option value="Донецька">Донецька</option>
										<option value="Житомирська">Житомирська</option>
										<option value="Закарпатська">Закарпатська</option>
										<option value="Запорізька">Запорізька</option>
										<option value="Івано-Франківська">Івано-Франківська</option>
										<option value="Київська">Київська</option>
										<option value="Кіровоградська">Кіровоградська</option>
										<option value="Луганська">Луганська</option>
										<option value="Львівська">Львівська</option>
										<option value="Миколаївська">Миколаївська</option>
										<option value="Одеська">Одеська</option>
										<option value="Полтавська">Полтавська</option>
										<option value="Рівненська">Рівненська</option>
										<option value="Сумська">Сумська</option>
										<option value="Тернопільська">Тернопільська</option>
										<option value="Харкіська">Харкіська</option>
										<option value="Херсонська">Херсонська</option>
										<option value="Хмельницька">Хмельницька</option>
										<option value="Черкаська">Черкаська</option>
										<option value="Чернівецька">Чернівецька</option>
										<option value="Чернігівська">Чернігівська</option>
									  </select>


									<label>Соціальна категория</label>
									<div style="color:#0c0e0c; background:white; font-size: 14px; padding-left:15px; border-radius:5px;">
										<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="form_sirot" value="Так" ' . (($row['s_sirota'] == 'Так') ? 'checked' : '') . '>Діти-сироти та діти позбавлені батьківського піклування
										</label>
										</div>
										<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="form_peres" value="Так" ' . (($row['s_peresel'] == 'Так') ? 'checked' : '') . '>Переселенці
										</label>
										</div>
										<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="form_ivalid" value="Так" ' . (($row['s_inval'] == 'Так') ? 'checked' : '') . '>Інваліди
										</label>
										</div>
										<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="form_malozab" value="Так" ' . (($row['s_malozab'] == 'Так') ? 'checked' : '') . '>Малозабезпечені
										</label>
										</div>
										<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="form_uchbd" value="Так" ' . (($row['s_war_act'] == 'Так') ? 'checked' : '') . '>Учасники бойових дій та їх діти
										</label>
										</div>
									</div>

									<label>Адреса</label>
									 <input type="text" class="form-control"  name="form_adres" value="' . $row['s_adresa'] . '" style="background:white; color:#0c0e0c; border:none;">

									<label>Тел.№ студента</label>
									 <input type="text" class="form-control"  name="form_tel_st" value="' . $row['s_tels'] . '" style="background:white; color:#0c0e0c; border:none;">

									<label>Тел.№ батька</label>
									 <input type="text" class="form-control"  name="form_tel_bat" value="' . $row['s_telb'] . '" style="background:white; color:#0c0e0c; border:none;">

									<label>Тел.№ матері</label>
									 <input type="text" class="form-control"  name="form_tel_mut" value="' . $row['s_telm'] . '" style="background:white; color:#0c0e0c; border:none;">

									  ';
											}

											while ($row = mysqli_fetch_array($result));
										}
										?>

										<!-- Hidden input for student ID -->
										<input type="hidden" name="id"
											value="<?php echo isset($id_st) ? htmlspecialchars($id_st) : ''; ?>">
										<input type="hidden" name="form_galuz" value="">
										<input type="hidden" name="form_spec" value="">
										<input type="hidden" name="form_vip" value="">

										<p>
											<button type="button" class="form-control bg-success" id="submit-form"
												onclick="AsyncRouter.editStudent(<?php echo $id_st; ?>, this.form); return false;"
												style="color:white; margin-top: 15px;">Зберегти зміни</button>

										</p>

									</form>
									<div class=" ">
										<div class="card shadow-lg rounded-2 border-2"
											style="background-color: #94c7f6; border: #4ea6ee; margin-top: 15px; padding: 7px; ">
											<div class="card-header" data-bs-toggle="collapse"
												data-bs-target="#moveHistoryForm" aria-expanded="false"
												aria-controls="moveHistoryForm" style="cursor: pointer;">
												<h5 class="mb-0 text-center fs-2 fw-bold">Перемістити студента до
													історії</h5>
											</div>
											<div id="moveHistoryForm" class="collapse">
												<div class="card-body ">
													<!-- Форма включає прихований id студента, поле для вибору дати та комбо-бокс (select) для причини -->
													<form method="post" action="">
														<!-- Прихований input із ідентифікатором студента -->
														<input type="hidden" name="id_st"
															value="<?= isset($id_st) ? htmlspecialchars($id_st) : '' ?>">

														<div class="mb-3">
															<label for="operation_date" class="form-label"><strong>Дата
																	операції</strong></label>
															<input type="date" name="operation_date" id="operation_date"
																class="form-control" required>
														</div>
														<div class="mb-3">
															<label for="operation_name"
																class="form-label "><strong>Причина
																	операції</strong></label>
															<select name="operation_name" id="operation_name"
																class="form-select" required style="font-size: 14px;">
																<option class="fs-3" value="">Виберіть причину</option>
																<option class="fs-3" value="Відрахований/а">
																	Відрахований/а</option>
																<option class="fs-3"
																	value="Пішов/ла в академ відпустку">Пішов/ла в
																	академ відпустку</option>
																<option class="fs-3" value="Інша причина">Інша причина
																</option>
															</select>
														</div>
														<div class="d-grid">
															<button type="submit" name="move_to_history"
																class="btn btn-danger btn-lg">
																Перемістити до історії
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


					<!-- End Sample Menu -->
				</div>
			</div>
		</div>

		<!-- Toast Notifications Container -->
		<div id="toast-container"></div>

		<!-- Footer -->
		<!-- Footer -->
		<?php include("../include/footer.php"); ?>

		<!-- End Footer -->
		<!-- JS -->
		<script type="text/javascript" src="../assets/js/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../assets/js/scripts.js"></script>
		<!-- Toast Notifications -->
		<script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
		<!-- Async Router -->
		<script type="text/javascript" src="async.js" type="text/javascript"></script>
		<!-- End JS -->

</body>

</html>