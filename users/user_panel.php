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



<!DOCTYPE html>
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
            <div id="portfolio" class="bottom-border-shadow">
			
                <div class="container bottom-border">
                    <div class="row padding-top-40">
                <div class="col-md-12">
                         <h3 class="margin-bottom-10" style="margin-left:20px; margin-top:10px;"><strong>Режим користувача</strong></h3>   
                            <!-- Accordion -->
                            <div id="accordion" class="panel-group">
                            
                            <!-- Accordion - Alternative -->
                            <div id="accordion2" class="panel-group alternative">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-One" data-parent="#accordion2" data-toggle="collapse">
                                               <strong>Детальна структирізація базової інформації навчального закладу</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-One" class="accordion-body collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="../assets/img/fillers/mf1.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <!--<h3 class="no-margin no-padding">Humanitatis Per Seacula</h3>-->
                                                    <p style="color:#423b3b; margin-bottom:5px;"><strong> Даний інформаційний сервіс надає можливість отримати оперативну інформацію з будь-якого робочого місця про:</strong> </p>
													<p style="color:#423b3b; margin-bottom:5px;"> - структурні підрозділи та склад їх працівників;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - дані про викладачів і співробітників коледжу, із додатковими умовами фільтрації;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - дані про студентів, впорядковні за різними критеріями.</p>
													
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-Two" data-parent="#accordion2" data-toggle="collapse">
                                                <strong>Система пошуку необхідної інформації на основі динамічних фільтрів</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-Two" class="accordion-body collapse in">
                                         <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="../assets/img/fillers/mf2.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <!--<h3 class="no-margin no-padding">Humanitatis Per Seacula</h3>-->
                                                    <p style="color:#423b3b; margin-bottom:5px;"><strong> Застосування динамічних пошукових фільтрів і двонаправленного сортування дозволяє швидко знайти потрібну інформацію:</strong></p>
													<p style="color:#423b3b; margin-bottom:5px;"> - сортування даних у прямому і зворотньму напрямку;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - фільтри із частковою невизначеністю умов;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - пошук за частковим співпаданням даних.</p>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-Three" data-parent="#accordion2" data-toggle="collapse">
                                               <strong>Адаптивний дизайн та гнучка система адмініструвавання</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-Three" class="accordion-body collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="../assets/img/fillers/mf3.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <!--<h3 class="no-margin no-padding">Humanitatis Per Seacula</h3>-->
                                                    <p style="color:#423b3b; margin-bottom:5px;"><strong> Адаптивна структура сайту і надійні засоби адміністрування дозвляють:</strong></p>
													<p style="color:#423b3b; margin-bottom:5px;"> - мінімізувати вимоги до рівня підготовки користувачів даного сервісу;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - забезпечити роботу із системою як на стаціонарних комп'ютерах, так і на мобільних пристроях;</p>
													<p style="color:#423b3b; margin-bottom:5px;"> - відокремити засоби адміністрування від загальнодоступного інтерфейсу.</p>
													
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Accordion - Alternative -->
                      
			
            </div>
</div>
            <!-- End Portfolio -->
			
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
			
			
			
                
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
