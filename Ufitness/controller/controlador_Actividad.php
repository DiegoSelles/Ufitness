<?php
require_once("../resources/conexion.php");
require_once("../model/ActividadMapper.php");
require_once("../model/Actividad.php");


class controlador_Actividad{

	private $actividadMapper;

	public function __construct()
	{
		$this->actividadMapper = new ActividadMapper();
	}

	public function listarActividades (){
		return $this->actividadMapper->listarActividades();
	}

	public function getActividad ($idActividad){
		return $this->actividadMapper->getActividad($idActividad);
	}
	public function buscarActividadById($idActividad){
		return $this->actividadMapper->findActividadById($idActividad);
	}

	public function registrarActividad (){
		//Liada: al llamar a esta accion directamente desde un formulario no se llama al constructor
		//y por tanto no se crea el ActividadMapper()
		$actividadMapper = new ActividadMapper();
		global $connect;
		//Obtener el nombre del monitor
		$nombre_monitor = $_POST['monitor'];
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
		$actividad = new Actividad ($nombre_monitor,$nombre,$numPlazas,$horario,$lugar,$tipo);
		$actividadMapper->registrarActividad($actividad, $nombre_monitor);

	}

	public function eliminarActividad ($idActividad){
		global $connect;
		$connect->query("DELETE FROM Actividad WHERE idActividad = $idActividad");

	}
	public function modificarActividad (){
		$actividadMapper = new ActividadMapper();
		global $connect;
		//Obtener el nombre del monitor
		$nombre_monitor = $_POST['monitor'];
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
		$actividad = new Actividad ($nombre_monitor,$nombre,$numPlazas,$horario,$lugar,$tipo);
		$actividadMapper->updateActividad($actividad,$nombre_monitor);
	}
	public function getReserva($idActividad){
		global $connect;
		$consulta = "SELECT numero_Plazas_Reservadas FROM Reserva WHERE Actividad_idActividad ='" .$idActividad."'";
		$resultado = $connect->query($consulta);
		$reserva = mysqli_fetch_assoc($resultado);
		return $reserva;
	}

	public function reservarPlaza($idActividad){
	   global $connect;
	   $consulta = "SELECT numPlazas FROM Actividad WHERE idActividad ='" .$idActividad. "'" ;
	   $resultado= $connect->query($consulta);
	   $plazas = mysqli_fetch_assoc($resultado);
	   $query = "SELECT Deportista_Usuario_Dni FROM Reserva WHERE Actividad_idActividad='" .$idActividad."'";
	   $result = $connect->query($query);
	   $filas = mysqli_num_rows($result);
	   if($plazas['numPlazas'] == $filas){
		   echo "<script language='javascript'>window.location='../view/error.php'</script>";
		   exit();
		}else{
			$prueba = $plazas['numPlazas'] - 1;
			mysqli_query($connect,"UPDATE Actividad SET numPlazas = '" .$prueba. "' WHERE idActividad ='" .$idActividad. "'");
			mysqli_query($connect,"INSERT INTO Reserva(Deportista_Usuario_Dni,Actividad_idActividad,fecha,numero_Plazas_Reservadas) VALUES('" .$_SESSION['Dni']."', '" .$idActividad."', '" .date("Y-m-d")."', '" .$prueba."')");
			echo "<script language='javascript'>window.location='../view/adminActividades.php'</script>";
			exit();
		}
   }
   
}


?>
