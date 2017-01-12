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

		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
		   $lang="es";
		}

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
		header ("Location: ../view/adminIndex.php?lang=$lang");

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

	public function notificacionVista(){
		$notificacionHasDeportistaMapper = new NotificacionHasDeportistaMapper();
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
		   $lang="es";
		}
		if (isset($_POST["idNotificacion"])) {

			$idNotificacion= $_REQUEST["idNotificacion"];
			var_dump($idNotificacion);
			die;
			$notificacionHasDeportistaMapper->notificacionVista($idNotificacion,$_SESSION["Dni"]);

	  }
		header ("Location: ../view/adminIndex.php?lang=$lang");

	}

	public function deleteNotificacion(){
		$idNotificacion = $_REQUEST["idNotificacion"];
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		}else{
		   $lang="es";
		}
		$notificacionMapper = new NotificacionMapper();
		$notificacionHDMapper = new NotificacionHasDeportistaMapper();
		$notificacionMapper->delete($idNotificacion);
		header ("Location: ../view/adminIndex.php?lang=$lang");

	}







}


?>
