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
	
   
            <!-- Portfolio -->
            		   <!-- === BEGIN CONTENT === -->
	
	
    
    
        
          
			
         <div class="container bottom-border">
            <div class="row padding-top-40">
                <div class="col-md-12">
                         
     
			
		                   
												
		<?php  

			$result = mysqli_query($linc, "SELECT * FROM student");
				   
				$i=1;
				$result=mysqli_query($linc, "SELECT * FROM student ORDER BY s_pr");
					if (mysqli_num_rows($result)>0)
					echo '<h3 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#56693c;"><strong>Список студентів за алфавітом:&nbsp всього студентів -&nbsp';
                    echo mysqli_num_rows($result);
					 echo '</h3>';
				     
			 $row = mysqli_fetch_array($result); 
					  do{
						 if ($row["image"]=='') 
						 {$img_path='../uploads_images/0_0.png';}
					     else {$img_path = '../uploads_images/'.$row["image"];}
						 echo '
							<div class="panel panel-default style:margin-top:0px;font-size:10px">
                               <div class="col-md-16" style="margin-top:0px; style="margin-top:10px">
                                <table style="table-layout:fixed;  margin-left:10%; margin-right:10%">  
									<tr>
									<td style="width:30px; "><strong>'.$i. '</strong></td>
									<td style="width:120px; "><strong>'.$row['s_pr'].'</strong></td>
									<td style="width:80px; "><strong>'.$row['s_im'].'</strong></td>
									<td style="width:120px; "><strong>'.$row['s_bat'].'</strong></td>
									<td style="width:70px; "><img src="'.$img_path.'" width="50px" heigth="50px"/></td>  
									<td style="width:50px; "><strong>'.$row['s_group'].'</strong></td>
									<td style="width:50px;"><strong>курс &nbsp'.$row['s_cours'].'</strong></td>
									<td style="width:200px;  text-decoration-line: underline;"><strong><a href="view_student.php?id_st='.$row["s_id"].'">Перегляд</a>
									</tr>								
								
								</table>
								</div>
									</div>
							   '; 
							   $i=$i+1;   
						}
						while ($row = mysqli_fetch_array($result));  
                    
			
	 
				?>   
													
                                               
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

</html>