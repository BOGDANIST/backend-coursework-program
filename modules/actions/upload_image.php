<?php

/*$error_img=array();
if($_FILES['upload_image']['error']>0)
{
	switch($_FILES['upload_image']['error'])
	{
		//case1:$error_img[]='Розмір файлу перевищує допустиме згачення UPLOAD_MAX_FILE_SIZE'; break;
		case2:$error_img[]='Розмір файлу перевищує допустиме згачення MAX_FILE_SIZE'; break;
		case3:$error_img[]='Не вдалося завантажити частину файла';break;
		case4:$error_img[]='Файл не завантажено';break;
		case5:$error_img[]='Відсутня тимчасова папка';break;
		case6:$error_img[]='Не вдалося записати файл на диск';break;
		case7:$error_img[]='Розмір файлу перевищує допустиме згачення UPLOAD_MAX_FILE_SIZE';break;
		case8:$error_img[]='PHP-модуль зупинив завантаження';break;
	}
}else*/

	//if($_FILES['upload_image']['type']=='image/jpeg' || $_FILES['upload_image']['type']=='image/jpg' || $_FILES['upload_image']['type']=='image/png')
	//{
		$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i","$1",$_FILES['upload_image']['type']));
		echo $imgext;
		$uploaddir='../../uploads_images/';
		echo $uploaddir;
		$newfilename=$_POST["oper_type"].'_'.$id.rand(1,10).'.'.$imgext;
		echo $newfilename;
		//$uploadfile=$uploaddir.$newfilename;
		//if(move_uploaded_file($_FILES['upload_image']['tmp_name'],$uploadfile))
		//{
		//$update=mysql_query("UPDATE table_objects SET image='$newfilename' WHERE id_object='$id'",$link);
		//}
		
	//}
	

?>