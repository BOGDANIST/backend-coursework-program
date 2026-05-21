<?php
//defined('myeshop') or die('!');  
$error_img = array();

if($_FILES['upload_image']['error'] > 0)
{
 //виводимо помилку
 switch ($_FILES['upload_image']['error'])
 {
 case 1: $error_img[] =  'Розмір файла перевищує допустиме значення UPLOAD_MAX_FILE_SIZE'; break;
 case 2: $error_img[] =  'Розмір файла перевищує допустиме значення MAX_FILE_SIZE'; break;
 case 3: $error_img[] =  'Не вдалось загрузити частину файла'; break;
 case 4: $error_img[] =  'Файл не був загружений'; break;
 case 6: $error_img[] =  'Відсутня тимчасова папка.'; break;
 case 7: $error_img[] =  'Не вдалося записати файл на диск.'; break;
 case 8: $error_img[] =  'PHP-розширення зупинило загрузку файла.'; break;
 }

}else
{
//перевірка розширення
if($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png')
{ 

$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));

    //папка для загрузки
$uploaddir = '../uploads_images/';
//нове імя
$newfilename = $_POST["form_type"].'-'.$id.rand(10,100).'.'.$imgext;
//шлях до файлу
$uploadfile = $uploaddir.$newfilename;
 
//загрузка файлу
if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
{

  $update = mysql_query("UPDATE table_products SET image='$newfilename' WHERE products_id = '$id'",$link);   

}
else
{
 $error_img[] =  "Помилка загрузки файла.";    
}
 

    
}else
{
 $error_img[] =  'Допустимі розширення: jpeg, jpg, png';
}
 

}


?>