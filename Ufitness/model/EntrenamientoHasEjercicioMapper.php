<?php
require_once("../model/EntrenamientoHasEjercicio.php");

class EntrenamientoHasEjercicioMApper{

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
}

?>
