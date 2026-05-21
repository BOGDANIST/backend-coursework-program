<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor']))
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
					mysqli_query($linc,"UPDATE student SET s_group='$g_im' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_galuz='$g_galuz' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_spec='$g_spec' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_specz='$g_specz' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_form_navch='$g_formnavch' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_group_vip='$g_vipusk' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_cours='$g_course' WHERE s_id='$id_st'");
					};
		}		
				   if($_POST["form_dnar_stud"]!='')
				   {$birthday = new DateTime($_POST["form_dnar_stud"]);
					$interval = $birthday->diff(new DateTime);
					$vik=$interval->y;
				   }
					
					 $_POST["form_pr_stud"];		
					mysqli_query($linc,"UPDATE student SET s_pr='{$_POST["form_pr_stud"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_im='{$_POST["form_im_stud"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_bat='{$_POST["form_bat_stud"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_dnar='{$_POST["form_dnar_stud"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_vik='{$vik}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_rik_zaver='{$_POST["form_zscool_stud"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_adresa='{$_POST["form_adres"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_tels='{$_POST["form_tel_st"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_telb='{$_POST["form_tel_bat"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_telm='{$_POST["form_tel_mut"]}' WHERE s_id='$id_st'");
					mysqli_query($linc,"UPDATE student SET s_osvita_type='{$_POST["form_osvita"]}' WHERE s_id='$id_st'");
				
					
					if($_POST["form_stat_select"]!=''){mysqli_query($linc,"UPDATE student  SET s_stat='{$_POST["form_stat_select"]}' WHERE  s_id='$id_st'");}			
					if($_POST["form_zamovl"]!=''){mysqli_query($linc,"UPDATE student  SET s_contract='{$_POST["form_zamovl"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_reg_type"]!=''){mysqli_query($linc,"UPDATE student  SET s_region_type='{$_POST["form_reg_type"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_region"]!=''){mysqli_query($linc,"UPDATE student  SET s_region='{$_POST["form_region"]}' WHERE  s_id='$id_st'");}

				    if($_POST["form_osvita"]!=''){mysqli_query($linc,"UPDATE student  SET s_osvita_type='{$_POST["form_osvita"]}' WHERE  s_id='$id_st'");}

					if($_POST["form_sirot"]!=''){mysqli_query($linc,"UPDATE student SET s_sirota='{$_POST["form_sirot"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_peres"]!=''){mysqli_query($linc,"UPDATE student SET s_peresel='{$_POST["form_peres"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_chernob"]!=''){mysqli_query($linc,"UPDATE student SET s_chernob='{$_POST["form_,chernob"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_ivalid"]!=''){mysqli_query($linc,"UPDATE student SET s_inval='{$_POST["form_ivalid"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_malozab"]!=''){mysqli_query($linc,"UPDATE student SET s_malozab='{$_POST["form_malozab"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_ato"]!=''){mysqli_query($linc,"UPDATE student SET s_ato='{$_POST["form_ato"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_uchbd"]!=''){mysqli_query($linc,"UPDATE student SET s_war_act='{$_POST["form_uchbd"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_ditzag"]!=''){mysqli_query($linc,"UPDATE student SET s_ditzag='{$_POST["form_ditzag"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_stepver"]!=''){mysqli_query($linc,"UPDATE student SET s_rada='{$_POST["form_stepver"]}' WHERE  s_id='$id_st'");}
					if($_POST["form_shaht"]!=''){mysqli_query($linc,"UPDATE student SET s_shahter='{$_POST["form_shaht"]}' WHERE  s_id='$id_st'");}
		
	$success = 'Зміни проведені';
	};

			// Припускаємо, що ідентифікатор студента передається, наприклад, через прихований input (id_st)
	

		if (isset($_POST["move_to_history"])) {

			// Отримуємо значення з форми
			$operation_date = $_POST["operation_date"]; // дата операції
			$operation_name = $_POST["operation_name"]; // причина операції

			// Перевіряємо чи задано ідентифікатор студента, дату та причину
			if (empty($id_st) || empty($operation_date) || empty($operation_name)) {
				echo "Заповніть, будь ласка, дату операції, причину та визначте студента.";
				exit;
			}

			// Починаємо транзакцію (якщо потрібно для цілісності)
			mysqli_begin_transaction($linc);

			// Перш за все – вставляємо дані студента до старої таблиці "old_student"
			// Припустимо, що таблиці student та old_student мають однакову структуру, а також в old_student додані два поля:
			// operation_date та operation_name.
			// Зауважте: тут перелічено поля, змініть їх відповідно до вашої схеми.
			$insert_query = "INSERT INTO old_student (
								s_id, s_pr, s_im, s_bat, s_stat, s_galuz, s_spec, s_specz, s_group, s_form_navch, s_vip, s_cours, s_contract, s_dnar, s_vik, s_adresa, s_tels, s_telb, s_telm, s_osvita_type, s_rik_zaver, s_region_type, s_region, s_sirota, s_peresel, s_chernob, s_inval, s_malozab, s_ato, s_war_act, s_ditzag, s_rada, s_shahter, 
								operation_date, operation_name
							)
							SELECT 
								s_id, s_pr, s_im, s_bat, s_stat, s_galuz, s_spec, s_specz, s_group, s_form_navch, s_vip, s_cours, s_contract, s_dnar, s_vik, s_adresa, s_tels, s_telb, s_telm, s_osvita_type, s_rik_zaver, s_region_type, s_region, s_sirota, s_peresel, s_chernob, s_inval, s_malozab, s_ato, s_war_act, s_ditzag, s_rada, s_shahter, 
								'$operation_date', '$operation_name'
							FROM student
							WHERE s_id = '$id_st'";

			if (!mysqli_query($linc, $insert_query)) {
				mysqli_rollback($linc);
				$error = "Помилка переміщення студента до історії: " . mysqli_error($linc);
				exit;
			}

			// Після успішного вставлення – видаляємо цього студента з таблиці student
			$delete_query = "DELETE FROM student WHERE s_id = '$id_st'";
			if (!mysqli_query($linc, $delete_query)) {
				mysqli_rollback($linc);
				$error =  "Помилка видалення студента з основної таблиці: " . mysqli_error($linc);
				exit;
			}

			mysqli_commit($linc);
			$success =  "Студента успішно переміщено до історії.";
			header("Location: filter_student.php");
		}

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
                        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                            
							<form class="signup-page" method="POST">
                                <div class="signup-header">
                                    <p class="fs-1" style="color:#ecf6ff; text-align: center;"><strong>Перегляд та редагування даних про студента</strong></p>
								</div>
				  <?php
                  $result = mysqli_query($linc,"SELECT * FROM student WHERE s_id='$id_st'");
                  if (mysqli_num_rows($result)>0)
                    {
                        $row = mysqli_fetch_array($result);
                         do
                        {

					          echo '        
                               <label><strong>Прізвище</strong></label>
								<strong> <input type="text" class="form-control" name="form_pr_stud" value="'.$row['s_pr'].'" style="background:white; color:#0c0e0c; border:none;"  ></strong>
								
								<label><strong><strong>Ім"я</strong></label>
								 <input type="text" class="form-control" name="form_im_stud" value="'.$row['s_im'].'" style="background:white; color:#0c0e0c; border:none;"  >
								
								<label><strong>По батькові</strong></label>
								 <input type="text" class="form-control" name="form_bat_stud" value="'.$row['s_bat'].'" style="background:white; color:#0c0e0c; border:none;"  >
								
								<label><strong>Стать</strong></label>
								 <input type="text" class="form-control" name="form_stat_stud" value="'.$row['s_stat'].'" style="background:white; color:#0c0e0c; border:none;"  >
								<select class="form-control"  name="form_stat_select" size="2" style="background:white; color:#0c0e0c;">
									<option value="Чоловік">Чоловік</option>
									<option value="Жінка">Жінка</option>
								  </select> 
								
								<label><strong>Дата народження</strong></label>
								 <input type="date" class="form-control" name="form_dnar_stud" value="'.$row['s_dnar'].'" style="background:white; color:#0c0e0c; border:none;" >
								
								<label><strong>Група</strong></label>
								<input type="text" class="form-control" name="form_gr_stud" value="'.$row['s_group'].'" style="background:white; color:#0c0e0c; border:none;"  >
								';
							
									$query_group = mysqli_query($linc,"SELECT * FROM st_group");
									echo  '<select class="form-control" name="form_group" size="5" style="color:#0c0e0c;"';
									echo '<option value="group_id"></option>';
									echo '<option value=""></option>';
									while ($temp = mysqli_fetch_assoc($query_group))
									{
									echo '<option style="color:#0c0e0c;" value='.$temp['g_im'].'>'.$temp['g_im'].'</option>';
									}
									echo '</select>
									
									<label><strong>Навчання за регіональним замовленням</strong></label>	
									<input type="text" class="form-control" name="form_zamovl_stud" value="'.$row['s_contract'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_zamovl" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								  
									<label><strong>Рік завершення школи</strong></label>
									<input type="text" class="form-control" name="form_zscool_stud" value="'.$row['s_rik_zaver'].'" style="background:white; color:#0c0e0c; border:none;"  >
								 

									<label> <strong>Освіта</strong></label>
								    <input type="text" class="form-control" name="form_osvita_stud" value="'.$row['s_osvita_type'].'" style="background:white; color:#0c0e0c; border:none;"  >
								  <select class="form-control"  name="form_osvita" size="3" style="background:white; color:#0c0e0c;">
				
									<option value="Базова загальна середня освіта">Базова загальна середня освіта</option>
									<option value="Повна загальна середня освіта">Повна загальна середня освіта</option>
									<option value="Молодший спеціаліст">Молодший спеціаліст</option>
									<option value="Кваліфікований робітник">Кваліфікований робітник</option>							

								  </select>

									<label> <strong>Регіон проживання</strong></label>
								    <input type="text" class="form-control" name="form_reg_type_stud" value="'.$row['s_region_type'].'" style="background:white; color:#0c0e0c; border:none;"  >
								  <select class="form-control"  name="form_reg_type" size="2" style="background:white; color:#0c0e0c;">
									<option value="Місто">Місто</option>
									<option value="Сільська місцевість">Сільська місцевість</option>
								  </select>
								 
								  <label> <strong>Область проживання</strong></label>
								    <input type="text" class="form-control" name="form_region_stud" value="'.$row['s_region'].'" style="background:white; color:#0c0e0c; border:none;"  >
									<select class="form-control"  name="form_region" size="8" style="background:white; color:#0c0e0c;">
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
								  
								  <p></p>
								  <label><strong>Соціальна категорія</strong></label>
								 <p></p>
								 <label>Діти-сироти та діти позбавлені батьківського пілкування</label>	
									<input type="text" class="form-control" name="form_sirot_stud" value="'.$row['s_sirota'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_sirot" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								  
								  <label>Переселенці</label>	
									<input type="text" class="form-control" name="form_peres_stud" value="'.$row['s_peresel'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_peres" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								  
								  <label>Чорнобильці</label>	
									<input type="text" class="form-control" name="form_chernob_stud" value="'.$row['s_chernob'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_chernob" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								  
								  <label>Інваліди</label>	
									<input type="text" class="form-control" name="form_ivalid_stud" value="'.$row['s_inval'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_ivalid" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>

								  <label>Малозабезпечені</label>	
									<input type="text" class="form-control" name="form_malozab_stud" value="'.$row['s_malozab'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_malozab" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select> 
								 
								 <label>Діти учасників АТО</label>	
									<input type="text" class="form-control" name="form_ato_stud" value="'.$row['s_ato'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_ato" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>
								  
								   <label>Учасники бойвих дій та їх діти</label>	
									<input type="text" class="form-control" name="form_uchbd_stud" value="'.$row['s_war_act'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_uchbd" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>
								  
								   <label>Діти загиблих майданівців</label>	
									<input type="text" class="form-control" name="form_ditzag_stud" value="'.$row['s_war_act'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_ditzag" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>
								  
								   <label>Степендіати Верховної ради</label>	
									<input type="text" class="form-control" name="form_stepver_stud" value="'.$row['s_rada'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_stepver" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>
								
								  <label>Шахтарі і діти шахтарів</label>	
									<input type="text" class="form-control" name="form_shaht_stud" value="'.$row['s_shahter'].'" style="background:white; color:#0c0e0c; border:none;"  >	  
								  <select class="form-control"  name="form_shaht" id="sel7" size="2" style="background:white; color:#0c0e0c;">
									<option value="Так">Так</option>
									<option value="Ні">Ні</option>
								  </select>
								  
								  <label>Адреса</label>
								 <input type="text" class="form-control"  name="form_adres" value="'.$row['s_adresa'].'" style="background:white; color:#0c0e0c; border:none;">
								
								<label>Тел.№ студента</label>
								 <input type="text" class="form-control"  name="form_tel_st" value="'.$row['s_tels'].'" style="background:white; color:#0c0e0c; border:none;">
								
								<label>Тел.№ батька</label>
								 <input type="text" class="form-control"  name="form_tel_bat" value="'.$row['s_telb'].'" style="background:white; color:#0c0e0c; border:none;"> 	
									
								<label>Тел.№ матері</label>
								 <input type="text" class="form-control"  name="form_tel_mut" value="'.$row['s_telm'].'" style="background:white; color:#0c0e0c; border:none;">
								  
								  ';
						}
					
                      while ($row = mysqli_fetch_array($result));	
					}
						?>

		

								<p>
								 <input type="submit" class="form-control" id="submit-form" name="submit_save" value="Зберегти зміни" >
								
								</p>
							
							</form>
													<div class=" ">
									<div class="card shadow-lg rounded-2 border-2" style="background-color: #94c7f6; border: #4ea6ee; margin-top: 15px; padding: 7px; ">
										<div class="card-header" data-bs-toggle="collapse" data-bs-target="#moveHistoryForm" aria-expanded="false" aria-controls="moveHistoryForm" style="cursor: pointer;">
										<h5 class="mb-0 text-center fs-2 fw-bold">Перемістити студента до історії</h5>
										</div>
										<div id="moveHistoryForm" class="collapse">
										<div class="card-body ">
											<!-- Форма включає прихований id студента, поле для вибору дати та комбо-бокс (select) для причини -->
											<form method="post" action="" >
											<!-- Прихований input із ідентифікатором студента -->
											<input type="hidden" name="id_st" value="<?= isset($id_st) ? htmlspecialchars($id_st) : '' ?>">
											
											<div class="mb-3">
												<label for="operation_date" class="form-label"><strong>Дата операції</strong></label>
												<input type="date" name="operation_date" id="operation_date" class="form-control" required>
											</div>
											<div class="mb-3">
												<label for="operation_name" class="form-label " ><strong>Причина операції</strong></label>
												<select name="operation_name" id="operation_name" class="form-select" required style="font-size: 14px;">
												<option class="fs-3" value="">Виберіть причину</option>
												<option class="fs-3" value="Відрахований/а">Відрахований/а</option>
												<option class="fs-3" value="Пішов/ла в академ відпустку">Пішов/ла в академ відпустку</option>
												<option class="fs-3" value="Інша причина">Інша причина</option>
												</select>
											</div>
											<div class="d-grid">
												<button type="submit" name="move_to_history" class="btn btn-danger btn-lg">
												Перемістити до історії
												</button>
											</div>
											</form>
										</div>
										</div>
									</div>
									</div>


    </div>
  
      
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

            <!-- End Footer -->

</body>

</html>