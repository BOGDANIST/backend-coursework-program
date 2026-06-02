<?php
session_start();

// Перевірка доступу
if (!in_array($_SESSION['auth_user'], ['admin', 'editor','viewer'])) {   
    header("Location: admin_panel.php");
} else {
    include ("../include/db_connect.php");
    error_reporting(0);
}

// Перевірка наявності ідентифікатора групи
if (!isset($_GET['g_im']) || empty($_GET['g_im'])) {
    die("Групу не вказано!");
}

$group = mysqli_real_escape_string($linc, $_GET['g_im']);

// Отримання студентів з таблиці student для заданої групи
$sql = "SELECT * FROM student WHERE s_group='$group' GROUP BY s_id ORDER BY s_pr ASC";
$result = mysqli_query($linc, $sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Перегляд студентів групи <?php echo htmlspecialchars($group); ?></title>
	
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
        <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" rel="stylesheet" type="text/css">
        
	
        <style>
            .fakeimg {
                height: 200px;
                background: #aaa;
            }
        </style>
        <link rel="stylesheet" href="assets/css/toast-notifications.css" rel="stylesheet">
    </head>
    <body>
    <div id="toast-container"></div>
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
           
            <!-- === BEGIN CONTENT === -->
            <div class="container bottom-border">
                <div class="row padding-top-40">
                    <div class="col-md-12">
                        <h2 class="text-center" style="color:#56693c;">
                            <strong>Студенти групи <span style="color:#D35400;"><?php echo htmlspecialchars($group); ?></span></strong>
                        </h2>
                        <?php 
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="col-md-12" style="margin-top:10px;">';
                            echo '<table class="table table-primary rounded-1 table-striped d-flex table-responsive-md fs-3 fs-sm-1 justify-content-md-center">';
                            echo '
                                    <tr>
                                        <th class="col-md-1 text-center align-middle" style="white-space: nowrap;">ID</th>
                                        <th class="col-md-2 text-center align-middle">Прізвище</th>
                                        <th class="col-md-2 text-center align-middle">Ім\'я</th>
                                        <th class="col-md-2 text-center align-middle">По батькові</th>
                                        <th class="col-md-2 text-center align-middle">Дата народження</th>
										<th class="col-md-1 text-center align-middle">Перегляд</th>
                                        ';
                                        if(in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                           echo '<th class="col-md-1 text-center align-middle">Редагування</th>';
                                        }
                                        echo '
                                    </tr>
                                
								  ';
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                        <td>' . htmlspecialchars($row['s_id']) . '</td>
                                        <td>' . htmlspecialchars($row['s_pr']) . '</td>
                                        <td>' . htmlspecialchars($row['s_im']) . '</td>
                                        <td>' . htmlspecialchars($row['s_bat']) . '</td>
                                        <td>' . htmlspecialchars($row['s_dnar']) . '</td>
										<td class="text-decoration-underline"> <a href="view_student.php?id_st=' . $row["s_id"] .  '">Перегляд</a> </td>
                                        ';
                                        if(in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
                                           echo '<td class="text-decoration-underline"> <a href="edit_student.php?id_st=' . $row["s_id"] .  '">Редагувати</a> </td>';
                                        }
                                        echo '
                                      </tr>';
                            }
                            echo '	</table></div>';
                        } else {
                            echo '<p class="text-center"><strong>Студентів у цій групі не знайдено.</strong></p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- === END CONTENT === -->

        </div>
    </body>
</html>

<script src="assets/js/toast-notifications.js"></script>
<script src="async.js"></script>
