<?php
require_once("../model/Entrenamiento.php");
require_once("../model/Deportista.php");



class EntrenamientoMapper {


  public function buscarEntrenamientoId($id){

    global $connect;
  	$consulta ="SELECT * FROM Entrenamiento WHERE idEntrenamiento='".$id."' ";
  	$resultado = $connect->query($consulta);
    $entrenamiento = mysqli_fetch_assoc($resultado);

  	if($entrenamiento!=NULL) {
  			return  new Entrenamiento($entrenamiento["duracion"],$entrenamiento["nombre"],$entrenamiento["Deportista_DNI"], $entrenamiento["idEntrenamiento"] );
  	}else {
      return NULL;
    }

    }


  public function save(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("INSERT INTO Entrenamiento(Deportista_DNI, duracion) values (?,?)");
    $stmt->execute(array($entrenamiento->getDeportista()->getDni(),$entrenamiento->getDuracion()));
    return $this->db->lastInsertId();
  }

  public function listarEntrenamientos (){
		global $connect;
		$consulta ="SELECT * FROM Entrenamiento ";
		$resultado = $connect->query($consulta);
		$listaEntrenamientos = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {

				$entrenamiento = new Entrenamiento($actual["Deportista_DNI"],$actual["duracion"],$actual["nombre"]);
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
  			$entrenamiento = new Entrenamiento($actual["duracion"],$actual["nombre"],$actual["Deportista_DNI"], $actual["idEntrenamiento"] );
  			array_push($listaEntrenamientos, $entrenamiento);
  	}
  	return $listaEntrenamientos;

	}

  public function ejerciciosEntrenamiento($id){
    global $connect;
  	$consulta ="SELECT * FROM Entrenamiento_has_Ejercicio WHERE Entrenamiento_idEntrenamiento='".$id."' ";
  	$resultado = $connect->query($consulta);
  	$listaEjercicios = array();
    while ($actual = mysqli_fetch_assoc($resultado)) { /*#############*/
        $consulta ="SELECT * FROM Ejercicio WHERE idEjerc='".$id."' ";
  			array_push($listaEjercicios, $ejercicio);
  	}
  	return $listaEntrenamientos;
  }

  public function update(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("UPDATE Entrenamiento set duracion=? where id=?");
    $stmt->execute(array($entrenamiento->getDuracion(), $entrenamiento->getidEntrenamiento()));
  }

  /**
   * Deletes a Post into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("DELETE from Entrenamiento WHERE id=?");
    $stmt->execute(array($ejercicio->getidEntrenamiento()));
  }

}
