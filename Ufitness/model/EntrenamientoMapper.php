<?php
require_once("../model/Entrenamiento.php");
require_once("../model/Deportista.php");
require_once("../model/EntrenamientoHasEjercicio.php");



class EntrenamientoMapper {

  public function save($entrenamiento) {
      global $connect;
	    $consulta= " INSERT INTO Entrenamiento (duracion, nombre, nivel)
      VALUES ('". $entrenamiento->getDuracion() ."','". $ejercicio->getNombre() ."', '". $ejercicio->getNivel() ."')";
	    $connect->query($consulta);
      echo "hoooooola";

	}

  public function obtenerIdEntrenamiento($entrenamiento) {
      global $connect;
	    $consulta= " SELECT * FROM Entrenamiento WHERE nombre='".$entrenamiento->getNombre()."' ";
      $resultado = $connect->query($consulta);
      $entrenamiento = mysqli_fetch_assoc($resultado);

      if($entrenamiento!=NULL) {
    			return  new Entrenamiento($entrenamiento["duracion"],$entrenamiento["nombre"],$entrenamiento["nivel"], $entrenamiento["idEntrenamiento"] );
    	}else {
        return NULL;
      }
	}

  public function buscarEntrenamientoId($id){
    global $connect;
  	$consulta ="SELECT * FROM Entrenamiento WHERE idEntrenamiento='".$id."' ";
  	$resultado = $connect->query($consulta);
    $entrenamiento = mysqli_fetch_assoc($resultado);

  	if($entrenamiento!=NULL) {
  			return  new Entrenamiento($entrenamiento["duracion"],$entrenamiento["nombre"],$entrenamiento["nivel"], $entrenamiento["idEntrenamiento"] );
  	}else {
      return NULL;
    }

    }

  public function listarEntrenamientos (){
		global $connect;
		$consulta ="SELECT * FROM Entrenamiento ";
		$resultado = $connect->query($consulta);
		$listaEntrenamientos = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {

				$entrenamiento = new Entrenamiento($actual["duracion"],$actual["nombre"],$actual["nivel"]);
				array_push($listaEntrenamientos, $entrenamiento);
		}
		return $listaEntrenamientos;

	}

	public function listarEntrenamientosNivel ($nivel){
  	global $connect;
  	$consulta ="SELECT * FROM Entrenamiento WHERE nivel='".$nivel."' ";
  	$resultado = $connect->query($consulta);
  	$listaEntrenamientos = array();
  	while ($actual = mysqli_fetch_assoc($resultado)) {
  			$entrenamiento = new Entrenamiento($actual["duracion"],$actual["nombre"],$actual["nivel"], $actual["idEntrenamiento"] );
  			array_push($listaEntrenamientos, $entrenamiento);
  	}
  	return $listaEntrenamientos;

	}

  public function delete(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("DELETE from Entrenamiento WHERE id=?");
    $stmt->execute(array($ejercicio->getidEntrenamiento()));
  }

}
