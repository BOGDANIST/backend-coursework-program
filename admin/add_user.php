<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin'])) {
    header("Location: admin_panel.php");
}
else {
    include("../include/db_connect.php");
    error_reporting(0);
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
                              <img style="width: 100%;" src="../assets/img/logo.png" alt="Logo" />
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>
            <!-- End Header -->

			<!-- Admin Menu -->
			<?php include ("../include/adm_menu.php");?>
			 <?php include ("../include/background_icon.php");?>
            <!-- End Admin Menu -->

            <!-- === END HEADER === -->


		   <!-- === BEGIN CONTENT === -->
			<div class="container bottom-border">
				<div id="base">
					<div id="content">
						<div class="row padding-top-40">
							<div class="col-md-12">
								<div class="col-md-12" style="margin-top:10px;">
									<div class="tab-content">
										<div class="tab-pane fade in active" id="user-add">
											<div class="container background-white" style="margin:0px; padding:10px;">
												<div class="row margin-vert-30" style="margin:0px; padding:0px;">
													<!-- Register Box -->
													<div class="col-md-6 col-md-offset-3 col-sm-offset-3 ">

														<form id="add-user-form" class="signup-page fs-3 shadow-lg" novalidate>
															<div class="signup-header">
																<h2 style="color:#e1eefb;"><center><strong>Реєстрація нового користувача</strong></center></h2>
															</div>

															<label for="sel1">Введіть логін</label>
															<input type="text" class="form-control" id="sel1" name="input_login" style="background:white; color:#0c0e0c; border:none;" required>

															<label>Введіть пароль</label>
															<input type="password" class="form-control" id="sel2" name="input_password1" style="background:white; color:#0c0e0c; border:none;" required>

															<label>Підтвердить пароль</label>
															<input type="password" class="form-control" id="sel3" name="input_password2" style="background:white; color:#0c0e0c; border:none;" required>

															<label>Виберіть рівень доступу</label>
															<select class="form-control" name="input_status" id="sel5" size="3" style="background:white; color:#0c0e0c;" required>
																<option value="admin">Адміністратор</option>
																<option value="editor">Редактор</option>
																<option value="viewer">Спостерігач</option>
															</select>

															<p>
																<button type="button" class="form-control bg-success shadow" id="submit-form" onclick="AsyncRouter.addUser(this.form.closest('form')); return false;">
																	Реєстрація
																</button>
															</p>
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
			</div>
			<!-- === END CONTENT === -->

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
