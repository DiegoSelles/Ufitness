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
		$nombre_monitor = $_POST['monitor'];
		$sentencia = $connect->prepare("SELECT Dni FROM Usuario WHERE nombre = ?");
		$sentencia->bind_param("s", $nombre_monitor);
		$sentencia->execute();
		echo $nombre_monitor;
		$sentencia->bind_result($dni_monitor);
		$sentencia->fetch();

		echo $dni_monitor;
		//Obtener el nombre de la actividad
		$nombre = $_POST['nombre'];
		echo $nombre;
		//Obtener la fecha y la hora de la actividad
		$horario = $_POST['horario'];
		echo $horario;
		//Obtener el lugar de la actividad
		$lugar = $_POST['lugar'];
		echo $lugar;
		//Obtener el numero de plazas de la actividad
		$numPlazas = $_POST['numPlazas'];
		echo $numPlazas;
		//Obtener el tipo de la actividad
		$tipo = $_POST['tipo'];
		echo $tipo;
		//Preparar la sentencia
		$idActividad = null;
		if($sentencia = $connect->prepare("INSERT INTO Actividad VALUES (?, ?, ?, ?, ?, ?, ?)")){
			$sentencia->bind_param('sssisss', $idActividad, $dni_monitor, $nombre, $numPlazas, $horario, $lugar, $tipo);
			//Ejecutar la sentencia
			$sentencia->execute();
			//header("Location: ../view/adminActividades.php");
		}


	}

	function eliminarActividad ($idActividad){
		global $connect;
		$connect->query("DELETE FROM Actividad WHERE idActividad = $idActividad");

	}
}


?>
