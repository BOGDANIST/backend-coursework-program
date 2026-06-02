<?php
session_start();
if (!in_array($_SESSION['auth_user'], ['admin', 'editor'])) {
	unset($_SESSION['auth_user']);
	header("Location:../admin/input.php");
} else {
	include("../include/db_connect.php");
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../assets/css/bootstrap.css" rel="stylesheet">
	<!-- Template CSS -->
	<link rel="stylesheet" href="../css/my_style.css" rel="stylesheet">
	<!-- Toast Notifications CSS -->
	<link rel="stylesheet" href="assets/css/toast-notifications.css">
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
	<?php include("../include/adm_menu.php"); ?>
	<?php include("../include/background_icon.php"); ?>
	<!-- End Top Menu -->


	<!-- === BEGIN CONTENT === -->

	<!-- Portfolio -->
	<div id="portfolio" class="bottom-border-shadow">

		<div class="container bottom-border">

			<!-- End Portfolio -->

			<!-- === END CONTENT === -->
			<!-- === BEGIN FOOTER === -->
			<div id="base">
				<div id="content">
					<div class="container background-white fade-in" style="margin:0px; padding:10px;">
						<div class="row margin-vert-30" style="margin:10px; padding:0px;">
							<!-- Register Box -->
							<div class="col-md-8 col-md-offset-2 col-sm-offset-2">

								<form class="signup-page" method="POST">
									<div class="signup-header">
										<h1 style="color:rgb(219, 243, 248);">
											<center><strong>Введення даних про нову групу</strong></center>
										</h1>
										<p>* позначені поля обов'язкові для заповнення</p>
									</div>

									<label for="sel1">Введіть назву групи*</label>
									<input required type="text" class="form-control" id="sel1" name="form_im_group"
										style="background:white; color:#0c0e0c; border:none;">

									<label>Форма навчання*</label>
									<select required class="form-control" name="g_fn" size="2"
										style="background:white; color:#0c0e0c;">
										<option value="Денна">Денна</option>
										<option value="Заочна">Заочна</option>
									</select>


									<?php
									// 1. Збираємо всю таблицю spec у вигляді дерева для JavaScript
									$spec_tree = [];
									$spec_query = "SELECT im_galuz, im_spec, im_specializ FROM spec ORDER BY im_galuz, im_spec, im_specializ";
									$spec_result = mysqli_query($linc, $spec_query);
									if ($spec_result) {
										while ($r = mysqli_fetch_assoc($spec_result)) {
											$g = trim($r['im_galuz']);
											$s = trim($r['im_spec']);
											$sz = trim($r['im_specializ']);

											if (!isset($spec_tree[$g]))
												$spec_tree[$g] = [];
											if (!isset($spec_tree[$g][$s]))
												$spec_tree[$g][$s] = [];
											if (!empty($sz) && !in_array($sz, $spec_tree[$g][$s])) {
												$spec_tree[$g][$s][] = $sz;
											}
										}
									}
									$spec_json = json_encode($spec_tree, JSON_UNESCAPED_UNICODE);

									// Формуємо опції тільки для Галузі
									$gz_options = '';
									foreach ($spec_tree as $galuz => $specs) {
										$gz_options .= '<option value="' . htmlspecialchars($galuz) . '">' . htmlspecialchars($galuz) . '</option>';
									}
									?>

									<label for="sel_galuz">Виберіть галузь знань*</label>
									<select required class="form-control" name="g_gz" id="sel_galuz" size="6"
										style="color:#0c0e0c;">
										<?php echo $gz_options; ?>
									</select>

									<label for="sel_spec">Виберіть Спеціальність*</label>
									<select required class="form-control" name="g_sp" id="sel_spec" size="7"
										style="color:#0c0e0c;" disabled>
										<option value="">-- Спочатку оберіть галузь --</option>
									</select>

									<label for="sel_specz">Виберіть Спеціалізацію</label>
									<select class="form-control" name="g_sz" id="sel_specz" size="6"
										style="color:#0c0e0c;" disabled>
										<option value="">-- Спочатку оберіть спеціальність --</option>
									</select>



									<label for="sel5">Виберіть курс*</label>
									<select required class="form-control" name="g_kurs" id="sel5" size="4"
										style="color:#0c0e0c;">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									<p></p>

									<div class="form-check">
										<label class="form-check-label">
											Випускна група <input type="checkbox" class="form-check-input" style=""
												name="g_vip" value="Так">
										</label>
									</div>

									<label for="sel6">Кількість студентів*</label>
									<input type="text" class="form-control" id="sel6" name="g_count_stud"
										style="background:white; color:#0c0e0c; border:none;">

									<label for="sel7">Кількість студентів, що навчаються за регіональним
										замовленням</label>
									<input type="text" class="form-control" id="sel7" name="g_count_rz"
										style="background:white; color:#0c0e0c; border:none;">

									<label for="sel7">Кількість студентів, що навчаються за кошти фізичних або юридичних
										осіб</label>
									<input type="text" class="form-control" id="sel7" name="g_count_contr"
										style="background:white; color:#0c0e0c; border:none;">

									<label for="sel8">Наставник групи</label>
									<input type="text" class="form-control" id="sel8" name="g_nast"
										style="background:white; color:#0c0e0c; border:none;">

									<p>
										<button type="button" class="form-control bg-success" id="submit-form"
											onclick="AsyncRouter.addGroup(this.form); return false;"
											style="color:white; border: 2px solid #c1aaaa; margin-top:25px;">Додати</button>
									</p>
									<p>
										<a href="import_group.php"
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

				<!-- Toast Notifications Container -->
				<div id="toast-container"></div>

				<!-- End Sample Menu -->
			</div>
		</div>
	</div>

	<!-- Footer -->
	<!-- Footer -->
	<?php include("../include/footer.php"); ?>

	<!-- End Footer -->
	<!-- JS -->
	<script type="text/javascript" src="../assets/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../assets/js/scripts.js"></script>

	<!-- Toast Notifications -->
	<script type="text/javascript" src="assets/js/toast-notifications.js" type="text/javascript"></script>
	<!-- Async Router -->
	<script type="text/javascript" src="async.js" type="text/javascript"></script>

	<body>

</html>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const specTree = <?php echo $spec_json ?? '{}'; ?>;
    
    const selGaluz = document.getElementById('sel_galuz');
    const selSpec  = document.getElementById('sel_spec');
    const selSpecz = document.getElementById('sel_specz');

    if (!selGaluz || !selSpec || !selSpecz) return;

    function updateSpec(selectedGaluz) {
        // Якщо галузь не вибрано - блокуємо все і показуємо підказку
        if (!selectedGaluz || !specTree[selectedGaluz]) {
            selSpec.disabled = true;
            selSpec.innerHTML = '<option value="">-- Спочатку оберіть галузь --</option>';
            
            selSpecz.disabled = true;
            selSpecz.innerHTML = '<option value="">-- Спочатку оберіть спеціальність --</option>';
            return;
        }

        // Якщо галузь вибрано - РОЗБЛОКОВУЄМО і прибираємо підказку
        selSpec.disabled = false;
        selSpec.innerHTML = ''; // Очищаємо, підказки більше не буде
        
        const specs = specTree[selectedGaluz];
        for (const sp in specs) {
            selSpec.innerHTML += `<option value="${sp}">${sp}</option>`;
        }
        
        // Спеціалізацію поки блокуємо, бо спеціальність ще не клікнута
        selSpecz.disabled = true;
        selSpecz.innerHTML = '<option value="">-- Спочатку оберіть спеціальність --</option>';
    }

    function updateSpecz(selectedGaluz, selectedSpec) {
        // Якщо спеціальність не обрано
        if (!selectedGaluz || !selectedSpec || !specTree[selectedGaluz] || !specTree[selectedGaluz][selectedSpec]) {
            selSpecz.disabled = true;
            selSpecz.innerHTML = '<option value="">-- Спочатку оберіть спеціальність --</option>';
            return;
        }

        const speczs = specTree[selectedGaluz][selectedSpec];
        
        // Якщо у цієї спеціальності фізично немає спеціалізацій у БД
        if (speczs.length === 0) {
            selSpecz.disabled = true;
            selSpecz.innerHTML = '<option value="">-- Немає спеціалізацій --</option>';
            return;
        }

        // Якщо спеціалізації є - РОЗБЛОКОВУЄМО і прибираємо підказку
        selSpecz.disabled = false;
        selSpecz.innerHTML = ''; // Очищаємо, залишаться лише реальні значення
        
        speczs.forEach(sz => {
            selSpecz.innerHTML += `<option value="${sz}">${sz}</option>`;
        });
    }

    // Відстежуємо кліки користувача по списках
    selGaluz.addEventListener('change', function() {
        updateSpec(this.value);
    });

    selSpec.addEventListener('change', function() {
        updateSpecz(selGaluz.value, this.value);
    });
});
</script>