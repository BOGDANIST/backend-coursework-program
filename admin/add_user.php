<?php

session_start();
 
	if (!in_array($_SESSION['auth_user'], ['admin']))
	{   
		header("Location: admin_panel.php");
	}   
else
	{
	 include ("../include/db_connect.php");
	 error_reporting(0);
	}
?>




<?php
	
	if (isset($_POST['submit_reg']))
    {
		if ($_POST["input_login"]=="" || $_POST["input_password1"]=="" || $_POST["input_password1"]=="")
			{'
				<script>
				alert("Не введено логін або пароль.");
				</script>';
				$error="Не введено логін або пароль";
			}
		
		if ($_POST["input_password1"]!=$_POST["input_password2"])
		    {'
			<script>
			alert("Не співпадають введені значення паролю.");
			</script>';
			$error="Не співпадають введені значення паролю";
		    }
		
		$result=mysqli_query($linc, "SELECT * FROM users");
           $row = mysqli_fetch_array($result);
			do{
			  if ($_POST["input_login"]==$row['login'])
			  {'
				<script>
					alert("Такий логін вже існує.");
				</script>';
				$error="Такий логін вже існує";				
			  }
			  
			 
			  if (md5($_POST["input_password1"])==$row['password'])
			    {'
				<script>
					alert("Такий пароль вже існує.");
				</script>';	
			    $error="Такий пароль вже існує";

				}
		      }	
			while ($row = mysqli_fetch_array($result));  	
		
		if ($error=="")
		{
			$password =	md5($_POST["input_password1"]);
			if ($_POST["input_status"]=="user") $status="1";
			if ($_POST["input_status"]=="admin") $status="10";
			if ($_POST["input_status"]=="editor") $status="9";
			if ($_POST["input_status"]=="viewer") $status="8";
			mysqli_query($linc, "INSERT INTO users SET
					login='".$_POST["input_login"]."',
					password='".$password."',
					status='".$status."'
					");
			$success = "Користувач успішно зареєстрований";
		};
	};		

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
                    
            <!-- End Portfolio -->
			
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
				<div id="base">
					<div id="content">


					<?php if (!empty($error)): ?>
					<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
					<div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
						<div class="d-flex">
						<div class="toast-body fs-3">
							<?= htmlspecialchars($error) ?>
						</div>
						<button type="button" class="btn-close btn-close-white me-2 m-auto " data-bs-dismiss="toast" aria-label="Закрити"></button>
						</div>
					</div>
					</div>
					<?php endif; ?>

					<?php if (!empty($success)): ?>
					<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
					<div id="errorToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
						<div class="d-flex">
						<div class="toast-body fs-3">
							<?= htmlspecialchars($success) ?>
						</div>
						<button type="button" class="btn-close btn-close-white me-2 m-auto " data-bs-dismiss="toast" aria-label="Закрити"></button>
						</div>
					</div>
					</div>
					<?php endif; ?>


					  <div class="container background-white" style="margin:0px; padding:10px;">
						<div class="row margin-vert-30" style="margin:0px; padding:0px;">
							<!-- Register Box -->
							<div class="col-md-6 col-md-offset-3 col-sm-offset-3 ">
								
								<form class="signup-page  fs-3  shadow-lg" method="POST">
									<div class="signup-header">
										<h2 style="color:#e1eefb;"><center><strong>Реєстрація нового користувача</strong></center></h2>
									</div>
									
									<label for="sel1">Введіть логін</label>
									<input type="text" class="form-control" id="sel1"  name="input_login" style="background:white; color:#0c0e0c; border:none;"  >
									
									<label >Введіть пароль</label>
									<input type="password" class="form-control" id="sel2"  name="input_password1" style="background:white; color:#0c0e0c; border:none;"  > 
									
									<label >Підтвердить пароль</label>
									<input type="password" class="form-control" id="sel3"  name="input_password2" style="background:white; color:#0c0e0c; border:none;"  > 
									
									<label >Виберіть рівень доступу</label>
									<select class="form-control"  name="input_status" id="sel5" size="3" style="background:white; color:#0c0e0c;">
									<!-- <option value="user">Користувач</option> -->
									<option value="admin">Адміністратор</option>
									<option value="editor">Редактор</option>
									<option value="viewer">Спостерігач</option>
								    </select>  
									
									<p>
									 <input type="submit" class="form-control bg-success shadow" id="submit-form" name="submit_reg" value="Реєстрація" >
									</p>
								</form>
							
							</div>
						</div>
					  </div>
					</div>
				</div>
			</div>
						    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>


		 
  </body>
</html>
