<?php
session_start();
if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer'])) {   
    header("Location: admin_panel.php");
} else {
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
		
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
	<style>
  .fakeimg {
      height: 200px;
      background: #aaa;
			}
	body{

		background-color: #3ac1ff6f;
		}
		table{
			padding: 5px;
			margin: 10px;
			font-size: 20px;

		}
		.panel{
			padding-top: 10px;
			font-size: 20px;
			border-width: 2px;
			border-color: #256279;
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
                              <img style="width: 100%; margin-bottom: 20px;" src="../assets/img/logo.png" alt="Logo" />
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>
            <!-- End Header -->
			
			<!-- User Menu -->
			<?php include ("../include/adm_menu.php");?>
			 <?php include ("../include/background_icon.php");?>
            <!-- End User Menu -->
           
            <!-- === END HEADER === -->
 
		   <!-- === BEGIN CONTENT === -->
			<div class="container bottom-border">
				<div class="row padding-top-40">
					<div class="col-md-12">
						<div class="col-md-12" style="margin-top:10px;">
                             <div class="tab-content">
                                   
									<div class="tab-panel active in fade" id="faq">
                                        <div class="panel-group" id="accordion">
                                                <h2 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#3c695c;"><strong>Зведені статистичні дані</strong></h2> 
												<p>
											<?php 
												 $result_records =  mysqli_query($linc, "SELECT * FROM student");
												 if (mysqli_num_rows( $result_records)>0) echo "<h3><strong >&nbsp Всього у коледжі навчаеться:&nbsp</strong>".mysqli_num_rows( $result_records)."&nbspстудента(ів), <strong>з яких:</strong></h3>";
											?>
												</p>
              
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по формі навчання:</strong>
											</tr>								
											<tr>
											<td width="500px">денна:</td>
											<?php                                      
				
											$result_fn_dn=mysqli_query($linc, "SELECT * FROM student WHERE s_form_navch='Денна'" );
											if (mysqli_num_rows($result_fn_dn)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows( $result_fn_dn).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
														<td width="500px">заочна:</td>
											
											
											<?php 	
											$result_fn_zao=mysqli_query($linc,"SELECT * FROM student WHERE s_form_navch='Заочна'" );
											if (mysqli_num_rows($result_fn_zao)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_fn_zao).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>
											
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по виду замовлення:</strong>
											</tr>								
											<tr>
											<td width="500px">навчання за регіональним замовленням:</td>
											<?php                                      
											$result_fn_derg=mysqli_query($linc, "SELECT * FROM student WHERE s_contract='Так'" );
											if (mysqli_num_rows($result_fn_derg)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows( $result_fn_derg).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
														<td width="500px">навчання за кошти фізичних або юридичних осіб:</td>
											<?php 	
											$result_fn_contr=mysqli_query($linc,"SELECT * FROM student WHERE s_contract='Ні'" );
											if (mysqli_num_rows($result_fn_contr)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_fn_contr).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>
											
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по спеціальностям:</strong>
											</tr>								
											
											<tr>
											<td width="500px">017 Фізична культура і спорт:</td>
											<?php                                      
				
											$result_spec1=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='017 Фізична культура і спорт'" );
											if (mysqli_num_rows($result_spec1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_spec1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>	
											
											<tr>
											<td width="500px">051 Економіка:</td>
											<?php                                      
				
											$result_spec2=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='051 Економіка'" );
											if (mysqli_num_rows($result_spec2)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_spec2).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>	
											
											<tr>
											<td width="500px">071 Облік і опадаткування:</td>
											<?php                                      
											$result_spec3=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='071 Облік і оподаткування'" );
											if (mysqli_num_rows($result_spec3)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_spec3).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>	
											
											<tr>
											<td width="500px">072 Фінанси, банківська справа та страхування:</td>
											<?php                                      
											$result_spec4=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='072 Фінанси, банківська справа та страхування'" );
											if (mysqli_num_rows($result_spec4)>0)
												{
												 echo '
														<td width="200px"><strong>'.mysqli_num_rows($result_spec4).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>	
											
											<tr>
											<td width="500px">081 Право:</td>
											<?php                                      
											$result_spec5=mysqli_query($linc, "SELECT * FROM student WHERE s_spec='081 Право'" );
											if (mysqli_num_rows($result_spec5)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_spec5).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>															
											
											<tr>
											<td width="500px">121 Інженерія програмного забезпечення:</td>
											<?php 	
											$result_spec6=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='121 Інженерія програмного забезпечення'" );
											if (mysqli_num_rows($result_spec6)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_spec6).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											<tr>
											<td width="500px">133 Галузеве машинобудування:</td>
											<?php 	
											$result_spec7=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='133 Галузеве машинобудування'" );
											if (mysqli_num_rows($result_spec7)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_spec7).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											<tr>
											<td width="500px">136 Металургія:</td>
											<?php 	
											$result_spec8=mysqli_query($linc,"SELECT * FROM student WHERE s_spec='136 Металургія'" );
											if (mysqli_num_rows($result_spec8)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_spec8).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											</table>
											</div>
											</div>
											
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по курсам:</strong>
											</tr>								
											
											<tr>
											<td width="500px">I курс:</td>
											<?php                                      
											$result_cours1=mysqli_query($linc,"SELECT * FROM student WHERE s_cours='1'" );
											if (mysqli_num_rows($result_cours1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_cours1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>															
											
											<tr>
											<td width="500px">II курс:</td>
											<?php 	
											$result_cours2=mysqli_query($linc,"SELECT * FROM student WHERE s_cours='2'" );
											if (mysqli_num_rows($result_cours2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_cours2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											<tr>
											<td width="500px">III курс:</td>
											<?php 	
											$result_cours3=mysqli_query($linc,"SELECT * FROM student WHERE s_cours='3'" );
											if (mysqli_num_rows($result_cours3)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_cours3).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											<tr>
											<td width="500px">IV курс:</td>
											<?php 	
											$result_cours4=mysqli_query($linc,"SELECT * FROM student WHERE s_cours='4'" );
											if (mysqli_num_rows($result_cours4)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_cours4).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											</table>
											</div>
											</div>											
											
										
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по статі:</strong>
											</tr>								
											<tr>
											<td width="500px">чоловіча:</td>
											<?php                                      
											$result_stat1=mysqli_query($linc,"SELECT * FROM student WHERE s_stat='Чоловік'" );
											if (mysqli_num_rows($result_stat1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_stat1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
														<td width="500px">жіноча:</td>
											<?php 	
											$result_stat2=mysqli_query($linc,"SELECT * FROM student WHERE s_stat='Жінка'" );
											if (mysqli_num_rows($result_stat2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_stat2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>

											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- по віку:</strong>
											</tr>								
											<tr>
											<td width="500px">14 років:</td>
											<?php                                      
											$result_vik1=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=14" );
											if (mysqli_num_rows($result_vik1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_vik1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>												
											<tr>
											<td width="500px">15 років:</td>
											<?php                                      
											$result_vik1=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=15" );
											if (mysqli_num_rows($result_vik1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_vik1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
											</tr>	
											<tr>
											<td width="500px">16 років:</td>
											<?php 	
											$result_vik2=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=16" );
											if (mysqli_num_rows($result_vik2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>
											</tr>	
											
											<tr>
											<td width="500px">17 років:</td>
											<?php 	
											$result_vik3=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=17" );
											if (mysqli_num_rows($result_vik3)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik3).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   												
											</tr>
											
											<tr>
											<td width="500px">18 років:</td>
											<?php 	
											$result_vik4=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=18" );
											if (mysqli_num_rows($result_vik4)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik4).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   												
											</tr>
											
											<tr>
											<td width="500px">19 років:</td>
											<?php 	
											$result_vik5=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=19" );
											if (mysqli_num_rows($result_vik5)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik5).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   												
											</tr>
										
											<tr>
											<td width="500px"> 20 років:</td>
											<?php 	
											$result_vik6=mysqli_query($linc,"SELECT * FROM student WHERE s_vik=20" );
											if (mysqli_num_rows($result_vik6)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik6).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   												
											</tr>
											
											<tr>
											<td width="500px"> більше 20 років:</td>
											<?php 	
											$result_vik7=mysqli_query($linc,"SELECT * FROM student WHERE s_vik>20" );
											if (mysqli_num_rows($result_vik7)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_vik7).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   												
											</tr>
											
											</table>
											</div>
											</div>
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- освіта:</strong>
											</tr>								
											<tr>
											<td width="500px">базова загальна середня освіта:</td>
											<?php                                      
											$result_osv1=mysqli_query($linc,"SELECT * FROM student WHERE s_osvita_type='Базова загальна середня освіта'" );
											if (mysqli_num_rows($result_osv1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_osv1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
														<td width="500px">повна загальна середня освіта:</td>
											<?php 	
											$result_osv2=mysqli_query($linc,"SELECT * FROM student WHERE s_osvita_type='Повна загальна середня освіта'" );
											if (mysqli_num_rows($result_osv2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_osv2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>

											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- місце проживання:</strong>
											</tr>								
											<tr>
											<td width="500px">місто:</td>
											<?php                                      
											$result_reg1=mysqli_query($linc,"SELECT * FROM student WHERE s_region_type='Місто'" );
											if (mysqli_num_rows($result_reg1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_reg1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
														<td width="500px">сільська місцевість:</td>
											<?php 	
											$result_reg2=mysqli_query($linc,"SELECT * FROM student WHERE s_region_type='Сільська місцевість'" );
											if (mysqli_num_rows($result_reg2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_reg2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>
										
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- область проживання:</strong>
											</tr>								
											<tr>
											<td width="500px">Вінницька:</td>
											<?php                                      
											$result_obl1=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Вінницька'" );
											if (mysqli_num_rows($result_obl1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_obl1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
											<tr>
											<td width="500px">Волинська:</td>
											<?php 	
											$result_obl2=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Волинська'" );
											if (mysqli_num_rows($result_obl2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Дніпропетровська:</td>
											<?php 	
											$result_obl3=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Дніпропетровська'" );
											if (mysqli_num_rows($result_obl3)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl3).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											<tr>
											<td width="500px">Донецька:</td>
											<?php 	
											$result_obl4=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Донецька'" );
											if (mysqli_num_rows($result_obl4)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl4).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Житомирська:</td>
											<?php 	
											$result_obl5=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Житомирська'" );
											if (mysqli_num_rows($result_obl5)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl5).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Закарпатська:</td>
											<?php 	
											$result_obl6=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Закарпатська'" );
											if (mysqli_num_rows($result_obl6)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl6).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Запорізська:</td>
											<?php 	
											$result_obl7=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Запорізська'" );
											if (mysqli_num_rows($result_obl7)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl7).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Івано-Франківська:</td>
											<?php 	
											$result_obl8=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Івано-Франківська'" );
											if (mysqli_num_rows($result_obl8)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl8).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Київська:</td>
											<?php 	
											$result_obl9=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Київська'" );
											if (mysqli_num_rows($result_obl9)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl9).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Кіровоградська:</td>
											<?php 	
											$result_obl10=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Кіровоградська'" );
											if (mysqli_num_rows($result_obl10)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl10).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Луганська:</td>
											<?php 	
											$result_obl11=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Луганська'" );
											if (mysqli_num_rows($result_obl11)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl11).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Львівська:</td>
											<?php 	
											$result_obl12=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Львівська'" );
											if (mysqli_num_rows($result_obl12)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl12).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Миколаївська:</td>
											<?php 	
											$result_obl13=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Миколаївська'" );
											if (mysqli_num_rows($result_obl13)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl13).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Одеська:</td>
											<?php 	
											$result_obl14=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Одеська'" );
											if (mysqli_num_rows($result_obl14)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl14).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Полтавська:</td>
											<?php 	
											$result_obl15=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Полтавська'" );
											if (mysqli_num_rows($result_obl15)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl15).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Рівненська:</td>
											<?php 	
											$result_obl16=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Рівненська'" );
											if (mysqli_num_rows($result_obl16)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl16).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Сумська:</td>
											<?php 	
											$result_obl17=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Сумська'" );
											if (mysqli_num_rows($result_obl17)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl17).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Тернопільська:</td>
											<?php 	
											$result_obl18=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Тернопільська'" );
											if (mysqli_num_rows($result_obl18)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl18).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Харкіська:</td>
											<?php 	
											$result_obl19=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Харкіська'" );
											if (mysqli_num_rows($result_obl19)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl19).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Херсонська:</td>
											<?php 	
											$result_obl20=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Херсонська'" );
											if (mysqli_num_rows($result_obl20)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl20).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Хмельницька:</td>
											<?php 	
											$result_obl21=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Хмельницька'" );
											if (mysqli_num_rows($result_obl21)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl21).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Черкаська:</td>
											<?php 	
											$result_obl22=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Черкаська'" );
											if (mysqli_num_rows($result_obl22)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl22).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Чернівецька:</td>
											<?php 	
											$result_obl23=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Чернівецька'" );
											if (mysqli_num_rows($result_obl23)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl23).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">Чернігівська:</td>
											<?php 	
											$result_obl24=mysqli_query($linc,"SELECT * FROM student WHERE s_region='Чернігівська'" );
											if (mysqli_num_rows($result_obl24)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_obl24).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											</table>
											</div>
											</div>
											
											<div class="panel panel-default style:margin-top:0px;font-size:10px;">
											<div class="col-md-10" style:margin-top:0px; >
											<table>  
											<tr>
											<strong>- за соціальними категоріями:</strong>
											</tr>								
											<tr>
											<td width="500px">діти-сироти та діти позбавлені батьківського піклування:</td>
											<?php                                      
											$result_sk1=mysqli_query($linc,"SELECT * FROM student WHERE s_sirota='Так'" );
											if (mysqli_num_rows($result_sk1)>0)
												{
												 echo '
																
														<td width="200px"><strong>'.mysqli_num_rows($result_sk1).'</strong></td>
													   ';}
											else echo '
														<td width="200px"><strong>0</strong></td>
													   ';
											?>  
														</tr>	
											<tr>
											<td width="500px">переселенці:</td>
											<?php 	
											$result_sk2=mysqli_query($linc,"SELECT * FROM student WHERE s_peresel='Так'" );
											if (mysqli_num_rows($result_sk2)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk2).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">чорнобильці:</td>
											<?php 	
											$result_sk3=mysqli_query($linc,"SELECT * FROM student WHERE s_chernob='Так'");
											if (mysqli_num_rows($result_sk3)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk3).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											<tr>
											<td width="500px">інваліди:</td>
											<?php 	
											$result_sk4=mysqli_query($linc,"SELECT * FROM student WHERE s_inval='Так'");
											if (mysqli_num_rows($result_sk4)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk4).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">малозабезпечені:</td>
											<?php 	
											$result_sk5=mysqli_query($linc,"SELECT * FROM student WHERE s_malozab='Так'");
											if (mysqli_num_rows($result_sk5)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk5).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">діти учасників АТО:</td>
											<?php 	
											$result_sk6=mysqli_query($linc,"SELECT * FROM student WHERE s_ato='Так'");
											if (mysqli_num_rows($result_sk6)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk6).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">учасники бойових дій та їх діти:</td>
											<?php 	
											$result_sk7=mysqli_query($linc,"SELECT * FROM student WHERE s_war_act='Так'");
											if (mysqli_num_rows($result_sk7)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk7).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">діти загиблих майданівців:</td>
											<?php 	
											$result_sk8=mysqli_query($linc,"SELECT * FROM student WHERE s_ditzag='Так'");
											if (mysqli_num_rows($result_sk8)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk8).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">стипендіати Верховної ради:</td>
											<?php 	
											$result_sk9=mysqli_query($linc,"SELECT * FROM student WHERE s_rada='Так'");
											if (mysqli_num_rows($result_sk9)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk9).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											<tr>
											<td width="500px">шахтарі і діти шахтарів:</td>
											<?php 	
											$result_sk10=mysqli_query($linc,"SELECT * FROM student WHERE s_shahter='Так'");
											if (mysqli_num_rows($result_sk10)>0)
												{	
												echo '								
														<td width="200px"><strong>'.mysqli_num_rows($result_sk10).'</strong></td>
														 
													 '; }
												 
											else  echo '
														<td width="200px"><strong>0</strong></td>
												       ';
											?>   	
											</tr>
											
											</table>
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

          
		  <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

            <!-- End Footer -->
            <!-- JS -->
          <script type="text/javascript" src="../assets/js/jquery.min.js" type="text/javascript"></script>
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
            <!-- End JS --><div style="position:absolute;left:-3072px;top:0"><div class="width=100% height=100% align-left"></div><div class="align-left" width="1"></div><a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#108;&#105;&#110;&#105;&#121;&#97;&#111;&#107;&#111;&#110;&#46;&#114;&#117;">&#1086;&#1082;&#1085;&#1072;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#112;&#114;&#101;&#109;&#105;&#117;&#109;&#107;&#97;&#100;&#114;&#46;&#114;&#117;">&#1092;&#1086;&#1090;&#1086;&#1075;&#1088;&#1072;&#1092;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#117;&#110;&#105;&#115;&#104;&#97;&#98;&#108;&#111;&#110;.&#99;&#111;&#109;">html php</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#114;&#105;&#116;&#117;&#97;&#108;&#103;&#97;&#114;&#97;&#110;&#116;&#46;&#114;&#117;">&#1087;&#1072;&#1084;&#1103;&#1090;&#1085;&#1080;&#1082;&#1080;</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#116;&#117;&#116;&#108;&#111;&#118;&#101;&#46;&#114;&#117;">&#1079;&#1085;&#1072;&#1082;&#1086;&#1084;&#1089;&#1090;&#1074;&#1072;</a></div></body>
 <body>
</html>