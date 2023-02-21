<?php
include_once ("../funciones.php");
include_once("../seguridad.php");
// continuamos con la sesión session_start();
$_SESSION = array(); 
session_destroy();
header("location:../index.php");
exit();
?>

