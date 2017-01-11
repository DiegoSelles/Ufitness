<?php
require_once("../resources/conexion.php");


class NotificacionMapper {

	public static function find($idNotificacion){
		global $connect;
		$consulta = "SELECT * FROM Notificacion WHERE idNotificacion='". $idNotificacion ."' ";
		$res = $connect->query($consulta);
		$resultado = mysqli_fetch_assoc($res);

		if($resultado != null) {
      return new Notificacion($resultado["titulo"],$resultado["descripcion"],$resultado["Usuario_Dni"],$resultado["idNotificacion"]);
    } else {
      return NULL;
    }
	}

	public static function listaNotificaciones(){
		global $connect;
		$consulta = "SELECT * FROM Notificacion ";
		$resultado = $connect->query($consulta);
		$listaNotificaciones = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {
        $notificacion = new Notificacion($actual["titulo"],$actual["descripcion"],$actual["Usuario_Dni"],$actual["idNotificacion"]);
				array_push($listaNotificaciones, $notificacion);
		}
		return $listaNotificaciones;
	}

	public static function findLastId(){
		global $connect;
		$consulta = "SELECT * FROM Notificacion ORDER BY `idNotificacion` DESC LIMIT 1;";
		$res = $connect->query($consulta);
		$resultado = mysqli_fetch_assoc($res);

    if($resultado != null) {
      return $resultado["idNotificacion"];
    } else {
      return NULL;
    }
	}


	public function save(Notificacion $notificacion)
	{
		global $connect;
	    $consulta= " INSERT INTO Notificacion (Usuario_Dni, titulo, descripcion) VALUES ('". $notificacion->getEmisor() ."', '". $notificacion->getTitulo() ."', '". $notificacion->getDescripcion() ."')";
	    $connect->query($consulta);
	}

	public function delete($idNotificacion)
	{
		global $connect;
	    $consulta = "DELETE FROM Notificacion WHERE idNotificacion='". $idNotificacion ."' " ;
	    $connect->query($consulta);
	}




}
 ?>
