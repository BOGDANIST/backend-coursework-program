<?php
	session_start();

	include ("include/db_connect.php");
	 mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
     mysql_query("SET CHARACTER SET 'utf8'");
	//include ("include/function.php");
	
	//if ($_POST["submit_enter"])
	//{
//		echo $login=$_POST["input_login"];
	//	echo $pass=$_POST["input_pass"];
		//$result = mysql_query("SELECT * FROM reg_users WHERE login='$login' AND pass='$pass'",$linc);
		
	//if (mysql_num_rows($result)>0)
	//{$row=mysql_fetch_array($result);
	// $_SESSION['auth_user']	= 'yes_auth';
	 //header("Location: home.php");
	//}
		
		
		//}
		
		
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
        <title>Нерухомість Бердичева</title>
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
    <body>
        <div id="body-bg">
            <!-- Phone/Email -->
            <div id="pre-header" class="background-gray-lighter">
                <div class="container no-padding">
                    <div class="row hidden-xs">
                        <div class="col-sm-6 padding-vert-5">
                            <strong>Телефон:</strong>&nbsp;+38(099)400-12-59
                        </div>
                        <div class="col-sm-6 text-right padding-vert-5">
                            <strong>Email:</strong>&nbsp;inglik@ukr.net
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
            <div id="hornav" class="bottom-border-shadow" style="height:40px">
                <div class="container no-padding border-bottom">
                    <div class="row">
                        <div class="col-10 no-padding">
                            <div class="visible-lg">
                                <ul id="hornavmenu" class="nav navbar-nav">
                                    <li>
                                        <a href="index.html" class="fa-home active">Головна</a>
                                    </li>
                                    <li>
                                         <a href="features-typo-basic.html">
										<span class="fa-gears ">Продаж</span></a>
                                        <ul>
                                            <li class="parent">
                                                <span>Typography</span>
                                                <ul>
                                                    <li>
                                                        <a href="features-typo-basic.html">Basic Typography</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-typo-blockquotes.html">Blockquotes</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <span>Components</span>
                                                <ul>
                                                    <li>
                                                        <a href="features-labels.html">Labels</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-progress-bars.html">Progress Bars</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-panels.html">Panels</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-pagination.html">Pagination</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent">
                                                <span>Icons</span>
                                                <ul>
                                                    <li>
                                                        <a href="features-icons.html">Icons General</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-icons-social.html">Social Icons</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-icons-font-awesome.html">Font Awesome</a>
                                                    </li>
                                                    <li>
                                                        <a href="features-icons-glyphicons.html">Glyphicons</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="features-testimonials.html">Testimonials</a>
                                            </li>
                                            <li>
                                                <a href="features-accordions-tabs.html">Accordions & Tabs</a>
                                            </li>
                                            <li>
                                                <a href="features-buttons.html">Buttons</a>
                                            </li>
                                            <li>
                                                <a href="features-carousels.html">Carousels</a>
                                            </li>
                                            <li>
                                                <a href="features-grid.html">Grid System</a>
                                            </li>
                                            <li>
                                                <a href="features-animate-on-scroll.html">Animate On Scroll</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="fa-copy ">Оренда</span>
                                        <ul>
                                            <li>
                                                <a href="pages-about-us.html">About Us</a>
                                            </li>
                                            <li>
                                                <a href="pages-services.html">Services</a>
                                            </li>
                                            <li>
                                                <a href="pages-faq.html">F.A.Q.</a>
                                            </li>
                                            <li>
                                                <a href="pages-about-me.html">About Me</a>
                                            </li>
                                            <li>
                                                <a href="pages-full-width.html">Full Width</a>
                                            </li>
                                            <li>
                                                <a href="pages-left-sidebar.html">Left Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="pages-right-sidebar.html">Right Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="pages-login.html">Login</a>
                                            </li>
                                            <li>
                                                <a href="pages-sign-up.html">Sign-Up</a>
                                            </li>
                                            <li>
                                                <a href="pages-404.html">404 Error Page</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="fa-th ">TOP20</span>
                                        <ul>
                                            <li>
                                                <a href="portfolio-2-column.html">2 Column</a>
                                            </li>
                                            <li>
                                                <a href="portfolio-3-column.html">3 Column</a>
                                            </li>
                                            <li>
                                                <a href="portfolio-4-column.html">4 Column</a>
                                            </li>
                                            <li>
                                                <a href="portfolio-6-column.html">6 Column</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="fa-font ">Blog</span>
                                        <ul>
                                            <li>
                                                <a href="blog-list.html">Blog</a>
                                            </li>
                                            <li>
                                                <a href="blog-single.html">Blog Single Item</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html" class="fa-comment ">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                      <!--   <div class="col-md-2 no-padding">
                            <ul class="social-icons pull-right">
                                <li class="social-facebook">
                                    <a href="#" target="_blank" title="Facebook"></a>
                                </li>
                                <li class="social-googleplus">
                                    <a href="#" target="_blank" title="Google+"></a>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
            <!-- End Top Menu -->
            <!-- === END HEADER === -->
         


		   <!-- === BEGIN CONTENT === -->
	
	
            <div id="slideshow" class="bottom-border-shadow">
                
            </div>
           
    
    
            <!-- Portfolio -->
            <div id="portfolio" class="bottom-border-shadow">
			
                <div class="container bottom-border">
                    <div class="row padding-top-40">
                <div class="col-md-12">
                         <h3 class="margin-bottom-10" style="margin-left:20px"><strong>Наші інформаційні послуги</strong></h3>   
                            <!-- Accordion -->
                            <div id="accordion" class="panel-group">
                            
                            <!-- Accordion - Alternative -->
                            <div id="accordion2" class="panel-group alternative">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-One" data-parent="#accordion2" data-toggle="collapse">
                                               <strong> Для приватних клієнтів</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-One" class="accordion-body collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="assets/img/fillers/mf1.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="no-margin no-padding">Humanitatis Per Seacula</h3>
                                                    <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
                                                        qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothicas.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-Two" data-parent="#accordion2" data-toggle="collapse">
                                                <strong>Для агенцій нерухомості і рієлторів</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-Two" class="accordion-body collapse">
                                         <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="assets/img/fillers/mf2.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="no-margin no-padding">Mirum Est Notare</h3>
                                                    <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
                                                        qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothicas.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" href="#collapse2-Three" data-parent="#accordion2" data-toggle="collapse">
                                               <strong>Для організацій і комерційних підприємств</strong>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2-Three" class="accordion-body collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="assets/img/fillers/mf3.jpg" alt="filler image">
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="no-margin no-padding">Mirum Est Notare</h3>
                                                    <p>Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus,
                                                        qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothicas.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Accordion - Alternative -->
                      
			<div class="col-md-3" style="heidh:auto; border: 2px solid #cccccc; margin-left:10px; margin-bottom:15px; padding-bottom:10px;">
				<h3 class="margin-bottom-6" style="margin-left:20px"><strong>Пошуковий фільтр</strong></h3>     
				
				
				<form method="GET" action="search_filter_user.php">
			      <div id="block-search1-left" >
		           <div id="block-category">
                      <p class="header-title" style="border-top:2px solid #cccccc; margin-bottom:0px;"><strong>Тип операції</strong></p>
				        <ul id="ul-category" style="list-style-type: none; margin-bottom:0px;">
				          <li><input type="checkbox" name="check_op0" value="Продаж"/>Продаж</li>
						   <li><input type="checkbox" name="check_op1" value="Оренда"/>Оренда</li>
						   <li><input type="checkbox" name="check_op2"value="Обмін"/>Обмін</li>
				        </ul>
			      </div>
					
				  <div id="block-search2-left">
		           <div id="block-type-object-left">
                      <p class="header-title" style="margin-bottom:0px; border-top:2px solid #cccccc"><strong>Тип об'єкта</strong></p>
				        <ul id="ul-type-object" style="list-style-type: none;">
				           <li><input type="checkbox" id="check-1kkv" name="check_1kkv" value="1 к.кв."/>1 к.кв.</li>
						   <li><input type="checkbox" id="check-2kkv" name="check_2kkv" value="2 к.кв."/>2 к.кв.</li>
						   <li><input type="checkbox" id="check-3kkv" name="check_3kkv" value="3 к.кв."/>3 к.кв.</li>
						   <li><input type="checkbox" id="check-4kkv" name="check_4kkv" value="4 к.кв."/>4 к.кв.</li>
						   <li><input type="checkbox" id="check-budinok" name="check_budinok" value="Будинок"/>Будинок</li>
						   <li><input type="checkbox" id="check-chbudinok" name="check_chbudinok" value="Ч/будинку"/>Ч/будинку</li>
						   <li><input type="checkbox" id="check-nedobud" name="check_nedobud" value="Недобудова"/>Недобудова</li>
						   <li><input type="checkbox" id="check-dilynka" name="check_dilynka" value="Ділянка,дача"/>Ділянка,дача</li>
						   <li><input type="checkbox" id="check-garag" name="check_garag" value="Гараж"/>Гараж</li>
						   <li><input type="checkbox" id="check-comerc" name="check_comerc" value="Комерц. нерух."/>Комерц. нерухомість</li>
						</ul>
                   </div>
				</div>

					
				<div id="block-price1">
                          <p class="header-title" style="margin-bottom:0px; border-top:2px solid #cccccc"><strong>Ціна</strong></p>
				  		  <div id="block-input-price">
				                <ul style="list-style-type: none;">
				                <li><p style="margin-top: 2px; margin-bottom: 0px; margin-left:0px; " ><strong>від</strong></p></li>
				                <li><input type="text" id="start-price" name="start_price" value="0"/></li>
				                <li><p style="margin-top: 2px; margin-bottom: 0px;" ><strong>до</strong></p></li>
				                <li><input type="text" id="end-price" name="end_price" value="250000"/></li>
				                <li><p style="margin-top: 2px; margin-bottom: 0px;" ><strong></strong></p></li>
				                </ul>
				          </div>
				
				</div>
				
				<div id="blocktrackbar1" style="padding-bottom:10px;"> 
               	<input type="range" id="r1" oninput="fun1()" min="0" max="250000" step="1000">		       
			   </div>
	
	          <script type="text/javascript">						
                function fun1() {
                var rng=document.getElementById('r1'); //rng - это ползунок
                var end_price=document.getElementById('end-price');
                end_price.value=rng.value;
                }
              </script> 				
			  </div>	 	
			   
			  
			  <div id="block-search3-left">
		           <div id="block-rayon-left">
                         <p class="header-title" style="margin-bottom:0px; border-top:2px solid #cccccc"><strong>Район</strong></p>
				          <ul id="ul-type-object" style="list-style-type: none;">
				           <li><input type="checkbox" id="check-r1" name="check_r1" value="Мясокомбінат"/>Мясокомбінат</li>
						   <li><input type="checkbox" id="check-r2" name="check_r2" value="Лікарня"/>Лікарня</li>
						   <li><input type="checkbox" id="check-r3" name="check_r3" value="п.Гагаріна"/>п.Гагаріна</li>
						   <li><input type="checkbox" id="check-r4" name="check_r4" value="4 к.кв."/>Ринок</li>
						   <li><input type="checkbox" id="check-r5" name="check_r5" value="вул.Європейська"/>вул.Європейська</li>
						   <li><input type="checkbox" id="check-r6" name="check_r6" value="вул.Вінницька"/>вул.Вінницька</li>
						   <li><input type="checkbox" id="check-r7" name="check_r7" value="Червона гора"/>Червона гора</li>
						   <li><input type="checkbox" id="check-r8" name="check_r8" value="Корніловка"/>Корніловка</li>
						   <li><input type="checkbox" id="check-r9" name="check_r9" value="Загребелля"/>Загребелля</li>
						   <li><input type="checkbox" id="check-r10" name="check_r10" value="Новосілки"/>Новосілки</li>
						   <li><input type="checkbox" id="check-r11" name="check_r11" value="вул.Н.Іванівська"/>вул.Н.Іванівська</li>
						   <li><input type="checkbox" id="check-r12" name="check_r12" value="з-д Прогрес"/>з-д Прогрес</li>
						   <li><input type="checkbox" id="check-r13" name="check_r13" value="Вокзал"/>Вокзал</li>
						   <li><input type="checkbox" id="check-r13" name="check_r14" value="вул.Низгірецька"/>вул.Низгірецька</li>
						   <li><input type="checkbox" id="check-r13" name="check_r15" value="смт.Гришківці"/>смт.Гришківці</li>
						   <li><input type="checkbox" id="check-r13" name="check_r16" value="Район"/>Район</li>
										
						</ul>
						</select>
				      
                   </div>
				  			  
			  </div>
			  
			  <div id="block-price2">
                          <p class="header-title" style="margin-bottom:0px; border-top:2px solid #cccccc"><strong>Поверх</strong></p>
				  		  <div id="block-input-price" style="margin-top:0px; padding-top:0px">
				                <ul style="list-style-type:none">
				                <li><p style="margin-top: 2px; margin-bottom: 0px; margin-left:0px;" ><strong>від</strong></p></li>
				                <li><input type="text" id="start-poverh" name="start_poverh" value="1"/></li>
				                <li><p style="margin-top: 2px; margin-bottom: 0px;" ><strong>до</strong></p></li>
				                <li><input type="text" id="end-poverh" name="end_poverh" value="10"/></li>
				                <li><p style="margin-top: 2px; margin-bottom: 0px;" ><strong></strong></p></li>
				                </ul>
				          </div>
				
				</div>	
				<div id="blocktrackbar2" style="padding-bottom:10px;"> 
               	<input type="range" id="r2" oninput="fun2()" min="1" max="10" step="1">		       
				</div>			   
			  
			  <script type="text/javascript">						
                function fun2() {
                var rng2=document.getElementById('r2'); //rng - это ползунок
                var end_poverh=document.getElementById('end-poverh');
                end_poverh.value=rng2.value;
                }
                </script> 				
			  		
			
			         <div id="block-submit-search" style="text-align:center">
                        <input type="submit" name="submit" id="submit-filter" value="Пошук" onClick='location.href="search_filter_user.php"' style="border-radius:5px; padding-left:10px"/>
                        <input type="reset" id="submit-reset" value="Очистити"  style="border-radius:5px;"/>
					 </div>  
			 </form>
             </div>
                        <!-- End Sidebar Menu -->
			
			<div class="col-md-8" style="text-align:center; padding-left:50px;">
					  <h3 class="margin-bottom-6" style="margin-left:0px; color:#ad3737;"><strong>Найкращі пропозиції</strong></h3>      
					   <ul class="portfolio-group ">
						<?php 
						$result=mysql_query("SELECT * FROM table_objects",$linc);
						if (mysql_num_rows($result)>0)
						{
                        $row = mysql_fetch_array($result);
                        do
                        {if ($row["FOTO"]!= "")
                              {
                                 $img_path = './uploads_images/'.$row["FOTO"];
                              }
                             else 
								   {
                                 $img_path = './uploads_images/0_0.png.';
                             
								 
                                   }
							echo '                   

				   <!-- Portfolio Item -->
                            <li class="portfolio-item col-sm-4 col-xs-6 margin-bottom-40">
                                <a href="#">
                                    <figure class="animate fadeInLeft">
                                        <img src="'.$img_path.'"; style="max-width:100%;  height:auto;">
										<span class="price" style="font-size:16px">'.$row["TYPE_OBJECT"].'&nbsp'.$row['CENA'].'&nbsp'.$row["ED_CENA"].'</span>
                                        <figcaption style="padding:1px">
                                            <p style="font-size:16px; margin:0px; padding-left:15px;">ID:'.$row["ID_OBJECT"].'&nbsp'.$row["TYPE_OPER"].'</p>
											<p style="font-size:16px; margin:0px;">р-н&nbsp'.$row["RAYON"].'</p>
                                        </figcaption>
                                    </figure>
                                </a>
                            </li>
                           
                            <!-- //Portfolio Item// -->
                     
						 '; 
                          
						}
                      while ($row = mysql_fetch_array($result));  
                    
					}
					?>
					   </ul>
                    </div>
                </div>
            </div>
