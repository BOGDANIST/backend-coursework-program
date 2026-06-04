<?php
	
	session_start();
	include ("../include/db_connect.php");


    if (isset($_POST['submit_input']))
	{   
		$login=$_POST["input_login"];
		$pass=md5($_POST["input_password"]);
	
		$result = mysqli_query($linc, "SELECT * FROM users WHERE login='$login' AND password='$pass'");
	     if (mysqli_num_rows($result)>0)
	     {
			$row=mysqli_fetch_array($result);
			if ($row["status"]==1) 
			{$_SESSION['auth_user']	= 'viewer';
			$_SESSION['login'] = $row['login'];
	         header("Location: admin_panel.php");
			}
			if ($row["status"]==10) 
			{$_SESSION['auth_user']	= 'admin';
			$_SESSION['login'] = $row['login'];
	         header("Location: admin_panel.php");
			}
			if ($row["status"]==9) 
			{$_SESSION['auth_user']	= 'editor';
			$_SESSION['login'] = $row['login'];
	         header("Location: admin_panel.php");
			}
			if ($row["status"]==8) 
			{$_SESSION['auth_user']	= 'viewer';
			$_SESSION['login'] = $row['login'];
	         header("Location: admin_panel.php");
			}
		 }
			
			// $pass=$_POST["input_password"];
			// if ($login=="admin" and $pass=="123456")
			// {$_SESSION['auth_user']	= 'admin';
			
			// $success =  'Ви увійшли як суперадміністратор';
			// header("Location: admin_panel.php");
			// }
		


			$error = "Невірний логін або пароль!";
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
   
        <!-- Template CSS -->
		 <link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
		 

        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    
	</head>
   
      <div id="body-bg">

		   <!-- === BEGIN CONTENT === -->

<?php include ("../include/background_icon.php");?>
			


        <div class="container">

			<div id="base">
				<div id="content ">
				  <div class="container background-white" style="margin:0px; padding:10px;">
                    <div class="row margin-vert-30 justify-content-center" style="margin:10px; padding:0px;">
                        <!-- Register Box -->
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                        	<form class="signup-page shadow-lg"  method="POST">
                                <div class="signup-header">
                                 <p>   <h2 style="color:#e1eefb;"><center><strong>Вхід</strong></center></h2> </p>
                                </div>
								
								<label for="sel1">Введіть логін</label>
								<input  type="text" class="form-control shadow-lg " id="sel1"  name="input_login"   >
								
								<label >Введіть пароль</label>
								<input style="background-color: #C8D8E7; color: #03152D; border:none;" type="password" class="form-control shadow " id="sel2"  name="input_password"   > 
								  
								<p>
								 <input type="submit" class="form-control bg-success shadow " id="submit-form" name="submit_input" value="Вхід" >
								</p>
							</form>
						</div>
					</div>
				  </div>
			    </div>
            </div>
        </div>
          

