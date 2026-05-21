<?php

define("UPLOAD_DIR", "../uploads_images/");
		
		if (!empty($_FILES["upload_image"])) 
			{
			$myFile = $_FILES["upload_image"];
			
		// проверяем на наличие ошибок при загрузке
			if ($myFile["error"] !== UPLOAD_ERR_OK) 
				{
				echo "<p>Произошла ошибка.</p>";
				exit;
				}
		// обеспечиваем безопасное наименование файла
			$name = preg_replace("/[^A-Z0-9._-]/i", "_", $id.$myFile["name"]);
			
		// при совпадении имен файлов добавляем номер
			$i = 0;
			$parts = pathinfo($name);
			while (file_exists(UPLOAD_DIR . $name)) 
				{
				$i++;
				$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
				}	
			
		// перемещаем файл в постоянное место хранения
			$success = move_uploaded_file($myFile["tmp_name"],
			UPLOAD_DIR . $name);
			$result = mysql_query("UPDATE table_objects SET foto='$name' WHERE id_object='$name'",$linc);
		
			if (!$success) 
				{ 
				echo "<p>Не удается сохранить файл.</p>";
				exit;
				}
		// задаем права на новый файл
			chmod(UPLOAD_DIR . $name, 0644);

			echo "<p>Файл " . $name . " Файл успішно завантажений.</p>";
			}
			
		

?>