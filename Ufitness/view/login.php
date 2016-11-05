<?php
require_once("conexion.php");

$usuario = $_POST['username'];
$password = $_POST['password'];
	if(empty($usuario) || empty($password)){
		header("Location: index.html");
		exit();
	}

	$consulta = "SELECT * FROM Usuario WHERE Dni='". $usuario."'";
	$resultado = mysql_query($consulta);
	
	if($row = mysql_fetch_array($resultado)){
	if($row['password'] == $password){
		session_start();
		$_SESSION['Dni'] = $usuario;
		header("Location: adminIndex.html");
		}else{
			header("Location: index.html");
			exit();
		}
	}else{
		header("Location: index.html");
		exit();
	}
	
?>
