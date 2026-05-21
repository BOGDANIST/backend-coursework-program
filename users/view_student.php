<?php
	//session_start();
	//define('myagency', true);
	include ("include/db_connect.php");
	 mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
     mysql_query("SET CHARACTER SET 'utf8'");

	echo $id_st=$_GET["id_st"];
	
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
					
					
					if($_POST["form_stat_select"]!=''){mysql_query("UPDATE student  SET s_stat='{$_POST["form_stat_select"]}' WHERE  s_id='$id_st'",$linc);}			
					if($_POST["form_zamovl"]!=''){mysql_query("UPDATE student  SET s_contract='{$_POST["form_zamovl"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_reg_type"]!=''){mysql_query("UPDATE student  SET s_region_type='{$_POST["form_reg_type"]}' WHERE  s_id='$id_st'",$linc);}
					if($_POST["form_region"]!=''){mysql_query("UPDATE student  SET s_region='{$_POST["form_region"]}' WHERE  s_id='$id_st'",$linc);}
					
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
        <link rel="stylesheet" href="assets/css/bootstrap.css" rel="stylesheet">
        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/custom.css" rel="stylesheet">
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
                              <img src="assets/img/logo.png" alt="Logo" />
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                </div>
            </div>
            <!-- End Header -->
			
			<!-- Top Menu -->
			<?php include ("include/top_menu.php");?>
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
                                    <p style="font-size:22px; color:#0c0e0c;"><strong>Перегляд та редагування даних про студента</strong></p>
								</div>
				  <?php
                  $result = mysql_query("SELECT * FROM student WHERE s_id='$id_st'",$linc);
                  if (mysql_num_rows($result)>0)
                    {
                        $row = mysql_fetch_array($result);
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
							
									$query_group = mysql_query("SELECT * FROM st_group",$linc);
									echo  '<select class="form-control" name="form_group" size="5" style="color:#0c0e0c;"';
									echo '<option value="group_id"></option>';
									echo '<option value=""></option>';
									while ($temp = mysql_fetch_assoc($query_group))
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
					
                      while ($row = mysql_fetch_array($result));	
					}
						?>

								<p>
								 <input type="submit" class="form-control" id="submit-form" name="submit_save" value="Зберегти зміни" style="color:#0c0e0c; border: 2px solid #c1aaaa; margin-top:25px;">
								
								</p>
							
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
 <body>
</html>