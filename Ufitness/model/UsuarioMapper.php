<?php
require_once("../resources/conexion.php");


class UsuarioMapper {

	public static function find($Dni){
		global $connect;
		$consulta = "SELECT * FROM Usuario WHERE Dni='". $Dni ."'"; 
		$resultado = $connect->query($consulta);
		
		return mysqli_fetch_assoc($resultado);
		
		
	}
}
 ?>
