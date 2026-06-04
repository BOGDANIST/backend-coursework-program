<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer'])) {   
    header("Location: admin_panel.php");
    exit;
} else {
    require_once dirname(__DIR__) . '/bootstrap.php';
    error_reporting(0);

    echo '
    <script>
    function confirmSpelll() 
        {
        if (confirm("Разом з групою будуть видалені студенти. Ви підтверджуєте видалення?")) 
            {
                return true;
            } 
        else 
            {
                return false;
            }
        }
     </script>
    ';

    $db = \App\Core\Database::getInstance()->getConnection();
    
    if (!empty($_GET["g_im_delete"]) && in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
        $id = $_GET["g_im_delete"];
        
        $stmt1 = $db->prepare("DELETE FROM student WHERE s_group=?");
        $stmt1->bind_param('s', $id);
        $stmt1->execute();
        
        $stmt2 = $db->prepare("DELETE FROM st_group WHERE g_im=?");
        $stmt2->bind_param('s', $id);
        $stmt2->execute();
        
        $error = 'Видалено групу - ' . htmlspecialchars($id);  
    }

    $groupModel = new \App\Modules\Groups\Models\GroupModel();
    $allGroups = $groupModel->getAll();
    $totalGroups = count($allGroups);
} 
?>



<!-- === BEGIN HEADER === -->


<!DOCTYPE html>
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
			<div class="container bottom-border">
				<div class="row padding-top-40">
					<div class="col-md-12">
						<div class="col-md-12" style="margin-top:10px;">
                             <div class="tab-content">
                                   
									<div class="tab-panel active in fade" id="faq">
                                        <div class="panel-group" id="accordion">
                                                <h2 class="margin-bottom" style="text-align:center; color:#56693c;"><strong>Список груп</strong></h2> 
                                                <p style="text-align:center; color:#56693c;">
                                            <?php 
                                                 if ($totalGroups > 0) {
                                                    echo "<h3 class='fs-2 text-center'><strong>Всього у коледжі навчаеться {$totalGroups} груп, з яких:</strong></h3>";
                                                 }
                                            ?> </p>
                                                <div class="col-md-12" style="margin-top:0px;border:none;" >
                                                <?php
                                                // Масив конфігурацій для всіх курсів та відділень
                                                $configs = [
                                                    ['course' => '1', 'form' => 'Денна', 'title' => 'І курс, денне відділення'],
                                                    ['course' => '1', 'form' => 'Заочна', 'title' => 'І курс, заочне відділення'],
                                                    ['course' => '2', 'form' => 'Денна', 'title' => 'ІІ курс, денне відділення'],
                                                    ['course' => '2', 'form' => 'Заочна', 'title' => 'ІІ курс, заочне відділення'],
                                                    ['course' => '3', 'form' => 'Денна', 'title' => 'ІІІ курс, денне відділення'],
                                                    ['course' => '3', 'form' => 'Заочна', 'title' => 'ІІІ курс, заочне відділення'],
                                                    ['course' => '4', 'form' => 'Денна', 'title' => 'ІV курс, денне відділення'],
                                                    ['course' => '4', 'form' => 'Заочна', 'title' => 'ІV курс, заочне відділення'],
                                                ];

                                                foreach ($configs as $config) {
                                                    $filteredGroups = array_filter($allGroups, function($group) use ($config) {
                                                        return $group['g_formnavch'] === $config['form'] && $group['g_course'] === $config['course'];
                                                    });

                                                    if (count($filteredGroups) > 0) {
                                                        echo '<h3 class="fs-2" style="margin-left:10px; margin-bottom:0px; margin-top:20px;">
                                                            <strong>' . htmlspecialchars($config['title']) . ':</strong>
                                                        </h3>
                                                        <div class="">
                                                            <div class="table-responsive">
                                                            <table class="table table-primary table-striped table-hover align-middle text-center fs-3">';
                                                        echo '<thead>
                                                                <tr>
                                                                    <th scope="col" class="text-center">№</th>
                                                                    <th scope="col" class="text-center">Назва групи</th>
                                                                    <th scope="col" class="text-center">Кількість студентів</th>
                                                                    <th scope="col" class="text-center">Переглянути</th>';
                                                        if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                                            echo '<th scope="col" class="text-center">Дії</th>';
                                                        }
                                                        echo '</tr>
                                                            </thead>
                                                            <tbody>';
                                                        
                                                        $i = 1;
                                                        foreach ($filteredGroups as $row) {
                                                            echo '<tr>
                                                                <td>' . $i . '</td>
                                                                <td>' . htmlspecialchars($row['g_im']) . '</td>
                                                                <td>' . htmlspecialchars($row['g_count_stud']) . '</td>
                                                                <td><a href="view_group.php?g_im=' . urlencode($row["g_im"]) . '" class="btn btn-info btn-sm">Переглянути</a></td>';
                                                            
                                                            if (in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                                                echo '<td>
                                                                    <a href="edit_group.php?g_im_edit=' . urlencode($row["g_im"]) . '" class="btn btn-warning btn-sm me-2">Змінити</a>
                                                                    <a href="filter_group.php?g_im_delete=' . urlencode($row["g_im"]) . '" onclick="return confirmSpelll();" class="btn btn-danger btn-sm">Видалити</a>
                                                                </td>';
                                                            }
                                                            
                                                            echo '</tr>';
                                                            $i++;
                                                        }
                                                        
                                                        echo '</tbody></table></div></div>';
                                                    }
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