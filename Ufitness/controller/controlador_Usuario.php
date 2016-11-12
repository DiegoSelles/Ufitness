<?php
require_once("../resources/conexion.php");
require_once("../model/Usuario.php");

class controlador_Usuario{


		public static function login(){
			global $connect;
			$usuario = $_POST['username'];
			$password = $_POST['password'];
			if(empty($usuario) || empty($password)){
				header("Location: ../view/index.php");
				exit();
			}
			$consulta = "SELECT * FROM Usuario WHERE Dni='". $usuario."'";
			$resultado = $connect->query($consulta);
			if($row = mysqli_fetch_assoc($resultado)){
				if($row['password'] == $password){
				session_start();
				$_SESSION['Dni'] = $usuario;
				$_SESSION['rol'] = $row['rol'];
				header("Location: ../view/adminIndex.php");
				}else{
					header("Location: ../view/index.php");
					exit();
				}
			}else{
				header("Location: ../view/index.php");
				exit();
			}
		}

		public static function logout(){
			if(!isset($_SESSION)) session_start();
			session_destroy();
			header("Location: ../view/index.php");
		}

		public static function getUsuarioActual($Dni){
			return Usuario::getbyDni($Dni);

		}
		function listarEntrenadores (){
			global $connect;
			$consulta = $connect->query("SELECT * FROM Usuario WHERE rol = 'entrenador'");
			$listaEntrenadores = array();
			while ($entrenador = mysqli_fetch_assoc($consulta)) {
					array_push($listaEntrenadores, $entrenador);
			}
			return $listaEntrenadores;
		}
}

?>
