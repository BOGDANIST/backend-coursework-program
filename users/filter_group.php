
<?php

session_start();

if ($_SESSION['auth_user']!="user")
	{   echo 'Доступ заборонений';
	    unset($_SESSION['auth_user']);
		header("Location:index.php");
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
        <title>АІС БКПЕП</title>
        <!-- Meta -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Favicon -->
        <link href="favicon.ico" rel="shortcut icon">
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
        <link rel="stylesheet" href="../assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/custom.css" rel="stylesheet">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    
	<style>
  .fakeimg {
      height: 200px;
      background: #aaa;
			}
	</style>
	
	</head>
   
    <div id="body-bg">
            <!-- Phone/Email -->
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
			<?php include ("../include/user_menu.php");?>
            <!-- End Top Menu -->
           
            <!-- === END HEADER === -->
         


		   <!-- === BEGIN CONTENT === -->
			<div class="container bottom-border">
				<div class="row padding-top-40">
					<div class="col-md-12">
						<div class="col-md-12" style="margin-top:10px;">
                             <div class="tab-content">
                                   
									<div class="tab-panel active in fade" id="faq">
                                        <div class="panel-group" id="accordion">
                                                <h3 class="margin-bottom" style="text-align:center; color:#56693c;"><strong>Список груп</strong></h3> 
												<p style="text-align:center; color:#56693c;">
											<?php 
												 $result_group =  mysqli_query($linc, "SELECT * FROM st_group");
												 if (mysqli_num_rows( $result_group)>0) echo "<strong>Всього у коледжі навчаеться ".mysqli_num_rows( $result_group)." груп, з яких:</strong>";
											?> </p>
												<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc, "SELECT * FROM st_group WHERE g_formnavch='Денна' AND g_course='1'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>І курс, денне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
												<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc, "SELECT * FROM st_group WHERE g_formnavch='Заочна' AND g_course='1'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>І курс, заочне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>			
											
											<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc,"SELECT * FROM st_group WHERE g_formnavch='Денна' AND g_course='2'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІІ курс, денне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
												<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc, "SELECT * FROM st_group WHERE g_formnavch='Заочна' AND g_course='2'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІІ курс, заочне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
											<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc,"SELECT * FROM st_group WHERE g_formnavch='Денна' AND g_course='3'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІІІ курс, денне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
												<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc, "SELECT * FROM st_group WHERE g_formnavch='Заочна' AND g_course='3'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІІІ курс, заочне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
											<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc,"SELECT * FROM st_group WHERE g_formnavch='Денна' AND g_course='4'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІV курс, денне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			 																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
											
												<div class="col-md-12" style="margin-top:0px;border:none;" >
												<?php                                      
						
													$result_group1=mysqli_query($linc, "SELECT * FROM st_group WHERE g_formnavch='Заочна' AND g_course='4'");
													if (mysqli_num_rows($result_group1)>0)
													{$i='1';
														$row = mysqli_fetch_array($result_group1);
															echo '<p style="margin-left:10px; margin-bottom:0px; margin-top:0px;" >
																  <strong>ІV курс, заочне відділення:</strong>	
																  </p>';
															do{
																echo '
																	<div class="panel panel-default style:margin-top:0px;font-size:10px;">
																	   <div class="col-md-10" style="margin-top:0px;">
																		<table style="table-layout:fixed; width:800px;">  
																			<tr>
																			<td style="width:15px; "><strong>'.$i.'</strong></td>
																			<td style="width:100px; "><strong>'.$row['g_im'].'</strong></td>
																			<td style="width:150px; "><strong>Кількість студентів:'.$row['g_count_stud'].'</strong></td>
																			<td style="width:100px; text-decoration-line: underline;"><strong><a href="edit_group.php?g_im_edit='.$row["g_im"].'">Змінити</a></strong></td>
																			<td style="width:100px;text-decoration-line: underline;"><strong><a href="filter_group.php?g_im_delete='.$row["g_im"].'" onclick="return confirmSpelll();">Видалити групу</a></strong></td>
																			</tr>								
																		 
																		</table>
																		</div>
																	</div>
																	'; 
																	$i=$i+1;   
																}
																while ($row = mysqli_fetch_array($result_group1));  												
													}
												?>  
												</div>
										
										
										
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>

          
		  <!-- Footer -->
            <div id="footer" class="background-grey">
                <div class="container">
                    <div class="row">
                        <!-- Footer Menu -->
                        <div id="footermenu" class="col-md-8">
                            <ul class="list-unstyled list-inline">
                                <li>
                                    <a href="bcpep.org.ua" target="_blank">bcpep.org.ua</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Footer Menu -->
                        <!-- Copyright -->
                        <div id="copyright" class="col-md-4">
                            <p class="pull-right">(c) <script type='text/javascript'>var mdate = new Date();document.write(mdate.getFullYear());</script> BCPEP Cocporation</p>
                        </div>
                        <!-- End Copyright -->
                    </div>
                </div>
            </div>
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