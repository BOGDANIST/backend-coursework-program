<?php
session_start();
	if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer']))
	{   unset($_SESSION['auth_user']);
		header("Location:../admin/input.php");
	}   
else
	{
	 include ("../include/db_connect.php");
	 error_reporting(0);

echo '
<script>
function confirmSpelll() {
    if (confirm("Ви підтверджуєте видалення?")) {
        return true;
    } else {
        return false;
    }
}
 
</script>
';
if ($_GET["id_st"]!="")
	{$id =$_GET["id_st"];
			  
			$operation_date = date('Y-m-d'); // або ваша дата
			$operation_name = "Видалено із бази даних"; // причина операції

			// Перевіряємо чи задано ідентифікатор студента, дату та причину
			if (empty($id) || empty($operation_date) || empty($operation_name)) {
				echo "Заповніть, будь ласка, дату операції, причину та визначте студента.";
				exit;
			}
			// Починаємо транзакцію (якщо потрібно для цілісності)
			

			// Перш за все – вставляємо дані студента до старої таблиці "old_student"
			// Припустимо, що таблиці student та old_student мають однакову структуру, а також в old_student додані два поля:
			// operation_date та operation_name.
			// Зауважте: тут перелічено поля, змініть їх відповідно до вашої схеми.
			    mysqli_begin_transaction($linc);
			try {
				$insert_query = "INSERT INTO old_student (
										s_id, s_pr, s_im, s_bat, s_dnar, s_vik, s_adresa,
										s_tels, s_telb, s_telm, s_stat, s_contract, s_osvita_type,
										s_rik_zaver, s_region_type, s_region, s_group, s_galuz,
										s_spec, s_specz, s_form_navch, s_cours, s_vip,
										operation_date, operation_name
									)
									SELECT 
										s_id, s_pr, s_im, s_bat, s_dnar, s_vik, s_adresa,
										s_tels, s_telb, s_telm, s_stat, s_contract, s_osvita_type,
										s_rik_zaver, s_region_type, s_region, s_group, s_galuz,
										s_spec, s_specz, s_form_navch, s_cours, s_vip,
										'$operation_date', '$operation_name'
									FROM student
									WHERE s_id = '$id'"; // ваш SELECT ... INSERT INTO old_student

				if (!mysqli_query($linc, $insert_query)) {
					throw new Exception("Insert failed: ".mysqli_error($linc));
				}

				$delete_query = "DELETE FROM student WHERE s_id = '$id'";
				if (!mysqli_query($linc, $delete_query)) {
					throw new Exception("Delete failed: ".mysqli_error($linc));
				}

				mysqli_commit($linc);
				$success = "Студента успішно переміщено до історії та видалено з бази.";
			} catch (Exception $e) {
				mysqli_rollback($linc);
				$error = "Помилка: " . $e->getMessage();
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
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        <!-- Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
    
		
	
		
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
            		   <!-- === BEGIN CONTENT === -->
	
	
    
    
        
          
			
         <div class="container bottom-border">
            <div class="row padding-top-40">
                <div class="col-md-12">
                         
     
			
		                   
												
		<?php  

			$result = mysqli_query($linc, "SELECT * FROM student");
				   
				$i=1;
				$result=mysqli_query($linc, "SELECT * FROM student ORDER BY s_pr COLLATE utf8_unicode_ci");
					if (mysqli_num_rows($result)>0)
					echo '<h3 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#56693c;"><strong>Список студентів за алфавітом:&nbsp всього студентів -&nbsp';
                    echo mysqli_num_rows($result);
					 echo '</h3>';
				     
			 $row = mysqli_fetch_array($result); 
									echo '   
									<div class="col-md-12" >
									<table  class="table table-primary rounded-1 table-striped d-flex  table-layout: auto; table-responsive-md  fs-sm-1 text-decoration-bold">  
										';
             do{
						 if ($row["image"]=='') 
						 {$img_path='../uploads_images/0_0.png';}
					     else {$img_path = '../uploads_images/'.$row["image"];}

						 echo '
  
									<tr>
									<td style="white-space: nowrap; " ><strong>'.$i. '</strong></td>
									<td class="col-md-2 "><strong>'.$row['s_pr'].'</strong></td>
									<td class="col-md-1"><strong>'.$row['s_im'].'</strong></td>
									<td class="col-md-2"><strong>'.$row['s_bat'].'</strong></td>
									<td class="col-md-1 align-items-center text-center"><img class="img-fluid " style="max-height: 50px;" src="'.$img_path.'" /></td>  
									<td class="col-md-1 text-center"><strong>'.$row['s_group'].'</strong></td>
									<td class="col-md-1 text-center"><strong>курс &nbsp'.$row['s_cours'].'</strong></td>
									<td  style=" text-decoration-line: underline; padding-left:5px; width: 350px; text-align: center ; justify-content: center;"><strong><a href="view_student.php?id_st='.$row["s_id"].'">Перегляд</a> |
									<a href="edit_student.php?id_st='.$row["s_id"].'">Змінити</a> |
									<a href="filter_student.php?id_st='.$row["s_id"].'&pr_st='.$row["s_pr"].'&im_st='.$row["s_im"].'&bat_st='.$row["s_bat"].'" onclick="return confirmSpelll();">Видалити</a> </td>
									
																																						
									</tr>								
								

							   '; 
							   $i=$i+1;   
						}
						while ($row = mysqli_fetch_array($result));  
                        echo '
                        		</table>
								</div>
								
                        ';
			
	 
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
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

           
            <!-- End JS --><div style="position:absolute;left:-3072px;top:0"><div class="width=100% height=100% align-left"></div><div class="align-left" width="1"></div><a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#108;&#105;&#110;&#105;&#121;&#97;&#111;&#107;&#111;&#110;&#46;&#114;&#117;">&#1086;&#1082;&#1085;&#1072;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#112;&#114;&#101;&#109;&#105;&#117;&#109;&#107;&#97;&#100;&#114;&#46;&#114;&#117;">&#1092;&#1086;&#1090;&#1086;&#1075;&#1088;&#1072;&#1092;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#117;&#110;&#105;&#115;&#104;&#97;&#98;&#108;&#111;&#110;.&#99;&#111;&#109;">html php</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#114;&#105;&#116;&#117;&#97;&#108;&#103;&#97;&#114;&#97;&#110;&#116;&#46;&#114;&#117;">&#1087;&#1072;&#1084;&#1103;&#1090;&#1085;&#1080;&#1082;&#1080;</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#116;&#117;&#116;&#108;&#111;&#118;&#101;&#46;&#114;&#117;">&#1079;&#1085;&#1072;&#1082;&#1086;&#1084;&#1089;&#1090;&#1074;&#1072;</a></div></body>
 <body>
</html>