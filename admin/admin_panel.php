<?php
session_start();
if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer']) )
	{   echo 'Доступ заборонений';
	    unset($_SESSION['auth_user']);
		header("Location:input.php");
	 }    
else
	{
	 include ("../include/db_connect.php");
	}
?>


<!DOCTYPE html>
    <head>
        <!-- Title -->
        <title>єСтудент</title>
<link rel="icon" type="image/png" href="..\assets\img\logo_brouser2.png">
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="icon" type="image/png" href="..\assets\img\logo_brouser2.png">
        <!-- Favicon -->
        <!-- <link href="favicon.ico" rel="shortcut icon"> -->
        <!-- Bootstrap Core CSS -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
                <!-- Template CSS -->
		<link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
        <!-- Template CSS 
        <link rel="stylesheet" href="../assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/custom.css" rel="stylesheet">
         Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        
	</head>
    <?php include ("../include/background_icon.php");?>

      <div  id="body-bg">
            <!-- Phone/Email 
            <div id="pre-header" class="background-gray-lighter">
                <div class="container no-padding">
                    <div class="row hidden-xs">
                        <div class="col-sm-6 padding-vert-5">
                            <strong>Телефон:</strong>&nbsp;(04143)2-14-45
                        </div>
                        <div class="col-sm-6 text-right padding-vert-5">
                            <strong>Email:</strong>&nbsp;bcpep@ukr.net
                        </div>
                    </div>
                </div>
            </div>
            -->
            <!-- End Phone/Email -->
            <!-- Header -->
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
            <!-- End Header -->
			
			<!-- Top Menu -->
			<?php include ("../include/adm_menu.php");?>
            <!-- End Top Menu -->
           
            <!-- === END HEADER === -->
         


		   <!-- === BEGIN CONTENT === -->
	
   
            <!-- Portfolio -->


            <div class="row d-flex  align-items-center  col-12">
            <div class="card container-md  col-10 p-0 border-4  shadow-lg " style="max-width: 1040px; color: aliceblue; border-color: #63949E; ">
                <div class="row m-0 shadow">
                  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                    <img src="..\assets\img\study.jpg" class="img-fluid d-flex align-content-center" alt="...">
                  </div>
                  <div class="col-md-8  " style="background-color: #2d7791; color: aliceblue;">
                    <div class="card-body" >
                      <h5 class="card-title fs-2 fw-bolder"><i class="bi bi-book"></i> Електронна система обліку студентів</h5>
                      <p class="card-text">Наша система дозволяє ефективно керувати навчальними групами, студентами та спеціальностями в одному місці. Кожен користувач, залежно від рівня доступу, може додавати, редагувати або переглядати студентські дані з дотриманням прав доступу та цілісності інформації.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex  align-items-center  col-12 ">
            <div class="card container-md  col-10 p-0 border-4  shadow-lg " style="max-width: 1040px; color: aliceblue; border-color: #63949E; margin-top: 25px;">
                <div class="row m-0 shadow">
                  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                    <img src="..\assets\img\9907661.jpg" class="img-fluid d-flex align-content-center" alt="...">
                  </div>
                  <div class="col-md-8  " style="background-color: #2d5391; color: aliceblue;">
                    <div class="card-body" >
                      <h5 class="card-title fs-2 fw-bolder"><i class="bi bi-clipboard-data"></i> Аналітика, пошук та звітність</h5>
                      <p class="card-text">Функціонал системи включає потужну систему фільтрації студентів за різними критеріями: вік, соціальна категорія, спеціальність, група, курс тощо. Ви можете формувати вибірки, створювати звіти, експортувати дані в Excel та аналізувати зміни за різними показниками.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row d-flex  align-items-center  col-12 ">
            <div class="card container-md  col-10 p-0 border-4  shadow-lg " style="max-width: 1040px; color: aliceblue; border-color: #63949E; margin-top: 25px;">
                <div class="row m-0 shadow">
                  <div class="col-md-4 d-flex justify-content-center align-items-center p-0">
                    <img src="..\assets\img\asset-v2.png" class="img-fluid d-flex align-content-center" alt="...">
                  </div>
                  <div class="col-md-8  " style="background-color: #2d9171; color: aliceblue;">
                    <div class="card-body " >
                      <h5 class="card-title fs-2 fw-bolder"><i class="bi bi-shield-shaded"></i> Безпека та доступність</h5>
                      <p class="card-text">Система підтримує багаторівневий контроль доступу (переглядач, редактор, адміністратор), захищене зберігання паролів та авторизацію користувачів. Всі операції логуються, а доступ до функцій чітко регулюється згідно з роллю користувача. Інтерфейс адаптований для комфортної роботи на будь-якому пристрої.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
                      
			
            </div>
</div>
            <!-- End Portfolio -->
			
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
			
			
			
                
                        <!-- End Sample Menu -->
                    </div>
                </div>
            </div>
          
		  <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

            <!-- End Footer -->
            <!-- JS -->
            <!-- <script type="text/javascript" src="../assets/js/jquery.min.js" type="text/javascript"></script> -->
            <script type="text/javascript" src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="../assets/js/scripts.js"></script>
            <!-- Isotope - Portfolio Sorting -->
            <script type="text/javascript" src="../assets/js/jquery.isotope.js" type="text/javascript"></script>
            <!-- Mobile Menu - Slicknav -->
            <script type="text/javascript" src="../assets/js/jquery.slicknav.js" type="text/javascript"></script>
            <!-- Animate on Scroll-->
            <script type="text/javascript" src="../assets/js/jquery.visible.js" charset="utf-8"></script>
            <!-- Sticky Div -->
            <script type="text/javascript" src="../assets/js/jquery.sticky.js" charset="utf-8"></script>
            <!-- Slimbox2-->
            <script type="text/javascript" src="../assets/js/slimbox2.js" charset="utf-8"></script>
            <!-- Modernizr -->
            <script src="../assets/js/modernizr.custom.js" type="text/javascript"></script>
 <body>
</html>
