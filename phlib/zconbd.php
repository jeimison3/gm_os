<?php
$host = "localhost";
$db   = "gmos";
$user = "root";
$pass = "";
$con = mysqli_connect($host, $user, $pass) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_select_db($con,$db);
mysqli_set_charset($con,'utf8');
date_default_timezone_set('America/Fortaleza');
?>