</div>
            <!-- End Portfolio -->
			
            <!-- === END CONTENT === -->
            <!-- === BEGIN FOOTER === -->
            <div id="base">
			
			
			
                <div class="container bottom-border padding-vert-30">
                    <div class="row">
                        <!-- Disclaimer -->
                        <div class="col-md-4">
                            <h3 class="class margin-bottom-10">Disclaimer</h3>
                            <p>All stock images on this template demo are for presentation purposes only, intended to represent a live site and are not included with the template or in any of the Joomla51 club membership plans.</p>
                            <p>Most of the images used here are available from
                                <a href="http://www.shutterstock.com/" target="_blank">shutterstock.com</a>. Links are provided if you wish to purchase them from their copyright owners.</p>
                        </div>
                        <!-- End Disclaimer -->
                        <!-- Contact Details -->
                        <div class="col-md-4 margin-bottom-20">
                            <h3 class="margin-bottom-10">Contact Details</h3>
                            <p>
                                <span class="fa-phone">Telephone:</span>1-800-123-4567
                                <br>
                                <span class="fa-envelope">Email:</span>
                                <a href="mailto:info@example.com">info@example.com</a>
                                <br>
                                <span class="fa-link">Website:</span>
                                <a href="http://www.example.com">www.example.com</a>
                            </p>
                            <p>The Dunes, Top Road,
                                <br>Strandhill,
                                <br>Co. Sligo,
                                <br>Ireland</p>
                        </div>
                        <!-- End Contact Details -->
                        <!-- Sample Menu -->
                        <div class="col-md-4 margin-bottom-20">
                            <h3 class="margin-bottom-10">Sample Menu</h3>
                            <ul class="menu">
                                <li>
                                    <a class="fa-tasks" href="#">Placerat facer possim</a>
                                </li>
                                <li>
                                    <a class="fa-users" href="#">Quam nunc putamus</a>
                                </li>
                                <li>
                                    <a class="fa-signal" href="#">Velit esse molestie</a>
                                </li>
                                <li>
                                    <a class="fa-coffee" href="#">Nam liber tempor</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
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
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">Sample Link</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Footer Menu -->
                        <!-- Copyright -->
                        <div id="copyright" class="col-md-4">
                            <p class="pull-right">(c) <script type='text/javascript'>var mdate = new Date();document.write(mdate.getFullYear());</script> Your Copyright Info</p>
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
</html>