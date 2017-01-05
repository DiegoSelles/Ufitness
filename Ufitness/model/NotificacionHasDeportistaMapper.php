<?php
require_once("../resources/conexion.php");


class NotificacionHasDeportistaMapper {

	public function save(NotificacionHasDeportista $notificacionHasDeportista)
	{
		global $connect;
	    $consulta= " INSERT INTO Notificacion_has_Deportista (Notificacion_idNotificacion, Deportista_DNI) VALUES ('". $notificacionHasDeportista->getId() ."', '". $notificacionHasDeportista->getReceptor() ."')";
	    $connect->query($consulta);
	}

	function listarNotificacionesReceptor($dniDeportista){
		global $connect;
		$consulta ="SELECT * FROM Notificacion_has_Deportista WHERE Deportista_DNI = '".$dniDeportista."' AND Visto= 0 ";
		$resultado = $connect->query($consulta);
		$listaNotificaciones = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {

				$notificacionHasDeportista = new NotificacionHasDeportista ($actual["Notificacion_idNotificacion"],$actual["Deportista_DNI"],$actual["Visto"]);
				array_push($listaNotificaciones, $notificacionHasDeportista);
		}
		return $listaNotificaciones;
	}

	public function notificacionVista($idNotificacionHasDeportista,$dniDeportista)
	{
		global $connect;
		$consulta= "UPDATE Notificacion_has_Deportista SET  Visto='1' WHERE Notificacion_idNotificacion='". $idNotificacionHasDeportista ."' AND Deportista_DNI = '".$dniDeportista."' ";
			 $connect->query($consulta);
	}

	public function delete($notificacion)
	{
		global $connect;
	    $consulta = "DELETE FROM Notificacion_has_Deportista WHERE Notificacion_idNotificacion='". $notificacion->getId() ."' " ;
	    $connect->query($consulta);
	}




}
 ?>
