<?php
	$conexion = mysql_connect('localhost','root','root') or die("Error al conectar". mysql_error());
	$basededatos= "G24";
	$db = mysql_select_db($basededatos, $conexion) or die("Error al seleccionar la bd". mysql_error());

?>
