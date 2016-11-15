<?php
require_once("../resources/conexion.php");


class UsuarioMapper {

	public static function find($Dni){
		global $connect;
		$consulta = "SELECT * FROM Usuario WHERE Dni='". $Dni ."'";
		$resultado = $connect->query($consulta);

		return mysqli_fetch_assoc($resultado);
	}

	public static function buscar($Dni){
		global $connect;
		$consulta = "SELECT * FROM Usuario WHERE Dni='". $Dni ."'";
		$resultado = $connect->query($consulta);
		$actual = mysqli_fetch_assoc($resultado);
		$entrenador = new Usuario($actual["Nombre"],$actual["email"],$actual["password"],$actual["edad"],$actual["Dni"],$actual["rol"]);
		return $entrenador;
	}


	function listarEntrenadores (){
		global $connect;
		$consulta ="SELECT * FROM Usuario WHERE rol = 'entrenador'";
		$resultado = $connect->query($consulta);
		$listaEntrenadores = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {

				$entrenador = new Usuario($actual["Nombre"],$actual["email"],$actual["password"],$actual["edad"],$actual["Dni"],$actual["rol"]);
				array_push($listaEntrenadores, $entrenador);
		}
		return $listaEntrenadores;

	}

	public function guardarUsuario(Usuario $usuario)
	{
		global $connect;
	    $consulta= " INSERT INTO Usuario (DNI, Usuario_Dni, rol, Nombre, email, password,edad) VALUES ('". $usuario->getDni() ."',
	     '". $_SESSION["Dni"] ."', '". $usuario->getRol() ."', '". $usuario->getNombre() ."', '". $usuario->getEmail() ."' ,'". $usuario->getPassword() ."' ,'". $usuario->getEdad() ."')";
	    $connect->query($consulta);
	}

	public function modificarUsuario($usuario, $dniAntiguo)
	{
		global $connect;
		$consulta= "UPDATE Usuario SET Dni='". $usuario->getDni() ."' ,Nombre='". $usuario->getNombre() ."', email='". $usuario->getEmail() ."', password='". $usuario->getPassword() ."' WHERE Dni='". $dniAntiguo ."'";
			 $connect->query($consulta);
	}

	public function eliminarUsuario($dni)
	{
		global $connect;
	    $consulta = "DELETE FROM Usuario WHERE Dni='". $dni ."'" ;
	    $connect->query($consulta);
	}

	public function usuarioExiste($dni)
	{
		global $connect;
		$consulta = "SELECT * FROM Usuario WHERE Dni='". $dni ."'";
		$resultado = $connect->query($consulta);
 		$filas = mysqli_num_rows($resultado);
 		if($filas > 0)
  			return true;
	}

	public function isValidUser($dni, $passwd)
	{
		global $connect;
		$consulta = "SELECT COUNT(Dni) FROM Usuario WHERE Dni='". $dni ."' , Usuario_Dni='". $passwd ."'";
		$connect->query($consulta);

		if($connect->fetchColumn() > 0)
			return true;

	}



}
 ?>
