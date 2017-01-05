<?php
require_once("../resources/conexion.php");
require_once("../model/NotificacionMapper.php");
require_once("../model/DeportistaMapper.php");
require_once("../model/Notificacion.php");
require_once("../model/Deportista.php");
require_once("../model/NotificacionHasDeportistaMapper.php");
require_once("../model/NotificacionHasDeportista.php");


class controlador_Notificacion{

	private $notificacionMapper;
	private $deportistaMapper;
	private $notificacionHasDeportistaMapper;

	public function __construct() {

		$this->notificacionHasDeportistaMapper = new NotificacionHasDeportistaMapper();
    $this->notificacionMapper = new NotificacionMapper();
		$this->deportistaMapper = new DeportistaMapper();
  }

	public function newNotificacion(){

		$notificacionHasDeportistaMapper = new NotificacionHasDeportistaMapper();
    $notificacionMapper = new NotificacionMapper();
		$deportistaMapper = new DeportistaMapper();

		$titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
		$receptor=$_POST['receptor'];

		if($receptor=="todos"){

			$notificacion = new Notificacion($titulo,$descripcion, $_SESSION["Dni"]);
			$notificacionMapper->save($notificacion);
			$idUltima = $notificacionMapper->findLastId();

			$deportistas = $deportistaMapper->listarDeportistas();
			foreach ($deportistas as $deportista) {
				$notificacionHasDeportista= new NotificacionHasDeportista($idUltima,$deportista->getDni());
				$notificacionHasDeportistaMapper->save($notificacionHasDeportista);

			}
		}else{

			$receptores =$_POST['receptores'];

			if(empty($receptores))
			{
				echo "No has añadido usuarios";
			}
			else
			{
				$notificacion = new Notificacion($titulo,$descripcion, $_SESSION["Dni"]);
				$notificacionMapper->save($notificacion);
				$idUltima = $notificacionMapper->findLastId();

				$N = count($receptores);
				for($i=0; $i < $N; $i++)
				{
					$notificacionHasDeportista= new NotificacionHasDeportista($idUltima,$receptores[$i]);
					$notificacionHasDeportistaMapper->save($notificacionHasDeportista);
				}
			}
		}
		header ("Location: ../view/adminIndex.php");

	}

	public function listaNotificacionesReceptor($dnireceptor){
		return $this->notificacionHasDeportistaMapper->listarNotificacionesReceptor($dnireceptor);
	}

	public function notificacionId($idNotificacion){
		return $this->notificacionMapper->find($idNotificacion);
	}

	public function listaNotificaciones(){
		return $this->notificacionMapper->listaNotificaciones();
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
		$notificacionHasDeportistaMapper = new NotificacionHasDeportistaMapper();
		if (isset($_POST["idNotificacion"])) {
			$idNotificacion= $_REQUEST["idNotificacion"];
			$notificacionHasDeportistaMapper->notificacionVista($idNotificacion,$_SESSION["Dni"]);

	  }
		header ("Location: ../view/adminIndex.php");

	}





}


?>
