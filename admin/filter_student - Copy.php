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
		$text_yer   = $_POST['text_yer'] ?? '';
		$check_mp1  = isset($_POST['check_mp1']) ? 'checked' : '';
		$check_mp2  = isset($_POST['check_mp2']) ? 'checked' : '';
		$check_men   = isset($_POST['check_men']) ? 'checked' : '';
		$check_women = isset($_POST['check_women']) ? 'checked' : '';

		$vik_from = $_POST['vik_from'] ?? '';
		$vik_to   = $_POST['vik_to'] ?? '';

		$check_os1 = isset($_POST['check_os1']) ? 'checked' : '';
		$check_os2 = isset($_POST['check_os2']) ? 'checked' : '';

		$check_sirot    = isset($_POST['check_sirot'])    ? 'checked' : '';
		$check_peres    = isset($_POST['check_peres'])    ? 'checked' : '';
		$check_chernob  = isset($_POST['check_chernob'])  ? 'checked' : '';
		$check_ivalid   = isset($_POST['check_ivalid'])   ? 'checked' : '';
		$check_malozab  = isset($_POST['check_malozab'])  ? 'checked' : '';
		$check_ato      = isset($_POST['check_ato'])      ? 'checked' : '';
		$check_uchbd    = isset($_POST['check_uchbd'])    ? 'checked' : '';
		$check_ditzag   = isset($_POST['check_ditzag'])   ? 'checked' : '';
		$check_stepver  = isset($_POST['check_stepver'])  ? 'checked' : '';
		$check_shaht    = isset($_POST['check_shaht'])    ? 'checked' : '';



		// Галузь знань
		$check_gz0 = isset($_POST['check_gz0']) ? 'checked' : '';
		$check_gz1 = isset($_POST['check_gz1']) ? 'checked' : '';
		$check_gz2 = isset($_POST['check_gz2']) ? 'checked' : '';
		$check_gz3 = isset($_POST['check_gz3']) ? 'checked' : '';
		$check_gz4 = isset($_POST['check_gz4']) ? 'checked' : '';
		$check_gz5 = isset($_POST['check_gz5']) ? 'checked' : '';

		// Спеціальність
		$check_sp0 = isset($_POST['check_sp0']) ? 'checked' : '';
		$check_sp1 = isset($_POST['check_sp1']) ? 'checked' : '';
		$check_sp2 = isset($_POST['check_sp2']) ? 'checked' : '';
		$check_sp3 = isset($_POST['check_sp3']) ? 'checked' : '';
		$check_sp4 = isset($_POST['check_sp4']) ? 'checked' : '';
		$check_sp5 = isset($_POST['check_sp5']) ? 'checked' : '';
		$check_sp6 = isset($_POST['check_sp6']) ? 'checked' : '';
		$check_sp7 = isset($_POST['check_sp7']) ? 'checked' : '';

		// Курс
		$check_kurs1 = isset($_POST['check_kurs1']) ? 'checked' : '';
		$check_kurs2 = isset($_POST['check_kurs2']) ? 'checked' : '';
		$check_kurs3 = isset($_POST['check_kurs3']) ? 'checked' : '';
		$check_kurs4 = isset($_POST['check_kurs4']) ? 'checked' : '';
		
		$form_group = $_POST['form_group'] ?? '';
		$check_vg   = isset($_POST['check_vg']) ? 'checked' : '';

		$check_vz0 = isset($_POST['check_vz0']) ? 'checked' : '';
		$check_vz1 = isset($_POST['check_vz1']) ? 'checked' : '';

		$select_region = $_POST['select_region'] ?? '';


	echo '
	<script>
	function confirmSpelll() 
	{
		if (confirm("Ви підтверджуєте видалення?")) 
		{
			return true;
		} else 
		{
			return false;
		}
	}
	 
	</script>
	';
	if ($_GET["id_st"]!="")
		{$id =$_GET["id_st"];
			  
			$delete = mysqli_query($linc,"DELETE FROM student WHERE s_id='$id'");
			echo 'Видалено студента - '.$_GET["pr_st"].' '.$_GET["im_st"].' '.$_GET["bat_st"];  
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
    
    </head>
   
    <div id="body-bg">
       <!-- Phone/Email -->

            <!-- End Phone/Email -->
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <div class="row">
                        <!-- Logo -->
                        <div class="logo col-md-12">
                            <a href="index.html" title="">
                              <img style="width: 100%;" src="../assets/img/logo.png" alt="Logo" />
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
			
    <div class="container-fluid col-11 bottom-border  ">
      <div class="row padding-top-40 d-flex align-content-center">
        <div class="col-md-12">
                         
           <!-- Block filter -->         
			<div class="block_search col-lg-3 shadow-lg" style="height:auto; background:#256279; border: 3px solid #004768; margin-left:10px; margin-top:10px; margin-bottom:14px; padding-bottom:10px;  color: #e5e5e5;">
				<h3 class="margin-bottom-6" style="margin-left:10px ; color: #8fd5e3; text-align: center;"><strong>Пошуковий фільтр</strong></h3>     
				
				
				<form method="POST" >
			       
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Вид замовлення:</strong></p>
						<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_vz0" value="Так" <?= $check_vz0 ?>> навч. за регіон. замовл.</li>
						<li><input type="checkbox" name="check_vz1" value="Ні" <?= $check_vz1 ?>> навч. за кошти фіз. або юридич. осіб</li>
						</ul>
					</div>
					</div>

					
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Галузь знань:</strong></p>
						<ul id="ul-category" style="list-style-type: none; padding-left: 0; font-size: 15px;">
						<li><input type="checkbox" name="check_gz0" value="01 Освіта" <?= $check_gz0 ?>> 01 Освіта</li>
						<li><input type="checkbox" name="check_gz1" value="05 Соціальні і поведінкові науки" <?= $check_gz1 ?>> 05 Соціальні і поведінкові науки</li>
						<li><input type="checkbox" name="check_gz2" value="07 Управління та адміністрування" <?= $check_gz2 ?>> 07 Управління та адміністрування</li>
						<li><input type="checkbox" name="check_gz3" value="08 Право" <?= $check_gz3 ?>> 08 Право</li>
						<li><input type="checkbox" name="check_gz4" value="12 Інформаційні технології" <?= $check_gz4 ?>> 12 Інформаційні технології</li>
						<li><input type="checkbox" name="check_gz5" value="13 Механічна інженерія" <?= $check_gz5 ?>> 13 Механічна інженерія</li>
						</ul>
					</div>
					</div>

						<div id="block-search-left">
						<div id="block-category">
							<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Спеціальність:</strong></p>
							<ul id="ul-category" style="list-style-type: none; padding-left: 0; font-size: 15px;">
							<li><input type="checkbox" name="check_sp0" value="017 Фізична культура і спорт" <?= $check_sp0 ?>> 017 Фізична культура і спорт</li>
							<li><input type="checkbox" name="check_sp1" value="051 Економіка" <?= $check_sp1 ?>> 051 Економіка</li>
							<li><input type="checkbox" name="check_sp2" value="071 Облік і оподаткування" <?= $check_sp2 ?>> 071 Облік і оподаткування</li>
							<li><input type="checkbox" name="check_sp3" value="072 Фінанси, банківська справа та страхування" <?= $check_sp3 ?>> 072 Фінанси, банківська справа та страхування</li>
							<li><input type="checkbox" name="check_sp4" value="081 Право" <?= $check_sp4 ?>> 081 Право</li>
							<li><input type="checkbox" name="check_sp5" value="121 Інженерія програмного забезпечення" <?= $check_sp5 ?>> 121 Інженерія програмного забезпечення</li>
							<li><input type="checkbox" name="check_sp6" value="133 Галузеве машинобудування" <?= $check_sp6 ?>> 133 Галузеве машинобудування</li>
							<li><input type="checkbox" name="check_sp7" value="136 Металургія" <?= $check_sp7 ?>> 136 Металургія</li>
							</ul>
						</div>
						</div>

					
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Курс:</strong></p>
						<ul id="ul-category" style="list-style-type: none; padding-left: 0; font-size: 15px;">
						<li><input type="checkbox" name="check_kurs1" value="1" <?= $check_kurs1 ?>> I курс</li>
						<li><input type="checkbox" name="check_kurs2" value="2" <?= $check_kurs2 ?>> II курс</li>
						<li><input type="checkbox" name="check_kurs3" value="3" <?= $check_kurs3 ?>> III курс</li>
						<li><input type="checkbox" name="check_kurs4" value="4" <?= $check_kurs4 ?>> IV курс</li>
						</ul>
					</div>
					</div>

					
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Група:</strong></p>

						<?php
						$query_group = mysqli_query($linc, "SELECT * FROM st_group");

						echo '<div class="mb-3 fs-3">';
						echo '<label for="form_group" class="form-label fs-3">Оберіть групу</label>';
						echo '<select class="form-select fs-4" name="form_group" id="form_group">';

						echo '<option value="">-- Виберіть групу --</option>';

						while ($temp = mysqli_fetch_assoc($query_group)) {
							$selected = ($form_group == $temp['g_im']) ? 'selected' : '';
							echo '<option value="' . htmlspecialchars($temp['g_im']) . '" ' . $selected . '>' . htmlspecialchars($temp['g_im']) . '</option>';
						}

						echo '</select>';
						echo '</div>';
						?>

					</div>

					<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_vg" value="Так" <?= $check_vg ?> style="margin:0px;"> випускна група</li>
					</ul>
					</div>

						
						<!-- СТАТЬ -->
						<div id="block-search-left">
						<div id="block-category">
							<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Стать:</strong></p>
							<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
							<li><input type="checkbox" name="check_men" value="Чоловік" <?= $check_men ?> style="margin:0px;">чоловік</li>
							<li><input type="checkbox" name="check_women" value="Жінка" <?= $check_women ?> style="margin:0px;">жінка</li>
							</ul>
						</div>
						</div>

						<!-- ВІК -->
						<div id="block-search-left">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Вік</strong></p>
						<div id="block-category">
							<label style="font-size: 15px;">від</label>
							<input type="number" name="vik_from" value="<?= htmlspecialchars($vik_from) ?>" style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
							<label style="font-size: 15px;">до</label>
							<input type="number" name="vik_to" value="<?= htmlspecialchars($vik_to) ?>" style="width:50px; height: 25px; margin:5px; color: #000000;" min="0" max="100">
							<label style="font-size: 15px;">років</label>
						</div>
						</div>

						<!-- ОСВІТА -->
						<div id="block-search-left">
						<div id="block-category">
							<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Освіта:</strong></p>
							<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
							<li><input type="checkbox" name="check_os1" value="Базова загальна середня освіта" <?= $check_os1 ?> style="margin:0px;">базова загальна середня освіта</li>
							<li><input type="checkbox" name="check_os2" value="Повна загальна середня освіта" <?= $check_os2 ?> style="margin:0px;">повна загальна середня освіта</li>
							</ul>
						</div>
						</div>

					<!-- РІК ЗАВЕРШЕННЯ ШКОЛИ -->
					<div id="block-search-left">
					<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Рік завершення школи</strong></p>
					<div id="block-category">
						<label style="font-size: 15px;">Рік</label>
						<input type="text" name="text_yer" value="<?= htmlspecialchars($text_yer) ?>" style="width:50px; height: 25px; background:white; font-size: 15px;margin-top:5px; margin-bottom:5px; border:1px solid #cccccc; color:#030303;">
					</div>
					</div>

					<!-- ПРОЖИВАННЯ -->
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Проживання:</strong></p>
						<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_mp1" value="Місто" <?= $check_mp1 ?> style="margin:0px;">місто</li>
						<li><input type="checkbox" name="check_mp2" value="Сільська місцевість" <?= $check_mp2 ?> style="margin:0px;">сільська місцевість</li>
						</ul>
					</div>
					</div>
				
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px; font-size: 15px;"><strong>Область проживання:</strong></p>
						<select class="form-control" id="sel11" name="select_region" size="8" style="background:white; color:#0c0e0c;">
						<?php
						$regions = [
							"Вінницька", "Волинська", "Дніпропетровська", "Донецька", "Житомирська",
							"Закарпатська", "Запорізська", "Івано-Франківська", "Київська", "Кіровоградська",
							"Луганська", "Львівська", "Миколаївська", "Одеська", "Полтавська",
							"Рівненська", "Сумська", "Тернопільська", "Харкіська", "Херсонська",
							"Хмельницька", "Черкаська", "Чернівецька", "Чернігівська", "АР Крим"
						];

						foreach ($regions as $region) {
							$selected = ($select_region === $region) ? 'selected' : '';
							echo '<option value="' . htmlspecialchars($region) . '" ' . $selected . '>' . htmlspecialchars($region) . '</option>';
						}
						?>
						</select>
					</div>
					</div>

					
					<div id="block-search-left">
					<div id="block-category">
						<p class="header-title" style="border-top:2px solid #cccccc; border-bottom:2px solid #cccccc; padding-top:20px; margin-bottom:0px; font-size: 15px;"><strong>Соціальна категорія:</strong></p>
						<ul id="ul-category" style="list-style-type: none; margin-bottom:0px; padding-left:0px; font-size: 15px;">
						<li><input type="checkbox" name="check_sirot" value="Так" <?= $check_sirot ?>> діти-сироти та діти позбавлені батьківського піклування</li>
						<li><input type="checkbox" name="check_peres" value="Так" <?= $check_peres ?>> переселенці</li>
						<li><input type="checkbox" name="check_chernob" value="Так" <?= $check_chernob ?>> чорнобильці</li>
						<li><input type="checkbox" name="check_ivalid" value="Так" <?= $check_ivalid ?>> інваліди</li>
						<li><input type="checkbox" name="check_malozab" value="Так" <?= $check_malozab ?>> малозабезпечені</li>
						<li><input type="checkbox" name="check_ato" value="Так" <?= $check_ato ?>> діти учасників АТО</li>
						<li><input type="checkbox" name="check_uchbd" value="Так" <?= $check_uchbd ?>> учасники бойових дій та їх діти</li>
						<li><input type="checkbox" name="check_ditzag" value="Так" <?= $check_ditzag ?>> діти загиблих майданівців</li>
						<li><input type="checkbox" name="check_stepver" value="Так" <?= $check_stepver ?>> стипендіати Верховної ради</li>
						<li><input type="checkbox" name="check_shaht" value="Так" <?= $check_shaht ?>> шахтарі і діти шахтарів</li>
						</ul>
					</div>
					</div>

			
			         <row id="block-submit-search" style=" border-top:2px solid #cccccc;; text-align:center; ">
                        <input class="col-4 form-control bg-success fs-3" type="submit" name="submit_search" id="submit-filter" value="Пошук" style="margin-top:10px; border-radius:5px;color: #ddfff0;"/>
                        <input class="col-6 form-control bg-danger fs-3" type="reset" id="submit-reset" value="Очистити"  style="margin-top:10px; border-radius:5px; color: #ffffff; "/>
					   <button class="col-6 form-control bg-info fs-3" type="submit" name="download_excel" value="yes" formaction="test\search_excel.php" style="margin-top:10px; border-radius:5px; color: #000000;">Завантажити Excel</button>

					</row>  
			 </form>
             
			 </div>
              <!-- End Block filter -->
			
	<!-- Block list -->
			<div class="row">
                 <div class="col-md-12" style="margin-top:10px;">
                     <div class="tab-content ">
                        <div class="tab-pane active in fade" id="faq">
                            <div class="panel-group" id="accordion">
                                               
												
	<?php  
	
	//Формування запиту
	if($_POST["submit_search"])
	{ $query_all='';
		
		//Вид замовлення
		$vz='';
						$check_vz0=$_POST ["check_vz0"];
				 		$check_vz1=$_POST ["check_vz1"];
						
						if($check_vz0!="")
							{$query_vz0="'".$check_vz0."'";
							 $vz=",";
							 }
						
						if($check_vz1!="")$query_vz1=$vz."'".$check_vz1."'";

						if($check_vz0=="" and  $check_vz1=="")
						{$query_vz="s_contract IN('Так','Ні','')";}
				         else {$query_vz="s_contract IN(".$query_vz0.$query_vz1.")";
						 }				 
		
		//Галузь знань
		$gz='';
						 $check_gz0=$_POST ["check_gz0"];
				 		 $check_gz1=$_POST ["check_gz1"];
						 $check_gz2=$_POST ["check_gz2"];
						 $check_gz3=$_POST ["check_gz3"];
						 $check_gz4=$_POST ["check_gz4"];
						 $check_gz5=$_POST ["check_gz5"];
						
						if($check_gz0=="01 Освіта")
							{$query_gz0="'".$check_gz0."'";
							 $gz=",";}
						if($check_gz1=="05 Соціальні і поведінкові науки")
							{$query_gz1=$gz."'".$check_gz1."'";
							 $gz=",";}
						if($check_gz2=="07 Управління та адміністрування")
							{$query_gz2=$gz."'".$check_gz2."'";
						     $gz=",";}
						if($check_gz3=="08 Право")
							{$query_gz3=$gz."'".$check_gz3."'";
							 $gz=",";}
						if($check_gz4=="12 Інформаційні технології")
							{$query_gz4=$gz."'".$check_gz4."'";
							 $gz=",";}	
						if($check_gz5=="13 Механічна інженерія")$query_gz5=$gz."'".$check_gz5."'";

						if($check_gz0=="" and  $check_gz1=="" and  $check_gz2=="" and  $check_gz3=="" and  $check_gz4=="" and  $check_gz5=="")
						{$query_gz="AND s_galuz IN('01 Освіта','05 Соціальні і поведінкові науки','07 Управління та адміністрування','08 Право','12 Інформаційні технології','13 Механічна інженерія')";}
				         else {$query_gz="AND s_galuz IN(".$query_gz0.$query_gz1.$query_gz2.$query_gz3.$query_gz4.$query_gz5.")";}

		//Спеціальність
		$sp='';
						 $check_sp0=$_POST ["check_sp0"];
				 		 $check_sp1=$_POST ["check_sp1"];
						 $check_sp2=$_POST ["check_sp2"];
						 $check_sp3=$_POST ["check_sp3"];
						 $check_sp4=$_POST ["check_sp4"];
						 $check_sp5=$_POST ["check_sp5"];
						 $check_sp6=$_POST ["check_sp6"];
						 $check_sp7=$_POST ["check_sp7"];
						
						if($check_sp0=="017 Фізична культура і спорт")
							{$query_sp0="'".$check_sp0."'";
							 $sp=',';}
						if($check_sp1=="051 Економіка")
							{$query_sp1=$sp."'".$check_sp1."'";
							 $sp=",";}
						if($check_sp2=="071 Облік і оподаткування")
							{$query_sp2=$sp."'".$check_sp2."'";
						     $sp=",";}
						if($check_sp3=="072 Фінанси, банківська справа та страхування")
							{$query_sp3=$sp."'".$check_sp3."'";
							 $sp=",";}
						if($check_sp4=="081 Право")
							{$query_sp4=$sp."'".$check_sp4."'";
							 $sp=",";}
						if($check_sp5=="121 Інженерія програмного забезпечення")
							{$query_sp5=$sp."'".$check_sp5."'";
							 $sp=",";}	
						if($check_sp6=="133 Галузеве машинобудування")
							{$query_sp6=$sp."'".$check_sp6."'";
							 $sp=",";}		 
						if($check_sp7=="136 Металургія")$query_sp7=$sp."'".$check_sp7."'";

						if($check_sp0=="" and  $check_sp1=="" and  $check_sp2=="" and  $check_sp3=="" and  $check_sp4=="" and  $check_sp5=="" and  $check_sp6=="" and  $check_sp7=="")
						{$query_sp="AND s_spec IN('017 Фізична культура і спорт','051 Економіка','071 Облік і оподаткування','072 Фінанси, банківська справа та страхування','081 Право','121 Інженерія програмного забезпечення','133 Галузеве машинобудування','136 Металургія')";}
				         else {$query_sp="AND s_spec IN(".$query_sp0.$query_sp1.$query_sp2.$query_sp3.$query_sp4.$query_sp5.$query_sp6.$query_sp7.")";
							  }
		//Курс
		$sk='';
						$check_sk1=$_POST ["check_kurs1"];
						$check_sk2=$_POST ["check_kurs2"];
						$check_sk3=$_POST ["check_kurs3"];
						$check_sk4=$_POST ["check_kurs4"];
						if($check_sk1=="1")
							{$query_sk1="'".$check_sk1."'";
							 $sk=',';}
						if($check_sk2=="2")
							{$query_sk2=$sk."'".$check_sk2."'";
							 $sk=",";}
						if($check_sk3=="3")
							{$query_sk3=$sk."'".$check_sk3."'";
						     $sk=",";}
						if($check_sk4=="4") $query_sk4=$sk."'".$check_sk4."'";
						if($check_sk1=="" and  $check_sk2=="" and  $check_sk3=="" and  $check_sk4=="")
						{$query_sk="AND s_cours IN('1','2','3','4')";}
						else $query_sk="AND s_cours IN(".$query_sk1.$query_sk2.$query_sk3.$query_sk4.")";
						
		//Випускна група
					
						$check_vg=$_POST ["check_vg"];
						if($check_vg=="Так") $query_vg="AND s_vip IN('Так')";
						else $query_vg="AND s_vip IN('Так','Ні','')";
							 
		//Стать
		$st='';
						$check_men=$_POST ["check_men"];
				 		$check_women=$_POST ["check_women"];
						
						if($check_men=="Чоловік")
							{$query_st0="'".$check_men."'";
							 $st=",";
							 }
						
						if($check_women=="Жінка")$query_st1=$st."'".$check_women."'";

						if($check_men=="" and  $check_women=="")
						{$query_st="AND s_stat IN('Чоловік','Жінка')";}
				         else {$query_st="AND s_stat IN(".$query_st0.$query_st1.")";
						 }			
	
		//Освіта
		$os='';
						echo $check_os1=$_POST ["check_os1"];
				 		echo $check_os2=$_POST ["check_os2"];
						
						if($check_os1=="Базова загальна середня освіта")
							{$query_os1="'".$check_os1."'";
							 $os=",";
							 }
						
						if($check_os2=="Повна загальна середня освіта")$query_os2=$os."'".$check_os2."'";
						if($check_os1=="" and  $check_os2=="") $query_os="AND s_osvita_type IN('Базова загальна середня освіта','Повна загальна середня освіта')";
				         else {
							 $query_os="AND s_osvita_type IN(".$query_os1.$query_os2.")";
						 }			
		//Вік
					
						echo $text_vik=$_POST ["text_vik"];
						if($text_vik!="") 
						{$query_vik0="'".$text_vik."'";
						$query_vik="AND s_vik IN(".$query_vik0.")";
						}
						else $query_vik="";
						
		//Рік завершення школи
				
						echo $text_yer=$_POST ["text_yer"];
						if($text_yer!="") 
						{$text_yer0="'".$text_yer."'";
						$query_yer="AND s_rik_zaver IN(".$text_yer.")";
						}
						else $query_yer="";
		
		//Місце проживання
		$mp='';
						$check_mp1=$_POST ["check_mp1"];
				 		$check_mp2=$_POST ["check_mp2"];
						
						if($check_mp1=="Місто")
							{$query_mp1="'".$check_mp1."'";
							 $mp=",";
							 }
						
						if($check_mp2=="Сільська місцевість") {$query_mp2=$mp."'".$check_mp2."'";}

						if($check_mp1=="" and  $check_mp2=="")
						{$query_mp="AND s_region_type IN('Місто','Сільська місцевість')";}
				         else {
							 $query_mp="AND s_region_type IN(".$query_mp1.$query_mp2.")";
						 }	
		
		// Дитина-сирота
$check_sirot = $_POST["check_sirot"] ?? "";
$query_sirot = ($check_sirot == "Так") ? "AND s_sirota IN ('Так')" : "";

// Переселенець
$check_peres = $_POST["check_peres"] ?? "";
$query_peres = ($check_peres == "Так") ? "AND s_peresel IN ('Так')" : "";

// Чорнобилець
$check_chernob = $_POST["check_chernob"] ?? "";
$query_chernob = ($check_chernob == "Так") ? "AND s_chernob IN ('Так')" : "";

// Інвалід
$check_ivalid = $_POST["check_ivalid"] ?? "";
$query_ivalid = ($check_ivalid == "Так") ? "AND s_inval IN ('Так')" : "";

// Малозабезпечений
$check_malozab = $_POST["check_malozab"] ?? "";
$query_malozab = ($check_malozab == "Так") ? "AND s_malozab IN ('Так')" : "";

// Діти учасників АТО
$check_ato = $_POST["check_ato"] ?? "";
$query_ato = ($check_ato == "Так") ? "AND s_ato IN ('Так')" : "";

// Учасники бойових дій та їх діти
$check_uchbd = $_POST["check_uchbd"] ?? "";
$query_uchbd = ($check_uchbd == "Так") ? "AND s_war_act IN ('Так')" : "";

// Діти загиблих майданівців
$check_ditzag = $_POST["check_ditzag"] ?? "";
$query_ditzag = ($check_ditzag == "Так") ? "AND s_ditzag IN ('Так')" : "";

// Стипендіати Верховної Ради
$check_stepver = $_POST["check_stepver"] ?? "";
$query_stepver = ($check_stepver == "Так") ? "AND s_rada IN ('Так')" : "";

// Шахтарі і діти шахтарів
$check_shaht = $_POST["check_shaht"] ?? "";
$query_shaht = ($check_shaht == "Так") ? "AND s_shahter IN ('Так')" : "";

///По групі
$check_group = $_POST["form_group"] ?? "";
$query_group = ($check_group != "") ? "AND s_group = '" . mysqli_real_escape_string($linc, $check_group) . "'" : "";

///Вік
$vik_from = $_POST["vik_from"] ?? '';
$vik_to   = $_POST["vik_to"] ?? '';
$query_vik = "";

// Перевірка, чи введені числа
if ($vik_from !== '' && $vik_to !== '') {
    $query_vik = "AND s_vik BETWEEN " . intval($vik_from) . " AND " . intval($vik_to);
} elseif ($vik_from !== '') {
    $query_vik = "AND s_vik >= " . intval($vik_from);
} elseif ($vik_to !== '') {
    $query_vik = "AND s_vik <= " . intval($vik_to)	;
}

							   
$query_all = 
  $query_vz . $query_gz . $query_sp . $query_sk . $query_vg . $query_st . $query_os  . $query_yer . $query_mp .
  $query_sr . $query_sirot . $query_peres . $query_chernob . $query_ivalid . $query_malozab . $query_ato .
  $query_uchbd . $query_ditzag . $query_stepver . $query_shaht . $query_group . $query_vik;

	
	session_start();
	$_SESSION['query_all'] = $query_all;


	$i=1;
	$result_searh = mysqli_query($linc, "SELECT * FROM student WHERE $query_all");


	
	if (mysqli_num_rows($result_searh)==0)
	{
		echo '<h3 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#56693c;"><strong>Пошук не дав результатів</strong></h3>';
	}
	if (mysqli_num_rows($result_searh)>0)
					{echo '<h3 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#56693c;"><strong>Результат виконання запиту: знайдено &nbsp';
                     echo	mysqli_num_rows($result_searh);
					 echo '&nbspстудентів </strong></h3>';
						echo '   
									<div class="col-md-12" >
									<table  class="table table-primary rounded-1 table-striped d-flex  table-layout: auto; table-responsive-md fs-3 fs-sm-1">  
										';
						$row = mysqli_fetch_array($result_searh);
					  do{
						 echo '
								
									
										<tr class="">
										<td style="white-space: nowrap;" ><strong>'.$i. '</strong></td>
										<td class="col-md-2"><strong>'.$row['s_pr'].'</strong></td>
										<td class="col-md-2"><strong>'.$row['s_im'].'</strong></td>
										<td class="col-md-2"><strong>'.$row['s_bat'].'</strong></td>
										<td  class="text-center style="white-space: nowrap;" ><strong>'.$row['s_group'].'</strong></td>
										<td style="white-space: nowrap;" class="col-1 text-center"><strong>курс &nbsp'.$row['s_cours'].'</strong></td>
										<td class="text-center" style=" text-decoration-line: underline; padding-left:5px; width: 500px; "><strong><a href="view_student.php?id_st='.$row["s_id"].'">Перегляд</a> |
										<a href="edit_student.php?id_st='.$row["s_id"].'">Змінити</a> |
										<a href="filter_student.php?id_st='.$row["s_id"].'&pr_st='.$row["s_pr"].'&im_st='.$row["s_im"].'&bat_st='.$row["s_bat"].'" onclick="return confirmSpelll();">Видалити</a> </td>
										</tr>								

								
							   ';  
                        $i=$i+1;   
						}
						while ($row = mysqli_fetch_array($result_searh));  
						echo ' 		</table>
									</div>  ';
					  }
	}
	
	else {
		$_SESSION['query_all'] = "1=1";
		$result = mysqli_query($linc, "SELECT * FROM student");
				   
				$i=1;
				$result=mysqli_query($linc, "SELECT * FROM student ORDER BY s_pr");
					if (mysqli_num_rows($result)>0)
					echo '<h3 class="margin-bottom" style="margin-left:0px;  text-align:center; color:#56693c;"><strong>Список студентів за алфавітом:&nbsp всього студентів -&nbsp';
                    echo mysqli_num_rows($result);
					 echo '</h3>';
				     						echo '   
									<div class="col-md-12" >
									<table  class="table table-primary rounded-1 table-striped d-flex  table-layout: auto; table-responsive-md fs-3 fs-sm-1">  
										';
			 		$row = mysqli_fetch_array($result); 
					  do{
						 echo '
										<tr class="">
										<td style="white-space: nowrap;" ><strong>'.$i. '</strong></td>
										<td class="col-md-2"><strong>'.$row['s_pr'].'</strong></td>
										<td class="col-md-2"><strong>'.$row['s_im'].'</strong></td>
										<td class="col-md-1"><strong>'.$row['s_bat'].'</strong></td>
										<td  class="text-center style="white-space: nowrap;" ><strong>'.$row['s_group'].'</strong></td>
										<td style="white-space: nowrap;" class="col-1 text-center"><strong>курс &nbsp'.$row['s_cours'].'</strong></td>
										<td class="text-center" style=" text-decoration-line: underline; padding-left:5px; width: 350px;"><strong><a href="view_student.php?id_st='.$row["s_id"].'">Перегляд</a> |
										<a href="edit_student.php?id_st='.$row["s_id"].'">Змінити</a> |
										<a href="filter_student.php?id_st='.$row["s_id"].'&pr_st='.$row["s_pr"].'&im_st='.$row["s_im"].'&bat_st='.$row["s_bat"].'" onclick="return confirmSpelll();">Видалити</a> </td>
										</tr>	
							   '; 
							   $i=$i+1;   
						}
						while ($row = mysqli_fetch_array($result));
						echo ' 		</table>
									</div>  ';  
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
    </div>
	<!--End Block list -->          
		  <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

   
 
            <!-- End JS --><div style="position:absolute;left:-3072px;top:0"><div class="width=100% height=100% align-left"></div><div class="align-left" width="1"></div><a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#108;&#105;&#110;&#105;&#121;&#97;&#111;&#107;&#111;&#110;&#46;&#114;&#117;">&#1086;&#1082;&#1085;&#1072;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#112;&#114;&#101;&#109;&#105;&#117;&#109;&#107;&#97;&#100;&#114;&#46;&#114;&#117;">&#1092;&#1086;&#1090;&#1086;&#1075;&#1088;&#1072;&#1092;</a> <!-- div --><!-- div end --> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#117;&#110;&#105;&#115;&#104;&#97;&#98;&#108;&#111;&#110;.&#99;&#111;&#109;">html php</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#114;&#105;&#116;&#117;&#97;&#108;&#103;&#97;&#114;&#97;&#110;&#116;&#46;&#114;&#117;">&#1087;&#1072;&#1084;&#1103;&#1090;&#1085;&#1080;&#1082;&#1080;</a> <a href="&#104;&#116;&#116;&#112;&#58;&#47;&#47;&#116;&#117;&#116;&#108;&#111;&#118;&#101;&#46;&#114;&#117;">&#1079;&#1085;&#1072;&#1082;&#1086;&#1084;&#1089;&#1090;&#1074;&#1072;</a></div></body>
 <body>
</html>