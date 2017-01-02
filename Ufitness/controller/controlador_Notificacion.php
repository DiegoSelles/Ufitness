<?php
require_once("../resources/conexion.php");
require_once("../model/NotificacionMapper.php");
require_once("../model/Notificacion.php");


class controlador_Notificacion{

	private $notificacionMapper;

	public function newNotificacion(){
		$notificacionMapper = new NotificacionMapper();
		global $connect;

		$titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
		$receptor = $_POST['receptor'];
		$notificacion= new Notificacion ($titulo,$descripcion,$_SESSION["Dni"],$receptor);
		$notificacionMapper->save($notificacion);

	}

	

	public function delete(){
		if (!isset($_POST["idActividad"])) {
			//Esta excepcion habría que capturarla en algun lado
			//throw new Exception("id is mandatory");
	   	 }
		$idActividad = $_REQUEST["idActividad"];
		$actividadMapper = new ActividadMapper();
		$actividadMapper->eliminarActividad($idActividad);
		header ("Location: ../view/adminActividades.php");


	}
	public function notificacionVista(){



	}





}


?>
