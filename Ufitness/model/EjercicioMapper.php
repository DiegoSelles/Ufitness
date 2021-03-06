<?php


require_once(__DIR__."/../resources/conexion.php");
require_once(__DIR__."/../model/Ejercicio.php");
if(!isset($_SESSION)) session_start();

class EjercicioMapper {

  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  public function registrarEjercicio($ejercicio) {
    global $connect;
	  
	    $consulta= " INSERT INTO Ejercicio (Usuario_Dni, nombre, tipoEjer, maquina, grupoMuscular, descripcion, imagen, video)
      VALUES ('". $ejercicio->getUsuarioDni() ."','". $ejercicio->getNombre() ."', '". $ejercicio->getTipoEjercicio() ."',
      '". $ejercicio->getMaquina() ."' ,'". $ejercicio->getGrupoMuscular() ."' ,'". $ejercicio->getDescripcion() ."','". $ejercicio->getImagen() ."','". $ejercicio->getVideo() ."')";
	    $connect->query($consulta);

	}

  public function listarEjerciciosGrupo($grupo) {
    global $connect;
		$consulta = "SELECT * FROM Ejercicio WHERE grupoMuscular = '$grupo'";
    $resultado = mysqli_query($connect, $consulta) or die (mysqli_error($connect));
		$listaEjercicios = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {
        $ejercicio = new Ejercicio($actual["nombre"],$actual["Usuario_Dni"],$actual["tipoEjer"],$actual["grupoMuscular"],$actual["maquina"],$actual["descripcion"],$actual["imagen"],$actual["video"], $actual["idEjercicio"]);
				array_push($listaEjercicios, $ejercicio);
		}
		return $listaEjercicios;
	}

  public function listarEjercicios() {
    global $connect;
		$consulta = "SELECT * FROM Ejercicio";
    $resultado = mysqli_query($connect, $consulta) or die (mysqli_error($connect));
		$listaEjercicios = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {
        $ejercicio = new Ejercicio($actual["nombre"],$actual["Usuario_Dni"],$actual["tipoEjer"],$actual["grupoMuscular"],$actual["maquina"],$actual["descripcion"],$actual["imagen"],$actual["video"], $actual["idEjercicio"]);
				array_push($listaEjercicios, $ejercicio);
		}
		return $listaEjercicios;
	}

  public function modificarEjercicio($ejercicio, $idEjercicio){
		global $connect;
		$consulta= "UPDATE Ejercicio set Usuario_Dni='".$ejercicio->getUsuarioDni()."',nombre='".$ejercicio->getNombre()."',
    tipoEjer='".$ejercicio->getTipoEjercicio()."', maquina='".$ejercicio->getMaquina()."',
    grupoMuscular='".$ejercicio->getGrupoMuscular()."', descripcion='".$ejercicio->getDescripcion()."', imagen='".$ejercicio->getImagen()."'
    , video='".$ejercicio->getVideo()."'
    WHERE idEjercicio='".$idEjercicio."'";
		$connect->query($consulta);
		
	}

  public function eliminarEjercicio($ejercicio) {
    global $connect;
    $consulta = "DELETE FROM Ejercicio WHERE idEjercicio ='".$ejercicio->getIdEjercicio()."' ";
    $connect->query($consulta);
    $consulta = "DELETE FROM Entrenamiento_has_Ejercicio WHERE idEjercicio ='".$ejercicio->getIdEjercicio()."' ";
    $connect->query($consulta);
    //elimina la imagen asociada
    unlink ("../imagenesSubidas/". $ejercicio->getImagen());
  }


  public function buscarId($id){
    global $connect;
		$consulta = "SELECT * FROM Ejercicio WHERE idEjercicio ='". $id ."'";
		$resultado = $connect->query($consulta);
		$actual = mysqli_fetch_assoc($resultado);
		$ejercicio = new Ejercicio($actual["nombre"],$actual["Usuario_Dni"],$actual["tipoEjer"],$actual["grupoMuscular"],
    $actual["maquina"],$actual["descripcion"], $actual["imagen"], $actual["video"], $actual["idEjercicio"]);
		return $ejercicio;
  }
}
?>
