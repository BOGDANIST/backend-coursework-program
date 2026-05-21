<?php
session_start();
 
	if (!in_array($_SESSION['auth_user'], ['admin', 'editor']))
	{   unset($_SESSION['auth_user']);
		header("Location:../admin/input.php");
	}   
else
	{
	 include ("../include/db_connect.php");
	 error_reporting(0);
	
	if (isset($_POST['submit_add_student']))
	{  

    
//Перовірка заповнення полів
	
		if(empty($_POST["form_group"])) 
		{$error= "Не вибрано групу! ";
		
		}
		if(empty($_POST["form_pr_stud"])) 
		{$error= "Не введено прізвище! ";
		
		}
		if(empty($_POST["form_im_stud"])) 
		{$error= "Не введено ім'я! ";
		
		}
		if(empty($_POST["form_im_stud"])) 
		{$error= "Не введено по батьквові! ";
	
		} 
		// echo 'Кількість помилок:'.$error;
	 	
		if ($error=="")
		{
		   $name_group=$_POST["form_group"];
		
		//Розрахунок віку у повних роках	
				    if (isset($_POST["form_date_nar"])) 
				    {
				    $birthday = new DateTime($_POST["form_date_nar"]);
					$interval = $birthday->diff(new DateTime);
					 $vik=$interval->y;
					}
		//Перевірка стану прапорців								
					if(empty($_POST["form_sirot"])) $sirot='Ні';
					else $sirot='Так';
			
					if(empty($_POST["form_peres"])) $peres='Ні';
					else $peres='Так';
			
					if(empty($_POST["form_ivalid"])) $ivalid='Ні';
					else $ivalid='Так';
			
					if(empty($_POST["form_malozab"])) $malozab='Ні';
					else $malozab='Так';
			
					if(empty($_POST["form_uchbd"])) $uchbd='Ні';
					else $uchbd='Так';
	
		//Додавання запису в базу даних				
					mysqli_query($linc,"INSERT INTO student SET
					s_group='".$_POST["form_group"]."',
					s_pr='".$_POST["form_pr_stud"]."',
					s_im='".$_POST["form_im_stud"]."',
					s_bat='".$_POST["form_bat_stud"]."',
					s_stat='".$_POST["form_sex"]."',
					s_contract='".$_POST["form_zamovl"]."',
					s_dnar='".$_POST["form_date_nar"]."',
					s_vik='".$vik."',
					s_adresa='".$_POST["form_adres"]."',
					s_tels='".$_POST["form_tel_st"]."',
					s_telb='".$_POST["form_tel_bat"]."',
					s_telm='".$_POST["form_tel_mut"]."',
					s_osvita_type='".$_POST["form_osvita"]."',
					s_rik_zaver='".$_POST["form_zscool"]."',
					s_region_type='".$_POST["form_region_type"]."',
					s_region='".$_POST["form_region"]."',
					s_sirota='".$sirot."',
					s_peresel='".$peres."',
					s_inval='".$ivalid."',
					s_malozab='".$malozab."',
					s_war_act='".$uchbd."'");
					$success="Студента успішно додано";

							if($_POST["form_group"]!='')
	    			{
					$name_group=$_POST["form_group"];
					$result = mysqli_query($linc,"SELECT * FROM st_group WHERE g_im='$name_group'");
					if (mysqli_num_rows($result)>0)
                    {$row = mysqli_fetch_array($result);
						$g_im=$row["g_im"];
						$g_spec=$row['g_spec'];
						$g_specz=$row['g_specz'];
						$g_course=$row['g_course'];
						$g_formnavch=$row['g_formnavch'];
						$g_vipusk=$row['g_vipusc'];
						$g_galuz=$row['g_galuz'];
						$g_galuz=$row['g_galuz'];
						$g_vip=$row['g_vipusc'];

							mysqli_query($linc, "INSERT INTO student SET ...");
					$result = mysqli_query($linc, "SELECT LAST_INSERT_ID() as last_id");
					$row = mysqli_fetch_assoc($result);
					$id_st = $row['last_id'];

					 
					
					mysqli_query($linc,"UPDATE student SET s_group='$g_im' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_galuz='$g_galuz' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_spec='$g_spec' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_specz='$g_specz' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_form_navch='$g_formnavch' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_group_vip='$g_vipusk' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_cours='$g_course' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_vip='$g_vip' WHERE s_id='$id_st'");
					};
					}	
				
			};
			
			//Визначення ідентифікатора доданого студента
			$id_student=mysqli_insert_id($linc);
             $id_student=mysqli_insert_id($linc);
					 if(!mysqli_query($linc, $query)){
					
					}
					$id_student = mysqli_insert_id($linc);
					
			//Вибір одного фала
		    if (isset($_FILES['my_file_one'])) 
			{$myFile1 = $_FILES['my_file_one'];
			 include("../modules/upload_image.php");
			} 
			
			//Вибір групи файлів
			if (isset($_FILES['my_files'])) 
			{$myFiles = $_FILES['my_files'];
			 include("../modules/upload_gallery.php");
			
			

            /* ?>
                    <p>
					    Name: <?= $myFile1["name"][0] ?><br>
						Temporary file: <?= $myFile1["tmp_name"][0] ?><br>
                        Type: <?= $myFile1["type"][0] ?><br>
                        Size: <?= $myFile1["size"][0] ?><br>
                        Error: <?= $myFile1["error"][0] ?><br>
                    </p>
            <?php*/
			};
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
	</head>
<body>   
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
                              <img style="width: 100%;"	 src="../assets/img/logo.png" alt="Logo" />
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
           
           
		   <!-- === BEGIN CONTENT === -->
	      <div class="container bottom-border">
         	<div id="base">
				<div id="content">
				  <div class="container background-white " style="margin:0px; padding:10px;">
                    <div class="row " style="margin:10px; padding:0px;">
                        <!-- Register Box -->
                        <div class="col-md-8 col-md-offset-2 col-sm-offset-2 d-flex ">
                           
							<form class="signup-page  needs-validation" method="POST"  enctype="multipart/form-data">
                                <div class="signup-header">
                                    <h2 style="color:#76d5fa;"><center><strong>Введення даних про нового студента</strong></center></h2>
                                    <p>* позначені поля обов'язкові для заповнення</p>
                                </div>
								<label for="sel1">Виберіть групу*</label>
								<?php
									$query_group = mysqli_query($linc, "SELECT * FROM st_group");
									echo  '<select class="form-control" name="form_group" id="sel1" required  size="5" style="color:#0c0e0c;"';
									echo '<option value="group_id"></option>';
									while ($temp = mysqli_fetch_assoc($query_group))
									{
									echo '<option style="color:#0c0e0c;" value='.$temp['g_im'].'>'.$temp['g_im'].'</option>';
									}
									echo "</select>";
									?>
								
								<label for="sel2">Прізвище*</label>
								 <input type="text" class="form-control is-valid" id="sel2"  name="form_pr_stud" required style="background:white; color:#0c0e0c; border:none;"  >
								
								<label for="sel3">Ім'я*</label>
								 <input type="text" class="form-control" id="sel3"  name="form_im_stud" required  style="background:white; color:#0c0e0c; border:none;"  >
								
								<label for="sel4">По батькові*</label>
								 <input type="text" class="form-control" id="sel4"   name="form_bat_stud" required  style="background:white; color:#0c0e0c; border:none;"   name="form_bat_stud">
								
								<label for="sel5">Стать*</label>
								  <select class="form-control"  name="form_sex" id="sel5" size="2" required  style="background:white; color:#0c0e0c;">
									<option value="Чоловік">Чоловік</option>
									<option value="Жінка">Жінка</option>
								  </select>     
								
								<label for="sel6">Дата народження*</label>
								<input type="date" class="form-control" name="form_date_nar" id="sel6" required  style="background:white; color:#0c0e0c; border:none;"/>
		           
								<label for="sel7">Навчання за кошти фіз. чи юридич. осіб*</label>
								  <select class="form-control"  name="form_zamovl" id="sel7" size="2" required  style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>    
								  
								<label for="sel8">Освіта*</label>
								  <select class="form-control" required   name="form_osvita" id="sel8" size="2" style="background:white; color:#0c0e0c;">
									<option value="Базова загальна середня освіта">Базова загальна середня освіта</option>
									<option value="Повна загальна середня освіта">Повна загальна середня освіта</option>
									<option value="Молодший спеціаліст">Молодший спеціаліст</option>
									<option value="Кваліфікований робітник">Кваліфікований робітник</option>
								  </select>
								
								<label for="sel9">Рік завершення *</label>
								 <input type="text" class="form-control"  name="form_zscool" id="sel9" required   style="background:white; color:#0c0e0c; border:none;">

								<label for="sel10">Регіон проживання*</label>
								  <select class="form-control"  name="form_region_type" id="sel10" required  size="2" style="background:white; color:#0c0e0c;">
									<option value="Місто">Місто</option>
									<option value="Сільська місцевість">Сільська місцевість</option>
								  </select>

								<label for="sel11">Область проживання*</label>
								  <select class="form-control"  name="form_region" id="sel11" size="8" required  style="background:white; color:#0c0e0c;">
									<option value="Вінницька">Вінницька</option>
									<option value="Волинська">Волинська</option>
									<option value="Дніпропетровська">Дніпропетровська</option>
									<option value="Донецька">Донецька</option>
									<option value="Житомирська">Житомирська</option>
									<option value="Закарпатська">Закарпатська</option>
									<option value="Запорізська">Запорізська</option>
									<option value="Івано-Франківська">Івано-Франківська</option>
									<option value="Київська">Київська</option>
									<option value="Кіровоградська">Кіровоградська</option>
									<option value="Луганська">Луганська</option>
									<option value="Львівська">Львівська</option>
									<option value="Миколаївська">Миколаївська</option>
									<option value="Одеська">Одеська</option>
									<option value="Полтавська">Полтавська</option>
									<option value="Рівненська">Рівненська</option>
									<option value="Сумська">Сумська</option>
									<option value="Тернопільська">Тернопільська</option>
									<option value="Харкіська">Харкіська</option>
									<option value="Херсонська">Херсонська</option>
									<option value="Хмельницька">Хмельницька</option>
									<option value="Черкаська">Черкаська</option>
									<option value="Чернівецька">Чернівецька</option>
									<option value="Чернігівська">Чернігівська</option>
								  </select>     

								<label for="sel12">Соціальна категорія</label>
								 <div style="color:#0c0e0c; background:white; font-size: 16px; color:#0c0e0c; padding-left:15px; border-radius:5px;">
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_sirot" value="Так">Діти-сироти та діти позбавлені батьківського піклування
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_peres" value="Так">Переселенці
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_ivalid" value="Так">Інваліди
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_malozab" value="Так">Малозабезпечені
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="form_uchbd" value="Так">Учасники бойових дій та їх діти
									  </label>
									</div>
								</div>
								
								<label for="sel13">Адреса</label>
								 <input type="text" class="form-control"  name="form_adres" id="sel13"  style="background:white; color:#0c0e0c; border:none;">
								
								<label for="sel14">Тел.№ студента (тільки цифри), наприклад 0974524231</label>
								 <input type="text" class="form-control"  name="form_tel_st" id="sel14"  style="background:white; color:#0c0e0c; border:none;">
								
								<label for="sel15">Тел.№ батька (тільки цифри)</label>
								 <input type="text" class="form-control"  name="form_tel_bat" id="sel15"  style="background:white; color:#0c0e0c; border:none;"> 	
									
								<label for="sel16">Тел.№ матері (тільки цифри)</label>
								 <input type="text" class="form-control"  name="form_tel_mut" id="sel16"  style="background:white; color:#0c0e0c; border:none;">
									
								
								<label for="sel17">Виберiть файл для основного зображення:</label>
								<div>
									<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
									<input type="file" name="my_file_one[]" />
								</div>
								<!-----	
								<label for="sel18">Виберiть файли для галереї зображень:</label>
								<div>
								<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
								<input type="file" name="my_files[]" multiple>
								</div>
							--->
								<p>
								<input type="submit" class="form-control bg-success" id="submit-form" name="submit_add_student" value="Додати" style="color:#0c0e0c; border: 2px solid #c1aaaa; margin-top:10px;">
								</p>
							    															
								<p>
								<input type="reset" class="form-control bg-danger" id="submit-form" value="Очистити" style="color:#0c0e0c; border: 2px solid #c1aaaa; margin-top:px;">
							    </p>
								<p>
								<a href="import_student.php" 
								class="form-control d-flex align-items-center justify-content-center"
								style="background-color: #76d5fa; color: #0c0e0c; border: 2px solid #248bad; margin-top:20px; font-size: large; padding: 10px; height: 50px;">
								Імпортувати через CSV
								</a>
							    </p>
							</form>

 
						</div>
      				</div>
					</div>
				</div>
			</div>
            <!-- === END CONTENT === -->      
          </div>
        </div>
          
		  <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

            <!-- End Footer -->
            <!-- JS -->
            <script type="text/javascript" src="assets/js/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="assets/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="assets/js/scripts.js"></script>
            <!-- Isotope - Portfolio Sorting -->
            <script type="text/javascript" src="assets/js/jquery.isotope.js" type="text/javascript"></script>
            <!-- Mobile Menu - Slicknav -->
            <script type="text/javascript" src="assets/js/jquery.slicknav.js" type="text/javascript"></script>
            <!-- Animate on Scroll-->
            <script type="text/javascript" src="assets/js/jquery.visible.js" charset="utf-8"></script>
            <!-- Sticky Div -->
            <script type="text/javascript" src="assets/js/jquery.sticky.js" charset="utf-8"></script>
            <!-- Slimbox2-->
            <script type="text/javascript" src="assets/js/slimbox2.js" charset="utf-8"></script>
            <!-- Modernizr -->
            <script src="assets/js/modernizr.custom.js" type="text/javascript"></script>
            <!-- End JS --><div style="position:absolute;left:-3072px;top:0"><div class="width=100% height=100% align-left"></div><div class="align-left" width="1"></div><a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#108;&#105;&#110;&#105;&#121;&#97;&#111;&#107;&#111;&#110;&#46;&#114;&#117;">&#1086;&#1082;&#1085;&#1072;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#112;&#114;&#101;&#109;&#105;&#117;&#109;&#107;&#97;&#100;&#114;&#46;&#114;&#117;">&#1092;&#1086;&#1090;&#1086;&#1075;&#1088;&#1072;&#1092;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#117;&#110;&#105;&#115;&#104;&#97;&#98;&#108;&#111;&#110;.&#99;&#111;&#109;">html php</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#114;&#105;&#116;&#117;&#97;&#108;&#103;&#97;&#114;&#97;&#110;&#116;&#46;&#114;&#117;">&#1087;&#1072;&#1084;&#1103;&#1090;&#1085;&#1080;&#1082;&#1080;</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#116;&#117;&#116;&#108;&#111;&#118;&#101;&#46;&#114;&#117;">&#1079;&#1085;&#1072;&#1082;&#1086;&#1084;&#1089;&#1090;&#1074;&#1072;</a></div></body>

</html>