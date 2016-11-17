<?php
require_once("../model/EntrenamientoHasEjercicio.php");

class EntrenamientoHasEjercicioMapper{

  public function __construct(){}

    public function ejerciciosEntrenamiento($id){
      global $connect;
    	$consulta ="SELECT * FROM Entrenamiento_has_Ejercicio WHERE Entrenamiento_idEntrenamiento='".$id."' ";
    	$resultado = $connect->query($consulta);
    	$listaEjercicios = array();
      while ($actual = mysqli_fetch_assoc($resultado)) {
          $ejercicio=new EntrenamientoHasEjercicio($actual['Entrenamiento_idEntrenamiento'],$actual['Ejercicio_idEjercicio'],$actual['series_repeticiones'],$actual['carga']);
    			array_push($listaEjercicios, $ejercicio);
    	}
    	return $listaEjercicios;
    }

    public function save($entHasEjer){
      global $connect;
	    $consulta= " INSERT INTO Entrenamiento_has_Ejercicio (Entrenamiento_idEntrenamiento, Ejercicio_idEjercicio, series_repeticiones, carga)
      VALUES ('". $entHasEjer->getIdEntrenamiento() ."','". $entHasEjer->getIdEjercicio() ."', '". $entHasEjer->getSxR() ."','". $entHasEjer->getCarga() ."')";
	    $connect->query($consulta);
    }

    public function modificarEntrenamiento($entHasEjer){
      global $connect;
      $consulta= "UPDATE Entrenamiento_has_Ejercicio set series_repeticiones='".$entHasEjer->getSxR()."', carga='".$entHasEjer->getCarga()."' WHERE Entrenamiento_idEntrenamiento='".$entHasEjer->getIdEntrenamiento()."' AND Ejercicio_idEjercicio='".$entHasEjer->getIdEjercicio()."' ";
      $connect->query($consulta);
    }

    public function eliminarEntHasEjer($id) {
      global $connect;
      $consulta = "DELETE FROM Entrenamiento_has_Ejercicio WHERE Entrenamiento_idEntrenamiento='".$id."' ";
      $connect->query($consulta);
    }

    public function eliminarEjerEntHasEjer($idEnt,$idEjerAnt) {
      global $connect;
      $consulta = "DELETE FROM Entrenamiento_has_Ejercicio WHERE Entrenamiento_idEntrenamiento='".$idEnt."' AND Ejercicio_idEjercicio='".$idEjerAnt."' ";
      $connect->query($consulta);
    }


}

?>
