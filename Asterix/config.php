<?php
$currency = 'KM';
$db_username = 'root';
$db_password = '';
$db_name = 'baza';
$db_host = 'localhost';
$mysqli = mysqli_connect($db_host, $db_username, $db_password,$db_name);
mysqli_set_charset($mysqli,"utf8");
?>