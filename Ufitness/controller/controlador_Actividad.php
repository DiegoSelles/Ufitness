<?php
require_once("../resources/conexion.php");
class controlador_Actividad{

	function reservarPlaza($idActividad){
	   $consulta = mysql_query("SELECT numPlazas FROM Actividad WHERE idActividad = $idActividad");
	   $plazas = mysql_fetch_assoc($consulta);
   }

	//Estas funciones que sacan consultas de la base de datos no se si deberían de ir aqui o en ActividadMapper.php
	function listarActividades (){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad");
		$listaActividades = array();
		while ($actividad = mysqli_fetch_assoc($consulta)) {
				array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}

	function getActividad ($idActividad){
			global $connect;
			$consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad = $idActividad");
			$actividad = mysqli_fetch_assoc($consulta);
			return $actividad;
	}

	function registrarActividad (){
		global $connect;
		//Obtener el dni del monitor
		$nombre_Monitor = $_POST['monitor'];
		$sentencia = $connect->prepare("SELECT * FROM Usuario WHERE dni = ?");
		$sentencia->bind_param("s", $nombre_Monitor);
		$dni_monitor = $sentencia->execute();
		//Obtener el nombre de la actividad
		$nombre = $_POST['nombre'];
		//Obtener la fecha y la hora de la actividad
		$horario = $_POST['horario'];
		//Obtener el lugar de la actividad
		$lugar = $_POST['lugar'];
		//Obtener el numero de plazas de la actividad
		$numPlazas = $_POST['numPlazas'];
		//Obtener el tipo de la actividad
		$tipo = $_POST['tipo'];
		//Preparar la sentencia
		$sentencia = $connect->prepare("INSERT INTO Actividad VALUES (?,?,?,?,?,?,?)");
		$sentencia->bind_param("sssssss", null, $dni_monitor, $nombre, $numPlazas, $horario, $lugar, $tipo);
		//Ejecutar la sentencia
		$sentencia->execute();

	}

	function eliminarActividad ($idActividad){
		global $connect;
		$connect->query("DELETE FROM Actividad WHERE idActividad = $idActividad");

	}
}


?>
