<?php
require_once("../resources/conexion.php");

class ActividadMapper {

  public function listarActividades (){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad");
		$listaActividades = array();
		while ($actividad = mysqli_fetch_assoc($consulta)) {
				array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}

  public function getActividad ($idActividad){
			global $connect;
			$consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad = $idActividad");
			$actividad = mysqli_fetch_assoc($consulta);
			return $actividad;
	}

  public function registrarActividad ($actividad, $nombre_monitor){
		global $connect;
		$consulta = $connect->query("SELECT Dni FROM Usuario WHERE nombre ='" .$nombre_monitor. "'");
		$resultado = mysqli_fetch_assoc($consulta);
		$sql = " INSERT INTO Actividad (Usuario_Dni, nombre, numPlazas, horario, lugar, tipoAct)
		VALUES ('". $resultado['Dni'] ."', '". $actividad->getNombre() ."', '". $actividad->getNumPlazas() ."', '". $actividad->getHorario() ."', '". $actividad->getLugar() ."', '". $actividad->getTipoActividad() ."')";
		if($connect->query($sql))
		echo "<script language='javascript'>window.location='../view/adminActividades.php'</script>";
	}

  public function findAllActividades() {
    $stmt = $this->db->query("SELECT * FROM Actividad");
    $actividades_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $actividades = array();

    foreach ($actividades_db as $actividad) {
      array_push($actividades, new Actividad($actividad["nombre"], $actividad["numPlazas"], $actividad["horario"], $actividad["lugar"], $actividad["tipoActividad"]));
    }

    return $actividades;
  }

  public function findActividadById($actividadid){
    $stmt = $this->db->prepare("SELECT * FROM Actividad WHERE id=?");
    $stmt->execute(array($actividadid));
    $actividad = $stmt->fetch(PDO::FETCH_ASSOC);

    if($actividad != null) {
      return new Actividad($actividad["nombre"], $actividad["numPlazas"], $actividad["horario"], $actividad["lugar"], $actividad["tipoActividad"]);
    } else {
      return NULL;
    }
  }

  public function save(Actividad $actividad) {
    $stmt = $this->db->prepare("INSERT INTO Actividad(nombre, numPlazas, horario, lugar, tipoAct) values (?,?,?,?,?)");
    $stmt->execute(array($actividad->getNombre(), $actividad->getnumPlazas(),$actividad->getHorario(),$actividad->getLugar(),$actividad->getTipoActividad()));
    return $this->db->lastInsertId();
  }

  public function update(Actividad $actividad) {
    $stmt = $this->db->prepare("UPDATE Actividad set nombre=?, numPlazas=?, horario=?, lugar=?, tipoAct=? where id=?");
    $stmt->execute(array($actividad->getNombre(), $actividad->getnumPlazas(),$actividad->getHorario(),$actividad->getLugar(),$actividad->getTipoActividad(), $actividad->getId()));
  }

  public function delete(Actividad $actividad) {
    $stmt = $this->db->prepare("DELETE from Actividad WHERE id=?");
    $stmt->execute(array($actividad->getId()));
  }

}
