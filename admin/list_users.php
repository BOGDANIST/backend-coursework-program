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
        <link rel="stylesheet" href="../assets/css/toast-notifications.css" rel="stylesheet">
    
	<style>
  .fakeimg {
      height: 200px;
      background: #aaa;
			}

.container {
  max-width: 1080px;
  padding: 10px;
  width: 100%;
}
.container.no-padding {
  padding-left: 20px !important;
  padding-right: 20px !important;
}

	</style>

	</head>
	<div id="toast-container"></div>
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
    <div >

			<!-- Top Menu -->
			<?php include ("../include/adm_menu.php");?>
			 <?php include ("../include/background_icon.php");?>
            <!-- End Top Menu -->
           
            <!-- === END HEADER === -->
            
            <div class="d-flex justify-content-center align-items-center fs-3">
    <div class="row row-cols-1 col-11">
        <div class="panel-group d-flex flex-column align-items-center" id="accordion">
            <h3 class="margin-bottom fs-1 text-center"><strong>Список користувачів</strong></h3> 
            <p style="text-align:center; color:#56693c;">
            <?php 
                $result_users = mysqli_query($linc, "SELECT * FROM users");
                if (mysqli_num_rows($result_users) > 0) echo "<strong>Всього " . mysqli_num_rows($result_users) . " користувачів:</strong>";
            ?> 
            </p>

            <div class="col-md-10" style="margin-top:0px;border:none;">
                <div class="container text-center">
                    <div class="row shadow bg-secondary-subtle">
                        <div class="col-1 g-1"><strong>№</strong></div>
                        <div class="col-3 g-1"><strong>Логін</strong></div>
                        <div class="col-4 g-1 overflow-hidden"><strong>Пароль</strong></div>
                        <div class="col-4 g-1"><strong>Дії</strong></div>
                    </div>
                </div>

                <?php
                if (mysqli_num_rows($result_users) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_array($result_users)) {
                        $row_class = ($i % 2 == 0) ? 'bg-white bg-opacity-10' : 'bg-white';

                        echo '
                        <div class="container text-center">
                            <div class="row shadow-lg ' . $row_class . '">
                                <div class="col-1 g-1"><strong>' . $i . '</strong></div>
                                <div class="col-3 g-1"><strong>' . htmlspecialchars($row['login']) . '</strong></div>
                                <div class="col-4 g-1 overflow-hidden"><strong>' . htmlspecialchars($row['password']) . '</strong></div>
                                <div class="col-2 g-1 text-decoration-underline">
                                    <strong><a href="edit_user.php?user_id_edit=' . $row["user_id"] . '">Змінити</a></strong>
                                </div>
                                <div class="col-2 g-1 text-decoration-underline">
                                    <strong><a href="#" onclick="AsyncRouter.deleteUser(' . $row["user_id"] . '); return false;">Видалити</a></strong>
                                </div>
                            </div>
                        </div>';
                        $i++;
                    }
                }
                ?>  
            </div>
            
        </div>
        
    </div>
    
</div>

		  
             <style>
      html, body {
  height: 100%;
  margin: 0;
}
      .wrapper {
  display: flex;
  flex-direction: column;
  min-height: 40vh;
}
.mt-auto {
  margin-top: auto !important;
}
    </style>
	<!-- Footer -->

  <div class="wrapper d-flex flex-column ">
    <!-- Увесь контент сайту тут -->    

    <!-- Footer -->
    <footer class="mt-auto text-light pt-4 p-3" style="background-color:#256279;">
      <div class="container">
 <div class="row cols-2">
          <div class="col-md-6 mb-3 mb-md-0">
            <ul class="list-unstyled list-inline mb-0">
              <li class="list-inline-item">
                <a href="#" target="_blank" class="text-light" style="text-decoration: none;">e-student.org.ua</a>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <p class="mb-0 text-end">&copy; <script>document.write(new Date().getFullYear());</script> eSTUDENT Corporation</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
		  <!-- Footer -->
    <!-- Footer -->        
 	



 <body>
</html>

<script src="../assets/js/toast-notifications.js"></script>
<script src="../async.js"></script>

<?php

// Provide a function to reload the list after deletion if needed
echo '
<script>
function loadUsersList() {
    location.reload();
}
</script>
';
?>
