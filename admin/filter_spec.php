<?php
session_start();

if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {   
    header("Location: admin_panel.php");
    exit;
} else {
    include ("../include/db_connect.php");
    error_reporting(0);
    
    // Виконуємо SQL-запит для отримання всіх записів із таблиці spec
    $query = "SELECT * FROM spec";
    $result = mysqli_query($linc, $query);
    if (!$result) {
        die("Помилка запиту: " . mysqli_error($linc));
    }
}
?>

<?php

	
	echo '
    <script>
	function confirmSpelll() 
		{
		if (confirm("Буде видалено користувача. Ви підтверджуєте видалення?")) 
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
    if($_GET["id_sp_del"]!=""){
			$_GET["id_sp_del"];
			mysqli_query($linc,"DELETE FROM spec WHERE id_spec='".$_GET["id_sp_del"]."'");

		$success="Спеціальність видалено успішно!";
    } 
?>		




<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>єСтудент - Список спеціальностей</title>
    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="description" content="Список спеціальностей" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Favicon -->
    <link href="favicon.ico" rel="shortcut icon">
    
    <!-- Bootstrap Core CSS (Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <!-- Template & Custom CSS -->
    <link rel="stylesheet" href="../css/my_style.css">
    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300" 
          rel="stylesheet" type="text/css">
</head>
<body>
    <div id="body-bg">
        <!-- Pre-header: Phone/Email -->
			 	<!-- === Повідомленя про помилку входу === -->

        <!-- End Pre-header -->

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
        <?php include ("../include/adm_menu.php"); ?>
        <?php include ("../include/background_icon.php");?>
        <!-- End Top Menu -->
        <style>th{
            vertical-align: middle; 
        border-width: 2px;
        border-color: #256279;
        align-items:center;
        justify-items: center;
        table-layout: auto;
        font-size: 20px;
            }
        td{
            font-size: 18px;
        }
            
            
            </style>

        <!-- === BEGIN CONTENT === -->
        <div class="container bottom-border my-4">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center fs-1 mb-4" style="color:#3c4869;"><strong>Список спеціальностей</strong></h1>
                    <div class="table-md-responsive">
                        <table class="table table-primary table-striped border-2 border-black rounded-3">
                           
                                <tr class="table-active text-center" style="border-bottom-color: #256279; ">
                                        
                                        <th class="text-center align-middle">Код Галузі</th>
                                        <th class="text-center align-middle">Назва Галузі</th>
                                        <th class="text-center align-middle">ID Спеціалізації</th>
                                        <th class="text-center align-middle">Назва Спеціалізації</th>
                                        <th class="text-center align-middle">Назва Спеціальності</th>
                                        <th class="text-center align-middle">Редагувати</th>
                                        <th class="text-center align-middle">Видалити</th>
                                </tr>
                      
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
              
                                        <td class="text-center"><?= htmlspecialchars($row['id_galuz']) ?></td>
                                        <td><?= htmlspecialchars($row['im_galuz']) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($row['id_spec']) ?></td>
                                        <td><?= htmlspecialchars($row['im_spec']) ?></td>
                                        <td><?= htmlspecialchars($row['im_specializ']) ?></td>
										<td class="text-center" style="vertical-align: middle;">
                                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px; height: 100%;">
                                            <a href="edit_spec.php?id_sp_edit=<?= $row['id_spec'] ?>" 
                                            class="btn btn-sm" 
                                            style="color: aliceblue; background-color: #63949E; font-size: 18px; padding: 10px;">
                                                Редагувати
                                            </a>
                                        </div>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px; height: 100%;">
                                            <a href="filter_spec.php?id_sp_del=<?= $row['id_spec'] ?>" class="btn btn-danger btn-sm" style=" font-size: 18px; padding: 10px;"
                                            onclick="return confirm('Ви точно хочете видалити спеціальність?');">
                                                Видалити
                                            </a>
                                        </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- === END CONTENT === -->

        <!-- Footer -->
    <!-- Footer -->        
 	<?php include ("../include/footer.php");?>

        <!-- End Footer -->
    </div>
    
    <!-- JS -->
    <!-- <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/scripts.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
            crossorigin="anonymous"></script>
</body>
</html>

