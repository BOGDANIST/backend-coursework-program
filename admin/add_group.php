<?php
session_start();
if (!in_array($_SESSION['auth_user'], ['admin', 'editor']))
{
    unset($_SESSION['auth_user']);
    header("Location:../admin/input.php");
}
else
{
    include ("../include/db_connect.php");
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
		<!-- Toast Notifications CSS -->
		<link rel="stylesheet" href="assets/css/toast-notifications.css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">

	<style>
  .fakeimg {
      height: 200px;
      background: #aaa;
			}
	</style>

	</head>

      <div id="body-bg" >
            <!-- Phone/Email -->

            <!-- End Phone/Email -->
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="logo">
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


		   <!-- === BEGIN CONTENT === -->

            <!-- Portfolio -->
            <div id="portfolio" class="bottom-border-shadow">

                <div class="container bottom-border">

            <!-- End Portfolio -->

            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
					<div id="base">
				<div id="content" >
				  <div class="container background-white fade-in" style="margin:0px; padding:10px;">
                    <div class="row margin-vert-30" style="margin:10px; padding:0px;">
                        <!-- Register Box -->
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2">

							<form class="signup-page" method="POST">
                                <div class="signup-header">
                                    <h1 style="color:rgb(219, 243, 248);"><center><strong>Введення даних про нову групу</strong></center></h1>
                                    <p>* позначені поля обов'язкові для заповнення</p>
                                </div>

								<label for="sel1">Введіть назву групи*</label>
								 <input required type="text" class="form-control" id="sel1"  name="form_im_group" style="background:white; color:#0c0e0c; border:none;"  >

								<label >Форма навчання*</label>
								  <select required  class="form-control"  name="g_fn"  size="2" style="background:white; color:#0c0e0c;">
									<option value="Денна">Денна</option>
									<option value="Заочна">Заочна</option>
								  </select>



								<!-- Галузь -->
									<?php

									$gz_query = "SELECT DISTINCT im_galuz AS gz FROM spec ORDER BY im_galuz ASC";
									$gz_result = mysqli_query($linc, $gz_query);

										echo'<label for="sel2">Виберіть галузь знань**</label>
											<select required  class="form-control" name="g_gz" id="sel2" size="6" style="color:#0c0e0c;">

											';

										if ($gz_result) {
										while ($row_gz = mysqli_fetch_assoc($gz_result)) {
											$value = htmlspecialchars($row_gz['gz']);

												echo '
														<option value="'. $value .'">'. $value .'</option>
														';
											}
										}

										echo'
											</select>
											';
									?>

									<!-- Спеціалізації -->
									<?php
									// Припускаємо, що потрібне значення – це поле im_spec (замість CONCAT, якщо лише одне поле)
									$spec_query = "SELECT DISTINCT im_spec AS spec FROM spec ORDER BY id_spec ASC";
									$spec_result = mysqli_query($linc, $spec_query);
									echo'<label required  for="sel3">Виберіть Спеціалізацію*</label>
										<select class="form-control" name="g_sp" id="sel3" size="7" style="color:#0c0e0c;">

										';
									if ($spec_result) {
										while ($row_spec = mysqli_fetch_assoc($spec_result)) {
											$spec = htmlspecialchars($row_spec['spec']);
											echo '
													<option value="'. $spec .'">'. $spec .'</option>
											';
										}
									}

									echo'
										</select>
										';
									?>

									<!-- Спеціальність -->
									<?php
									// Припускаємо, що потрібне значення – це поле im_spec (замість CONCAT, якщо лише одне поле)
									$specializ_query = "SELECT DISTINCT im_specializ AS specializ FROM spec ORDER BY id_spec ASC";
									$specializ_result = mysqli_query($linc, $specializ_query);
									echo'<label required  for="sel4">Виберіть Спеціальність*</label>
										<select class="form-control" name="g_sz" id="sel4" size="7" style="color:#0c0e0c;">

										';
									if ($specializ_result) {
										while ($row_specializ = mysqli_fetch_assoc($specializ_result)) {
											$specializ = htmlspecialchars($row_specializ['specializ']);
											echo '
													<option value="'. $specializ .'">'. $specializ .'</option>
											';
										}
									}

									echo'
										</select>
										';
									?>



								<label for="sel5">Виберіть курс*</label>
								<select required  class="form-control" name="g_kurs" id="sel5" size="4" style="color:#0c0e0c;">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								</select>
								<p></p>

								<div class="form-check">
									  <label class="form-check-label">
										Випускна група  <input type="checkbox" class="form-check-input" style="" name="g_vip" value="Так">
									  </label>
								</div>

								<label for="sel6">Кількість студентів*</label>
								 <input type="text" class="form-control" id="sel6"  name="g_count_stud" style="background:white; color:#0c0e0c; border:none;"  >

								<label for="sel7">Кількість студентів, що навчаються за регіональним замовленням</label>
								 <input type="text" class="form-control" id="sel7"  name="g_count_rz" style="background:white; color:#0c0e0c; border:none;"  >

								 <label for="sel7">Кількість студентів, що навчаються за кошти фізичних або юридичних осіб</label>
								 <input type="text" class="form-control" id="sel7"  name="g_count_contr" style="background:white; color:#0c0e0c; border:none;"  >

								<label for="sel8">Наставник групи</label>
								 <input type="text" class="form-control" id="sel8"   name="g_nast" style="background:white; color:#0c0e0c; border:none;"   >

								<p>
								 <button type="button" class="form-control bg-success" id="submit-form" onclick="AsyncRouter.addGroup(this.form); return false;" style="color:white; border: 2px solid #c1aaaa; margin-top:25px;">Додати</button>
								</p>
													<p>
								<a href="import_group.php"
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

		<!-- Toast Notifications Container -->
		<div id="toast-container"></div>

                        <!-- End Sample Menu -->
                    </div>
                </div>
            </div>

		  <!-- Footer -->
    <!-- Footer -->
 	<?php include ("../include/footer.php");?>

            <!-- End Footer -->
            <!-- JS -->
            <script type="text/javascript" src="../assets/js/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="../assets/js/scripts.js"></script>

            <!-- Toast Notifications -->
            <script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
            <!-- Async Router -->
            <script type="text/javascript" src="async.js" type="text/javascript"></script>
 <body>
</html>
