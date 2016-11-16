<?php
require_once("../model/Entrenamiento.php");
require_once("../model/Deportista.php");



class EntrenamientoMapper {
	
  public function findAllEntrenamientos() {
    $stmt = $this->db->query("SELECT * FROM Entrenamiento");
    $entrenamientos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $entrenamientos = array();

    foreach ($entrenamientos_db as $entrenamiento) {
      $deportista = new Deportista($entrenamiento["Deportista_DNI"]);
      array_push($entrenamientos, new Entrenamiento($entrenamiento["idEntrenamiento"], $deportista, $entrenamiento["duracion"]));
    }

    return $entrenamientos;
  }

  public function findEntrenamientoById($idEntrenamiento){
    $stmt = $this->db->prepare("SELECT * FROM Entrenamiento WHERE id=?");
    $stmt->execute(array($idEntrenamiento));
    $entrenamiento = $stmt->fetch(PDO::FETCH_ASSOC);

    if($entrenamiento != null) {
      return new Entrenamiento(
      $entrenamiento["idEntrenamiento"],
      new Deportista($entrenamiento["Deportista_DNI"]),
      $entrenamiento["duracion"]);
      } else {
        return NULL;
      }
    }


  public function save(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("INSERT INTO Entrenamiento(Deportista_DNI, duracion) values (?,?)");
    $stmt->execute(array($entrenamiento->getDeportista()->getDni(),$entrenamiento->getDuracion()));
    return $this->db->lastInsertId();
  }
  
  	function listarEntrenamientos (){
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
