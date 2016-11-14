<?php
require_once("../resources/conexion.php");


class UsuarioMapper {

	public static function find($Dni){
		global $connect;
		$consulta = "SELECT * FROM Usuario WHERE Dni='". $Dni ."'"; 
		$resultado = $connect->query($consulta);
		
		return mysqli_fetch_assoc($resultado);
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

	public function modificaUsuario(Usuario $usuario)
	{
		global $connect;
	    $consulta= " UPDATE Usuario SET DNI='". $usuario->getDni() ."' , Usuario_Dni='". $_SESSION["Dni"] ."', rol= '". $usuario->getRol() ."', Nombre= '". $usuario->getNombre() ."', email='". $usuario->getEmail() ."', password= '". $usuario->getPassword() ."',edad='". $usuario->getEdad() ."'";

	}

	public function eliminarUsuario(Usuario $usuario)
	{
		global $connect;
	    $consulta = "DELETE FROM Usuario WHERE Dni='".$usuario->getDni()."' ";
	    $connect->query($consulta);
	}

	public function usuarioExiste($dni)
	{
		global $connect;
		$consulta = "SELECT COUNT(Dni) FROM Usuario WHERE Dni='". $Dni ."'";
		$connect->query($consulta);

		if($connect->fetchColumn() > 0)
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
