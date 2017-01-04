<?php
require_once("../resources/conexion.php");


class NotificacionMapper {

	public static function find($notificacion){
		global $connect;
		$consulta = "SELECT * FROM Notificacion WHERE idNotificacion='". $notificacion->getId() ."' ";
		$resultado = $connect->query($consulta);

		return mysqli_fetch_assoc($resultado);
	}

	public function save(Notificacion $notificacion)
	{
		global $connect;
	    $consulta= " INSERT INTO Notificacion (idNotificacion, Usuario_Dni, Deportista_Usuario_Dni, titulo, descripcion, visto) VALUES ('". $notificacion->getId() ."',
	     '". $notificacion->getEmisor() ."', '". $notificacion->getReceptor() ."', '". $notificacion->getTitulo() ."', '". $notificacion->getDescripcion() ."' ,'". $notificacion->getVisto() ."')";
	    $connect->query($consulta);
	}

	function listarNotificacionesReceptor($receptor){
		global $connect;
		$consulta ="SELECT * FROM Notificacion WHERE Deportista_Usuario_Dni = '".$receptor."' AND visto='0' ";
		$resultado = $connect->query($consulta);
		$listaNotificaciones = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {

				$notificacion = new Notificacion ($actual["titulo"],$actual["descripcion"],$actual["Usuario_Dni"],$actual["Deportista_Usuario_Dni"],$actual["visto"],$actual["idNotificacion"]);
				array_push($listaNotificaciones, $notificacion);
		}
		return $listaNotificaciones;

	}

	public function update($notificacion)
	{
		global $connect;
		$consulta= "UPDATE Notificacion SET Usuario_Dni='". $_SESSION["Dni"] ."', Deportista_Usuario_Dni='". $notificacion->getReceptor() ."',
     titulo='". $notificacion->getTitulo() ."', descripcion='". $notificacion->getDescripcion() ."', visto='". $notificacion->getVisto() ."' WHERE idNotificacion='". $notificacion->getId() ."' ";
			 $connect->query($consulta);
	}

	public function delete($notificacion)
	{
		global $connect;
	    $consulta = "DELETE FROM Notificacion WHERE idNotificacion='". $notificacion->getId() ."' " ;
	    $connect->query($consulta);
	}




}
 ?>
