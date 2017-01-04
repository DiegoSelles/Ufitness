<?php
require_once("../resources/conexion.php");
require_once("../model/NotificacionMapper.php");
require_once("../model/DeportistaMapper.php");
require_once("../model/Notificacion.php");
require_once("../model/Deportista.php");


class controlador_Notificacion{

	private $notificacionMapper;
	private $deportistaMapper;

	public function __construct() {

    $this->notificacionMapper = new NotificacionMapper();
		$this->deportistaMapper = new DeportistaMapper();
  }

	public function newNotificacion(){
		$notificacionMapper = new NotificacionMapper();
		$deportistaMapper = new DeportistaMapper();

		$titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
		$receptor=$_POST['receptor'];

		if($receptor=="todos"){
			$deportistas = $deportistaMapper->listarDeportistas();
			foreach ($deportistas as $deportista) {
				$notificacion = new Notificacion($titulo,$descripcion, $_SESSION["Dni"],$deportista->getDni());
				$notificacionMapper->save($notificacion);
			}
		}else{

			$receptores =$_POST['receptores'];

			if(empty($receptores))
			{
				echo "No has añadido usuarios";
			}
			else
			{
				$N = count($receptores);
				for($i=0; $i < $N; $i++)
				{
					$notificacion = new Notificacion($titulo,$descripcion, $_SESSION["Dni"],$receptores[$i]);
					$notificacionMapper->save($notificacion);
				}
			}
		}
		header ("Location: ../view/adminIndex.php");

	}

	public function viewNotificacion($receptor){
		return $this->notificacionMapper->listarNotificacionesReceptor($receptor);
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
		print("hadfasjdf");
	}





}


?>
