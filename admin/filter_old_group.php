<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer'])) {   
    header("Location: admin_panel.php");
} else {
    include ("../include/db_connect.php");
    error_reporting(0);
    
    echo '

    ';
    

}
?>

<!DOCTYPE html>
<html lang="en">
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
        <!-- Template CSS 
        <link rel="stylesheet" href="../assets/css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/nexus.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/custom.css" rel="stylesheet">
         Google Fonts-->
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        
	</head>
<body>
    <div id="body-bg">
        <!-- Phone/Email -->

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
        <!-- Top Menu -->
        <?php include ("../include/adm_menu.php"); ?>
        <?php include ("../include/background_icon.php"); ?>
        <!-- End Top Menu -->
        
        <!-- === BEGIN CONTENT === -->
        <div class="container bottom-border">
            <div class="row padding-top-40">
                <div class="col-md-12">
                    <h2 class="text-center" style="color:#56693c;"><strong>Список груп за спеціальностями</strong></h2>
                    <?php 
                    // Отримуємо унікальні спеціальності з таблиці old_st_group
                    $result_specs = mysqli_query($linc, "SELECT DISTINCT g_spec FROM old_st_group   ORDER BY g_spec ASC");
                    
                    if (mysqli_num_rows($result_specs) > 0) {
                        while ($spec = mysqli_fetch_assoc($result_specs)) {
                            echo '<h3 class="fs-2" style="margin-left:10px; margin-top:20px; color:#56693c;"><strong>' . $spec['g_spec'] . '</strong></h3>';
                            
                            // Отримуємо усі групи для даної спеціальності
                            $result_groups = mysqli_query($linc, "SELECT * FROM old_st_group  WHERE g_spec='" . mysqli_real_escape_string($linc, $spec['g_spec']) . "' GROUP BY g_im ORDER BY g_im ASC");
                            
                            if (mysqli_num_rows($result_groups) > 0) {
                                echo '<div class="col-md-12" style="margin-top:0px;border:none;">';
                                echo '<table class="table table-primary rounded-1 table-striped 98px fs-3 fs-sm-1 justify-content-center 	table-responsive-md" style="width: 100% ; min-width: 400px;">';
                                
                                $i = 1;
                                while ($group = mysqli_fetch_assoc($result_groups)) {
                                    echo '<tr>';
                                    echo    '<td class="col-md-1" style="white-space: nowrap;"><strong>' . $i . '</strong></td>';
                                    echo    '<td class="col-md-2"><strong>' . $group['g_im'] . '</strong></td>';
                                    echo    '<td class="col-md-3" style="white-space: nowrap;"><strong>Кількість студентів: ' . $group['g_count_stud'] . '</strong></td>';
                                    
                              
                                        echo '<td class="col-md-2 fw-bold text-center" style="text-decoration-line: underline; font-size: 16 px;"><strong>';
                                        echo '<a href="view_old	_group.php?g_im=' . $group["g_im"] . '">Переглянути</a>';
                                        echo '</strong></td>';
                                    echo '</tr>';
                                    $i++;
                                }
                                echo '</table></div>';
                            } else {
                                echo '<p class="text-center"><strong>Немає груп для цієї спеціальності</strong></p>';
                            }
                        }
                    } else {
                        echo '<h3 class="fs-2 text-center"><strong>Немає доступних спеціальностей</strong></h3>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- === END CONTENT === -->

        <!-- Footer -->
<?php include ("../include/footer.php");?>
        <!-- End Footer -->


    </div>
</body>
</html>
