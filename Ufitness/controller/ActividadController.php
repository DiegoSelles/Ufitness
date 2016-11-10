<?php
require_once("../resources/conexion.php");
class ActividadController{

	function reservarPlaza(){
	   header("Location: indexAdmin.php");
	}

	function listarActividades (){
		$consulta = mysql_query("SELECT * FROM Actividad");
		$listaActividades = array();
		while ($actividad = mysql_fetch_assoc($consulta)) {
				array_push($actividades, $actividad);
		}
		$hola = "hola";
		return $hola;
	}

	function getActividad ($idActividad){
			$consulta = mysql_query("SELECT * FROM Actividad WHERE idActividad = $idActividad");
			$actividad = mysql_fetch_assoc($consulta);
			return $actividad;
	}
	function eliminarActividad ($idActividad){
		mysql_query("DELETE FROM Actividad WHERE idActividad = $idActividad");

	}
}


?>
