<?php

foreach(glob("controlador_*.php") as $nombre)
	{
		include_once $nombre;
	}
	
if(isset($_GET["controlador"]) && isset($_GET["accion"])){
	$objetivo = $_GET["controlador"];
	$accion = $_GET["accion"];
	
	$objetivo::$accion();
	
}



?>
