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

  public function registrarActividad (){
		global $connect;
		//Obtener el dni del monitor
		$nombre_monitor = $_POST['monitor'];
		$sentencia = $connect->prepare("SELECT Dni FROM Usuario WHERE nombre = ?");
		$sentencia->bind_param("s", $nombre_monitor);
		$sentencia->execute();
		$sentencia->bind_result($dni_monitor);
		$sentencia->fetch();

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
		//El id al ser autoincremental se pasa como nulo
		$idActividad = NULL;

		//Algo falla en la sentencia porque no se añade la actividad en la BD aunque no da ningun error ahora
		$sql = "INSERT INTO Actividad (idActividad, Usuario_Dni, nombre, numPlazas, horario, lugar, tipoAct)
		VALUES ('". $idActividad ."', '". $dni_monitor ."', '". $nombre ."', '". $numPlazas ."', '". $horario ."', '". $lugar ."', '". $tipo ."')";

		//La sentencia anterior no se realiza por algun motivo entonces devuelve false
		if($sentencia = $connect->query($sql)){
      echo "hola";
      //header("Location: ../view/adminActividades.php");
    }else{
      echo "La sentencia sql no funciona";
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
