<?php
/*	$conexion = mysql_connect('localhost','root','root') or die("Error al conectar". mysql_error());
	$basededatos= "G24";
	$db = mysql_select_db($basededatos, $conexion) or die("Error al seleccionar la bd". mysql_error());
*/
$connect = new mysqli('localhost','root','root','G24');
if(mysqli_connect_errno()){
		unset($connect);
	}

?>
