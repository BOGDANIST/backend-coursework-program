<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor']))
{
    unset($_SESSION['auth_user']);
    header("Location:../admin/input.php");
}

include ("../include/db_connect.php");
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
		 <!-- Toast Notifications CSS -->
		 <link rel="stylesheet" href="assets/css/toast-notifications.css">

        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
	</head>
<body>
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
                              <img style="width: 100%;"	 src="../assets/img/logo.png" alt="Logo" />
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


		   <!-- === BEGIN CONTENT === -->
	      <div class="container bottom-border">
         	<div id="base">
				<div id="content">
				  <div class="container background-white " style="margin:0px; padding:10px;">
                    <div class="row " style="margin:10px; padding:0px;">
                        <!-- Register Box -->
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 d-flex ">

							<form class="signup-page  needs-validation" method="POST"  enctype="multipart/form-data">
                                <div class="signup-header">
                                    <h2 style="color:#76d5fa;"><center><strong>Введення даних про нового студента</strong></center></h2>
                                    <p>* позначені поля обов'язкові для заповнення</p>
                                </div>
								<label for="sel1">Виберіть групу*</label>
								<?php
									$query_group = mysqli_query($linc, "SELECT * FROM st_group");
									echo  '<select class="form-control" name="form_group" id="sel1" required  size="5" style="color:#0c0e0c;">';
									echo '<option value=""></option>';
									while ($temp = mysqli_fetch_assoc($query_group))
									{
									echo '<option style="color:#0c0e0c;" value='.$temp['g_im'].'>'.$temp['g_im'].'</option>';
									}
									echo "</select>";
									?>

								<label for="sel2">Прізвище*</label>
								 <input type="text" class="form-control is-valid" id="sel2"  name="form_pr_stud" required style="background:white; color:#0c0e0c; border:none;"  >

								<label for="sel3">Ім'я*</label>
								 <input type="text" class="form-control" id="sel3"  name="form_im_stud" required  style="background:white; color:#0c0e0c; border:none;"  >

								<label for="sel4">По батькові*</label>
								 <input type="text" class="form-control" id="sel4"   name="form_bat_stud" required  style="background:white; color:#0c0e0c; border:none;"   >

								<label for="sel5">Стать*</label>
								  <select class="form-control"  name="form_sex" id="sel5" size="2" required  style="background:white; color:#0c0e0c;">
									<option value="Чоловік">Чоловік</option>
									<option value="Жінка">Жінка</option>
								  </select>

								<label for="sel6">Дата народження*</label>
								<input type="date" class="form-control" name="form_date_nar" id="sel6" required  style="background:white; color:#0c0e0c; border:none;"/>

								<label for="sel7">Навчання за кошти фіз. чи юридич. осіб*</label>
								  <select class="form-control"  name="form_zamovl" id="sel7" size="2" required  style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>

								<label for="sel8">Освіта*</label>
								  <select class="form-control" required   name="form_osvita" id="sel8" size="2" style="background:white; color:#0c0e0c;">
									<option value="Базова загальна середня освіта">Базова загальна середня освіта</option>
									<option value="Повна загальна середня освіта">Повна загальна середня освіта</option>
									<option value="Молодший спеціаліст">Молодший спеціаліст</option>
									<option value="Кваліфікований робітник">Кваліфікований робітник</option>
								  </select>

								<label for="sel9">Рік завершення *</label>
								 <input type="text" class="form-control"  name="form_zscool" id="sel9" required   style="background:white; color:#0c0e0c; border:none;">

								<label for="sel10">Регіон проживання*</label>
								  <select class="form-control"  name="form_region_type" id="sel10" required  size="2" style="background:white; color:#0c0e0c;">
									<option value="Місто">Місто</option>
									<option value="Сільська місцевість">Сільська місцевість</option>
								  </select>

								<label for="sel11">Область проживання*</label>
								  <select class="form-control"  name="form_region" id="sel11" size="8" required  style="background:white; color:#0c0e0c;">
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

								<label for="sel12">Соціальна категорія</label>
								 <div style="color:#0c0e0c; background:white; font-size: 16px; color:#0c0e0c; padding-left:15px; border-radius:5px;">
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_sirot" value="Так">Діти-сироти та діти позбавлені батьківського піклування
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_peres" value="Так">Переселенці
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_ivalid" value="Так">Інваліди
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_malozab" value="Так">Малозабезпечені
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_uchbd" value="Так">Учасники бойових дій та їх діти
									  </label>
									</div>
								</div>

								<label for="sel13">Адреса</label>
								 <input type="text" class="form-control"  name="form_adres" id="sel13"  style="background:white; color:#0c0e0c; border:none;">

								<label for="sel14">Тел.№ студента (тільки цифри), наприклад 0974524231</label>
								 <input type="text" class="form-control"  name="form_tel_st" id="sel14"  style="background:white; color:#0c0e0c; border:none;">

								<label for="sel15">Тел.№ батька (тільки цифри)</label>
								 <input type="text" class="form-control"  name="form_tel_bat" id="sel15"  style="background:white; color:#0c0e0c; border:none;">

								<label for="sel16">Тел.№ матері (тільки цифри)</label>
								 <input type="text" class="form-control"  name="form_tel_mut" id="sel16"  style="background:white; color:#0c0e0c; border:none;">


								<label for="sel17">Виберiть файл для основного зображення:</label>
								<div>
									<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
									<input type="file" name="my_file_one[]" />
								</div>

								<p>
								<button type="button" class="form-control bg-success" id="submit-form" onclick="AsyncRouter.addStudent(this.form); return false;" style="color:white; border: 2px solid #c1aaaa; margin-top:10px;">Додати</button>
								</p>

								<p>
								<input type="reset" class="form-control bg-danger" id="reset-form" value="Очистити" style="color:white; border: 2px solid #c1aaaa; margin-top:10px;">
							    </p>
								<p>
								<a href="import_student.php"
								class="form-control d-flex align-items-center justify-content-center"
								style="background-color: #76d5fa; color: #0c0e0c; border: 2px solid #248bad; margin-top:20px; font-size: large; padding: 10px; height: 50px;">
								Імпортувати через CSV
								</a>
							    </p>
							</form>


						</div>
      				</div>
					</div>
				</div>
			</div>
            <!-- === END CONTENT === -->
          </div>
        </div>

		  <!-- Toast Notifications Container -->
		  <div id="toast-container"></div>

		  <!-- Footer -->
    <!-- Footer -->
 	<?php include ("../include/footer.php");?>

            <!-- End Footer -->
            <!-- JS -->
            <script type="text/javascript" src="assets/js/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="assets/js/scripts.js"></script>
            <!-- Isotope - Portfolio Sorting -->
            <script type="text/javascript" src="assets/js/jquery.isotope.js" type="text/javascript"></script>
            <!-- Mobile Menu - Slicknav -->
            <script type="text/javascript" src="assets/js/jquery.slicknav.js" type="text/javascript"></script>
            <!-- Animate on Scroll-->
            <script type="text/javascript" src="assets/js/jquery.visible.js" charset="utf-8"></script>
            <!-- Sticky Div -->
            <script type="text/javascript" src="assets/js/jquery.sticky.js" charset="utf-8"></script>
            <!-- Slimbox2-->
            <script type="text/javascript" src="assets/js/slimbox2.js" charset="utf-8"></script>
            <!-- Modernizr -->
            <script src="assets/js/modernizr.custom.js" type="text/javascript"></script>
            <!-- Toast Notifications -->
            <script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
            <!-- Async Router -->
            <script type="text/javascript" src="async.js" type="text/javascript"></script>
            <!-- End JS -->
</body>

</html>
