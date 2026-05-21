<?php

if($myFiles['name'][0])
 {
    for($i = 0; $i < count($myFiles['name']); $i++)
	{

	 //echo $myFiles['name'][$i];                 
	 $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $myFiles['name'][$i]));
    
	 if($imgext == 'jpeg' || $imgext == 'jpg' || $imgext == 'png')
		{
		 //розширення фала
		 $galleryimgType = $myFiles['type'][$i];
		 //папка для завантаження
		 $uploaddir = '../uploads_images/';
		 //нове ім'я
		 echo $newfilename = $id_student.'-'.rand(100,500).'.'.$imgext;
		 //шлях до файлу
		 $uploadfile = $uploaddir.$newfilename;
		 //Завантаження файлу у задану папку						 
			move_uploaded_file($myFiles['tmp_name'][$i], $uploadfile);
		 //Запис назви файлу в таблицю БД							
			mysqli_query($linc, "INSERT INTO image(name_image,id_student)
							VALUES(						
								'".$uploadfile."',
								'".$id_student."'                              
							)");                       
		}                                
	}
 }

?>