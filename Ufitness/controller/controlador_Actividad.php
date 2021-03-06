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

	public function listarActividadesInd (){
		return $this->actividadMapper->listarActividadesInd();
	}

	public function listarActividadesGrupo (){
		return $this->actividadMapper->listarActividadesGrupo();
	}

	public function listarActividadesPEF (){
		return $this->actividadMapper->listarActividadesPEF();
	}

	public function listarActividadesTDU (){
		return $this->actividadMapper->listarActividadesTDU();
	}

	public function getActividad ($idActividad){
		return $this->actividadMapper->getActividad($idActividad);
	}

	public function buscarActividadById($idActividad){
		return $this->actividadMapper->findActividadById($idActividad);
	}

	public function registrarActividad (){
		
		$actividadMapper = new ActividadMapper();
		global $connect;
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
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
		header ("Location: ../view/adminActividades.php?lang=$lang");

	}

	public function eliminarActividad (){
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
		
		if (!isset($_POST["idActividad"])) {
			throw new Exception("id is mandatory");
	   	 }
		$idActividad = $_REQUEST["idActividad"];
		$actividadMapper = new ActividadMapper();
		$actividadMapper->eliminarActividad($idActividad);
		header ("Location: ../view/adminActividades.php?lang=$lang");


	}
	public function modificarActividad (){
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
           $lang="es";
		}
		
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
		header ("Location: ../view/adminActividades.php?lang=$lang");
	}

	public function getReserva($idActividad){
		global $connect;
		$consulta = "SELECT plazas_ocupadas FROM Reserva WHERE Actividad_idActividad ='" .$idActividad."'";
		$resultado = $connect->query($consulta);
		$reserva = mysqli_fetch_assoc($resultado);
		return $reserva;
	}

	public function reservarPlaza($idActividad,$usuarioActual){
		return $this->actividadMapper->reservar($idActividad,$usuarioActual);

		}

	/////////////// Estadisticas///////////////////////////
	public function numeroActividades()
	{
		return $this->actividadMapper->numeroActividades();
	}

	public function numeroMedioPlazas()
	{
		return $this->actividadMapper->numeroMedioPlazas();
	}

	public function actividadMasSolicitada()
	{
		return $this->actividadMapper->actividadMasSolicitada();

	}
	public function actividadIndividual()
	{
		return $this->actividadMapper->actividadIndividual();

	}
	public function actividadGrupo()
	{
		return $this->actividadMapper->actividadGrupo();

	}

	public function actividadesPorTDU()
	{
		return $this->actividadMapper->actividadesPorTDU();
	}

	public function actividadesPorPEF()
	{
		return $this->actividadMapper->actividadesPorPEF();
	}

	public function actividadesHombres()
	{

	}

	public function actividadesMujeres()
	{

	}

}


?>
