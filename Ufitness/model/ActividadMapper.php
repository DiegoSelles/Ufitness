<?php
require_once("../resources/conexion.php");

class ActividadMapper {

  public function listarActividades (){
		global $connect;
		$consulta = $connect->query("SELECT * FROM Actividad");
		$listaActividades = array();
		while ($actual = mysqli_fetch_assoc($consulta)) {

      $actividad = new Actividad ($actual["Usuario_Dni"], $actual["nombre"], $actual["numPlazas"], $actual["horario"],
      $actual["lugar"], $actual["tipoAct"], $actual["idActividad"]);
			array_push($listaActividades, $actividad);
		}
		return $listaActividades;
	}

  public function getActividad ($idActividad){
			global $connect;
			$consulta = $connect->query("SELECT * FROM Actividad WHERE idActividad = $idActividad");
      $actual = mysqli_fetch_assoc($consulta);

      $actividad = new Actividad ($actual["Usuario_Dni"], $actual["nombre"], $actual["numPlazas"], $actual["horario"],
      $actual["lugar"], $actual["tipoAct"], $actual["idActividad"]);

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

  public function eliminarActividad ($idActividad){
    global $connect;
		$connect->query("DELETE FROM Actividad WHERE idActividad = $idActividad");
	}

	public function updateActividad($actividad,$id){
		global $connect;
		$consulta = $connect->query("SELECT Dni FROM Usuario WHERE nombre ='" .$actividad->getMonitor(). "'");
		$resultado = mysqli_fetch_assoc($consulta);
		$consult = "UPDATE Actividad set Usuario_Dni ='" .$resultado['Dni']."',nombre='".$actividad->getNombre()."', numPlazas='".$actividad->getNumPlazas()."', horario='".$actividad->getHorario()."', lugar='".$actividad->getLugar()."', tipoAct='".$actividad->getTipoActividad()."' where idActividad = '".$id."'";
		if($connect->query($consult))
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
	
	public function reservar($idActividad,$usuarioActual){
	   global $connect;
	   $consulta = "SELECT numPlazas FROM Actividad WHERE idActividad ='" .$idActividad. "'" ;
	   $resultado= $connect->query($consulta);
	   $plazas = mysqli_fetch_assoc($resultado);
	   $query = "SELECT count(idReserva) FROM Reserva WHERE Deportista_Usuario_Dni = '".$usuarioActual."' and Actividad_idActividad ='".$idActividad."'";
	   $result = $connect->query($query);
	   $existe = mysqli_fetch_assoc($result);

		if($plazas['numPlazas'] == 0){
				echo '<script language="javascript">alert("No quedan plazas disponibles para esta actividad");</script>';
		}else if($existe['count(idReserva)'] != 0 ){
			echo '<script language="javascript">alert("Ya tienes una plaza reservada en esta actividad");</script>';
			}else{
				$plazasRestantes = $plazas['numPlazas'] - 1;
				$plazasOcupadas = 0;
				$plazasOcupadas++;
				mysqli_query($connect,"UPDATE Actividad SET numPlazas = '" .$plazasRestantes. "' WHERE idActividad ='" .$idActividad. "'");
				mysqli_query($connect,"INSERT INTO Reserva(Deportista_Usuario_Dni,Actividad_idActividad,fecha,plazas_ocupadas) VALUES('" .$_SESSION['Dni']."', '" .$idActividad."', '" .date("Y-m-d")."', '" .$plazasOcupadas."')");
				echo '<script language="javascript">alert("Has reservado plaza en esta actividad");window.location.href="../view/adminActividades.php";</script>';
			}
		
	}

}
