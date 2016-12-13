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
		$date = $_POST['horario'];
		$horario = date("Y-m-d H:i:s", strtotime($date));
		//Obtener el lugar de la actividad
		$lugar = $_POST['lugar'];
		//Obtener el numero de plazas de la actividad
		$numPlazas = $_POST['numPlazas'];
		//Obtener el tipo de la actividad
		$tipo = $_POST['tipo'];
		$actividad = new Actividad ($nombre_monitor,$nombre,$numPlazas,$horario,$lugar,$tipo);
		$actividadMapper->registrarActividad($actividad, $nombre_monitor);

	}

	public function eliminarActividad (){
		if (!isset($_POST["idActividad"])) {
			//Esta excepcion habría que capturarla en algun lado
			//throw new Exception("id is mandatory");
	   	 }
		$idActividad = $_REQUEST["idActividad"];
		$actividadMapper = new ActividadMapper();
		$actividadMapper->eliminarActividad($idActividad);
		header ("Location: ../view/adminActividades.php");


	}
	public function modificarActividad (){
		if (!isset($_POST["id"])) {
			//Esta excepcion habría que capturarla en algun lado
			//throw new Exception("id is mandatory");
	   	 }
		
		$actividadMapper = new ActividadMapper();
		//Obtener el nombre del monitor
		$nombre_monitor = $_POST['monitor'];
		//Obtener el id de  la actividad
		$id = $_POST['id'];
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
		$actividadMapper->updateActividad($actividad,$id);
	}

	public function getReserva($idActividad){
		global $connect;
		$consulta = "SELECT plazas_ocupadas FROM Reserva WHERE Actividad_idActividad ='" .$idActividad."'";
		$resultado = $connect->query($consulta);
		$reserva = mysqli_fetch_assoc($resultado);
		return $reserva;
	}

	public function reservarPlaza($idActividad,$usuarioActual){
	   global $connect;
	   $consulta = "SELECT numPlazas FROM Actividad WHERE idActividad ='" .$idActividad. "'" ;
	   $resultado= $connect->query($consulta);
	   $plazas = mysqli_fetch_assoc($resultado);
	   $query = "SELECT count(idReserva) FROM Reserva WHERE Deportista_Usuario_Dni = '".$usuarioActual."' and Actividad_idActividad ='".$idActividad."'";
	   $result = $connect->query($query);
	   $existe = mysqli_fetch_assoc($result);

		if($plazas['numPlazas'] == 0){
				echo '<script language="javascript">alert("No quedan plazas disponibles para esta actividad");</script>';
		}else if($existe['count(idReserva)'] != 0 ){
			echo '<script language="javascript">alert("Ya tienes una plaza reservada en esta actividad");</script>';
			}else{
				$plazasRestantes = $plazas['numPlazas'] - 1;
				$plazasOcupadas = 0;
				$plazasOcupadas++;
				mysqli_query($connect,"UPDATE Actividad SET numPlazas = '" .$plazasRestantes. "' WHERE idActividad ='" .$idActividad. "'");
				mysqli_query($connect,"INSERT INTO Reserva(Deportista_Usuario_Dni,Actividad_idActividad,fecha,plazas_ocupadas) VALUES('" .$_SESSION['Dni']."', '" .$idActividad."', '" .date("Y-m-d")."', '" .$plazasOcupadas."')");
				echo '<script language="javascript">alert("Has reservado plaza en esta actividad");window.location.href="../view/adminActividades.php";</script>';
			}

		}

}


?>
