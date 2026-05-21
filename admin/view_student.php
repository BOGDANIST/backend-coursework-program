<?php
session_start();

	if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer']))
	{   
		header("Location: admin_panel.php");
	}    
else
	{
	 include ("../include/db_connect.php");
 	 error_reporting(0);
	
	  $id_st=$_GET["id_st"];
	
	 if($_POST["submit_save"])
	 {
		if($_POST["form_group"]!='')
	    {
		$name_group=$_POST["form_group"];
			$result = mysql_query("SELECT * FROM st_group WHERE g_im='$name_group'",$linc);
			if (mysql_num_rows($result)>0)
                    {$row = mysql_fetch_array($result);
					 echo $g_im=$row["g_im"];
					 echo $g_spec=$row['g_spec'];
					 echo $g_specz=$row['g_specz'];
					 echo $g_course=$row['g_course'];
					 echo $g_formnavch=$row['g_formnavch'];
					 echo $g_vipusk=$row['g_vipusc'];
					 echo $g_galuz=$row['g_galuz'];
					mysql_query("UPDATE student SET s_group='$g_im' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_galuz='$g_galuz' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_spec='$g_spec' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_specz='$g_specz' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_form_navch='$g_formnavch' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_group_vip='$g_vipusk' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_cours='$g_course' WHERE s_id='$id_st'",$linc);
					};
		}		
				   if($_POST["form_dnar_stud"]!='')
				   {$birthday = new DateTime($_POST["form_dnar_stud"]);
					$interval = $birthday->diff(new DateTime);
					$vik=$interval->y;
				   }
					
					echo $_POST["form_pr_stud"];		
					mysql_query("UPDATE student SET s_pr='{$_POST["form_pr_stud"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_im='{$_POST["form_im_stud"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_bat='{$_POST["form_bat_stud"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_dnar='{$_POST["form_dnar_stud"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_vik='{$vik}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_rik_zaver='{$_POST["form_zscool_stud"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_adresa='{$_POST["form_adres"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_tels='{$_POST["form_tel_st"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_telb='{$_POST["form_tel_bat"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_telm='{$_POST["form_tel_mut"]}' WHERE s_id='$id_st'",$linc);
					mysql_query("UPDATE student SET s_osvita_type='{$_POST["s_osvita_type"]}' WHERE s_id='$id_st'",$linc);
					
					if($_POST["form_stat_select"]!=''){mysql_query("UPDATE student  SET s_stat='{$_POST["form_stat_select"]}' WHERE  s_id='$id_st'",$linc);}			
					if($_POST["form_zamovl"]!=''){mysql_query("UPDATE student  SET s_contract='{$_POST["form_zamovl"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_reg_type"]!=''){mysql_query("UPDATE student  SET s_region_type='{$_POST["form_reg_type"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_region"]!=''){mysql_query("UPDATE student  SET s_region='{$_POST["form_region"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["s_osvita_type"]!=''){mysql_query("UPDATE student  SET s_osvita_type='{$_POST["s_osvita_type"]}' WHERE  s_id='$id_st'",$linc);}

					if($_POST["form_sirot"]!=''){mysql_query("UPDATE student SET s_sirota='{$_POST["form_sirot"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_peres"]!=''){mysql_query("UPDATE student SET s_peresel='{$_POST["form_peres"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_chernob"]!=''){mysql_query("UPDATE student SET s_chernob='{$_POST["form_chernob"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_ivalid"]!=''){mysql_query("UPDATE student SET s_inval='{$_POST["form_ivalid"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_malozab"]!=''){mysql_query("UPDATE student SET s_malozab='{$_POST["form_malozab"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_ato"]!=''){mysql_query("UPDATE student SET s_ato='{$_POST["form_ato"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_uchbd"]!=''){mysql_query("UPDATE student SET s_war_act='{$_POST["form_uchbd"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_ditzag"]!=''){mysql_query("UPDATE student SET s_ditzag='{$_POST["form_ditzag"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_stepver"]!=''){mysql_query("UPDATE student SET s_rada='{$_POST["form_stepver"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_shaht"]!=''){mysql_query("UPDATE student SET s_shahter='{$_POST["form_shaht"]}' WHERE  s_id='$id_st'",$linc);}
		
	echo 'Зміни проведені';
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
                  $result = mysqli_query($linc, "SELECT * FROM student WHERE s_id='$id_st'");
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

  
 </body>
</html>