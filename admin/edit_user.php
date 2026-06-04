
<?php
session_start();

if ($_SESSION['auth_user']!="admin")
	{   echo 'Доступ заборонений';
	    unset($_SESSION['auth_user']);
		header("Location:input.php");
	}    
else
	{
	 include ("../include/db_connect.php");
	 error_reporting(0);
    
	 $id_user=$_GET["user_id_edit"];
	
	
	if (isset($_POST['submit_new_password']))
	
		{if ($_POST["login"]=="" || $_POST["old_password"]=="" || $_POST["new_password"]=="")
			{
				$error = "Не введено логін або пароль";
			}
		else
			{$old_password = md5($_POST['old_password']);	
			 $new_password=md5($_POST["new_password"]);
			 $result_users =  mysqli_query($linc, "SELECT * FROM users WHERE  user_id='$id_user'");
			 $row = mysqli_fetch_array($result_users);
			 if ($row['password']==$old_password)
				{ 
				if ($_POST["status"]=="user") $status="1";
		        if ($_POST["status"]=="admin") $status="10";
			 	mysqli_query($linc, "UPDATE users SET password='{$new_password}' WHERE  user_id='$id_user'");
				mysqli_query($linc, "UPDATE users SET status='{$status}' WHERE  user_id='$id_user'");
  		
					$success = "Дані змінені";
				}
				else 
				{$error = "Зміни не проведені";
				
				}
				
			}
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
		<!-- Toast Notifications CSS -->
		<link rel="stylesheet" href="assets/css/toast-notifications.css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    
	</head>
   <body>	

               <div id="header">
                <div class="container" >
                    <div class="row col-12" >
                        <!-- Logo -->
                        <div class="logo ">
                            <a href="index.html" title="">
                              <img src="../assets/img/logo2.png" alt="Logo"  style="max-width: 100%;"/>
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>
      <div id="body-bg">

		   <!-- === BEGIN CONTENT === -->

		<?php include ("../include/adm_menu.php");?>
		 <?php include ("../include/background_icon.php");?>
			
        <div class="container">
            <!-- === BEGIN FOOTER === -->
			<div id="base">
				<div id="content">
				  <div class="container background-white" style="margin:0px; padding:10px;">
                    <div class="row margin-vert-30" style="margin:10px; padding:0px;">
                        <!-- Register Box -->
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                        	<form class="signup-page" method="POST">
                                <div class="signup-header">
                                    <h3 style="color:#C8D8E7; text-align: center;"><strong>Зміни даних користувача</strong></h3>
                                </div>
								
								<label for="sel1">Логін</label>
								<?php
								$id_user=$_GET["user_id_edit"];
								$result=mysqli_query($linc, "SELECT * FROM users WHERE user_id='$id_user'");
								if (mysqli_num_rows($result)>0)
                                   {$row = mysqli_fetch_array($result);
									do
									{
									echo '
									<input type="text" class="form-control" id="sel1"  name="login" value="'.$row['login'].'" style="background:white; color:#0c0e0c; border:none;"  >
									';
									}
									while ($row = mysqli_fetch_array($result));
									}
								?>
								<label >Введіть новий пароль</label>
								<input type="password" class="form-control" id="sel2"  name="new_password1" style="background:white; color:#0c0e0c; border:none;"  > 
								
								<label >Підтвердіть новий пароль</label>
								<input type="password" class="form-control" id="sel3"  name="new_password2" style="background:white; color:#0c0e0c; border:none;"  > 
								
								<label >Виберіть рівень доступу</label>
									<select class="form-control"  name="status" id="sel5" size="2" style="background:white; color:#0c0e0c;">
									<option value="user">Спостерігач</option>
									<option value="editor">Редактор</option>
									<option value="admin">Адміністратор</option>
									</select>  
								<p>
								 <button type="button" class="form-control bg-success" id="submit-form" onclick="AsyncRouter.editUser(<?= isset($id_user) ? $id_user : 0 ?>, this.form.closest('form')); return false;">Підтвердити</button>
								</p>
							</form>
						</div>
					</div>
				  </div>
			    </div>
            </div>
			    <!-- Footer -->

        </div>

		<!-- Toast Notifications Container -->
		<div id="toast-container"></div>

			 	<?php include ("../include/footer.php");?>

		<!-- Toast Notifications -->
		<script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
		<!-- Async Router -->
		<script type="text/javascript" src="async.js" type="text/javascript"></script>
		</body>
          

