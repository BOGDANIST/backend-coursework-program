<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer'])) {
    header("Location: admin_panel.php");
} else {
    include ("../include/db_connect.php");
    error_reporting(0);

    $id_st = $_GET["id_st"] ?? null;

    if (!$id_st) {
        die("ID студента не вказано!");
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
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
 
 <body>   
	<div id="toast-container"></div>
	<style>
  .fakeimg {
      height: 200px;
      background: #aaa;
			}
	</style>
	
        <link rel="stylesheet" href="assets/css/toast-notifications.css" rel="stylesheet">
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
			<?php include ("../include/adm_menu.php");?>
			 <?php include ("../include/background_icon.php");?>
            <!-- End Top Menu -->
           
            <!-- === END HEADER === -->
         


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
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2">
                            
							<form class="signup-page" method="POST">
                                <div class="signup-header">
                                    <h2 style="font-size:25px; color:#eaf0f8; text-align: center;"><strong>Перегляд даних про студента</strong></h2>
								</div>
				  <?php
                  $result = mysqli_query($linc, "SELECT * FROM old_student WHERE s_id='$id_st'");
                  if (mysqli_num_rows($result)>0)
                    {
                        $row = mysqli_fetch_array($result);
                         do
                        {

					          echo '        
							<label><strong>Прізвище</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_pr'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Ім\'я</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_im'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>По батькові</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_bat'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Стать</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_stat'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Дата народження</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_dnar'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Група</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_group'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Навчання за регіональним замовленням</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_contract'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Рік завершення школи</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_rik_zaver'].'" style="background:white; color:#0c0e0c; border:none;">


							<label><strong>Регіон проживання</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_region_type'].'" style="background:white; color:#0c0e0c; border:none;">

							<label><strong>Освіта</strong></label>
							<input type="text" class="form-control" readonly value="'.$row['s_osvita_type'].'" style="background:white; color:#0c0e0c; border:none;">

									<p class="mt-3"><strong>Соціальна категорія</strong></p>

									<div class="card p-3 mb-4" style="background-color: #f8f9fa; border: 1px solid #ced4da;">
									<div class="row row-cols-1 row-cols-md-2 g-3 p-3">

										<div class="col"><strong>Діти-сироти:</strong> ' . (!empty($row['s_sirota']) ? $row['s_sirota'] : 'Ні') . '</div>
										<div class="col"><strong>Переселенці:</strong> ' . (!empty($row['s_peresel']) ? $row['s_peresel'] : 'Ні') . '</div>
										<div class="col"><strong>Чорнобильці:</strong> ' . (!empty($row['s_chernob']) ? $row['s_chernob'] : 'Ні') . '</div>
										<div class="col"><strong>Інваліди:</strong> ' . (!empty($row['s_inval']) ? $row['s_inval'] : 'Ні') . '</div>
										<div class="col"><strong>Малозабезпечені:</strong> ' . (!empty($row['s_malozab']) ? $row['s_malozab'] : 'Ні') . '</div>
										<div class="col"><strong>Діти учасників АТО:</strong> ' . (!empty($row['s_ato']) ? $row['s_ato'] : 'Ні') . '</div>
										<div class="col"><strong>Учасники бойових дій:</strong> ' . (!empty($row['s_war_act']) ? $row['s_war_act'] : 'Ні') . '</div>
										<div class="col"><strong>Діти загиблих майданівців:</strong> ' . (!empty($row['s_ditzag']) ? $row['s_ditzag'] : 'Ні') . '</div>
										<div class="col"><strong>Стипендіати ВР:</strong> ' . (!empty($row['s_rada']) ? $row['s_rada'] : 'Ні') . '</div>
										<div class="col"><strong>Шахтарі / діти шахтарів:</strong> ' . (!empty($row['s_shahter']) ? $row['s_shahter'] : 'Ні') . '</div>
									

									</div>
									</div>
									<hr>

									<label>Дата перенесення в архів</label>
									<input type="text" class="form-control" readonly value="'.$row['operation_date'].'" style="background:white; color:#0c0e0c; border:none;" >

									
									<label>Причина</label>
									<input type="text" class="form-control" readonly value="'.$row['operation_name'].'" style="background:white; color:#0c0e0c; border:none;" >

									<label>Адреса</label>
									<input type="text" class="form-control" readonly value="'.$row['s_adresa'].'" style="background:white; color:#0c0e0c; border:none;" >

									<label>Тел.№ студента</label>
									<input type="text" class="form-control" readonly value="'.$row['s_tels'].'" style="background:white; color:#0c0e0c; border:none;" >

									<label>Тел.№ батька</label>
									<input type="text" class="form-control" readonly value="'.$row['s_telb'].'" style="background:white; color:#0c0e0c; border:none;" >

									<label>Тел.№ матері</label>
									<input type="text" class="form-control" readonly value="'.$row['s_telm'].'" style="background:white; color:#0c0e0c; border:none;" >


								  ';
						}
					
                      while ($row = mysqli_fetch_array($result));	
					}
	      
				?>

					
							
							</form>

 
  
      
						</div>
					</div>
				</div>
			</div>
			
			
                
                        <!-- End Sample Menu -->
                    </div>
                </div>
            </div>
          
		  <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

  
		<script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
	<script src="async.js"></script>
 </body>
</html>