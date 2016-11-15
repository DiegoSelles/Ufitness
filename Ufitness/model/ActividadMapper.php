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
	
	public function updateActividad($actividad, $nombre_monitor){
		global $connect;
		$consulta = $connect->query("SELECT Dni FROM Usuario WHERE nombre ='" .$nombre_monitor. "'");
		$resultado = mysqli_fetch_assoc($consulta);
		$sql =$connect->query("SELECT idActividad FROM Actividad WHERE nombre = '".$actividad->getNombre()."' and Usuario_Dni = '".$resultado['Dni']."'");
		//SELECT `idActividad` FROM `Actividad` WHERE `Usuario_Dni`="66666666C" and `nombre`="Spinnig"
		$result = mysqli_fetch_assoc($sql);
		$consult = "UPDATE Actividad set Usuario_Dni ='" .$resultado['Dni']."',nombre='".$actividad->getNombre()."', numPlazas='".$actividad->getNumPlazas()."', horario='".$actividad->getHorario()."', lugar='".$actividad->getLugar()."', tipoAct='".$actividad->getTipoActividad()."' where idActividad = '".$result['idActividad']."'";
		//UPDATE `Actividad` SET `Usuario_Dni`="66666666C",`nombre`="Spinnig",`numPlazas`="50",`horario`="11",`lugar` ="Ou",`tipoAct`="individual" WHERE `idActividad` = "1"
		if($connect->query($consult)){
			//echo "<script language='javascript'>window.location='../view/adminActividades.php'</script>";
			//echo $modificar;
			echo $result['idActividad']."\n";
			echo $resultado['Dni']."\n";
			echo $actividad->getNombre()."\n";
		}
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
	global $connect;
    $consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad='" .$actividadid. "'");
	$actividad = mysqli_fetch_assoc($consulta);
	$query = $connect->query("SELECT Nombre FROM Usuario WHERE Dni = '" .$actividad['Usuario_Dni']. "' ");
	$monitor = mysqli_fetch_assoc($query);

    if($actividad != null) {
      return new Actividad($monitor['Nombre'],$actividad["nombre"], $actividad["numPlazas"], $actividad["horario"], $actividad["lugar"], $actividad["tipoAct"],$actividad['idActividad']);
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
