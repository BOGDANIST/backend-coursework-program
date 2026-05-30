<?php
$db_host   ='localhost';
$db_user   ='root';
$db_pass   ='';
$db_database = 'college';   
$db_charset = 'utf8';

$linc = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
/** @var mysqli $linc */ //
if (!$linc) {
    die("Connection failed: " . mysqli_connect_error());
}
///echo "BD active";
?>