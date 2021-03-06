<?php
require_once("../model/Entrenamiento.php");
require_once("../model/Deportista.php");
require_once("../model/Sesion.php");
require_once("../model/EntrenamientoHasEjercicio.php");



class EntrenamientoMapper {

  public function save($entrenamiento) {
      global $connect;
	    $consulta= " INSERT INTO Entrenamiento (duracion, nombre, nivel)
      VALUES ('". $entrenamiento->getDuracion() ."','". $entrenamiento->getNombre() ."', '". $entrenamiento->getNivel() ."')";
	    $connect->query($consulta);


	}

  public function obtenerIdEntrenamiento($entrenamiento) {
      global $connect;
	    $consulta= " SELECT * FROM Entrenamiento WHERE nombre='".$entrenamiento->getNombre()."' ";
      $resultado = $connect->query($consulta);
      $entrenamiento = mysqli_fetch_assoc($resultado);

      if($entrenamiento!=NULL) {
    			return $entrenamiento["idEntrenamiento"];
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


  public function eliminarEntrenamiento($entrenamiento) {
    global $connect;
    $consulta = "DELETE FROM Entrenamiento WHERE idEntrenamiento='".$entrenamiento->getId()."' ";
    $connect->query($consulta);
  }

  public function modificarEntrenamiento($entrenamiento){
    global $connect;
    $consulta= "UPDATE Entrenamiento set duracion='".$entrenamiento->getDuracion()."',nombre='".$entrenamiento->getNombre()."',nivel='".$entrenamiento->getNivel()."' WHERE idEntrenamiento='".$entrenamiento->getId()."'";
    $connect->query($consulta);
  }

	  public static function  ejerciciosRealizados(Sesion $sesion)
  {
      global $connect;
      $consulta= "INSERT INTO Sesion(Deportista_Usuario_Dni,Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento,Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio,fecha,anotaciones) VALUES ('". $sesion->getDniDeportista() ."',
       '". $sesion->getidHasEntrenamiento() ."', '". $sesion->getIdHasEjercicio() ."','". $sesion->getFechaSesion() ."', '". $sesion->getAnotaciones() ."')";
      $connect->query($consulta);

      //Esto lo hago para mirar si una sesion tiene todos los ejercicios realizados y así marcar el entrenamiento como completada
      $consulta = "SELECT * FROM Sesion WHERE Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento ='". $sesion->getidHasEntrenamiento() ."' AND Deportista_Usuario_Dni ='". $sesion->getDniDeportista() ."'";
      $result = $connect->query($consulta);
      $numEjerciciosRealizados = $result->num_rows;

      $consulta = "SELECT * FROM Entrenamiento_has_Ejercicio WHERE Entrenamiento_idEntrenamiento ='". $sesion->getidHasEntrenamiento() ."'";
      $result = $connect->query($consulta);
      $numEjerciciosEntrenamiento = $result->num_rows;
      if ($numEjerciciosRealizados == $numEjerciciosEntrenamiento){
        $consulta= "UPDATE Entrenamiento set completado = 1 WHERE idEntrenamiento = '". $sesion->getidHasEntrenamiento() ."'";
        $connect->query($consulta);
      }else{
        $consulta= "UPDATE Entrenamiento set completado = 0 WHERE idEntrenamiento = '". $sesion->getidHasEntrenamiento() ."'";
        $connect->query($consulta);
      }
    }

	public static function ejercicioDiario($dniDeportista,$idEntrenamiento,$idEjercicio,$fecha)
  {
    global $connect;

    $consulta="SELECT * FROM Sesion WHERE Deportista_Usuario_Dni='". $dniDeportista."' AND Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento='". $idEntrenamiento."' AND Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio='". $idEjercicio ."' AND fecha='". $fecha."'";

    $res=$connect->query($consulta);

    $fila = $res->num_rows;

    if($fila > 0)
      return true;

  }

	  public function listarIdEntrenamientosDeportista($dniDeportista){
    global $connect;
    $consulta ="SELECT * FROM Entrenamiento_has_Deportista WHERE Deportista_DNI='". $dniDeportista ."' ";
    $resultado = $connect->query($consulta);
    $listaIdEntDepor = array();
    while ($actual = mysqli_fetch_assoc($resultado)) {
        array_push($listaIdEntDepor, $actual['Entrenamiento_idEntrenamiento']);
    }
    return $listaIdEntDepor;
  }


  public function asignarEntrenamiento($dni,$nombre){
	  global $connect;

	  $consulta = "SELECT idEntrenamiento FROM Entrenamiento WHERE nombre= '" .$nombre."'";
	  $resultado = $connect->query($consulta);
	  $entrenamiento = mysqli_fetch_assoc($resultado);
	  $consult="INSERT INTO Entrenamiento_has_Deportista(Entrenamiento_idEntrenamiento,Deportista_DNI) VALUES('".$entrenamiento['idEntrenamiento']."','".$dni."')";

	  if($connect->query($consult)){
	    return true;
	  }else{
		return false;
		}

  }

  public function listarEntrenamientosDeportista($nivel, $dni){

	  global $connect;

	  $consulta = "SELECT * FROM Entrenamiento E, Entrenamiento_has_Deportista ED WHERE E.idEntrenamiento = ED.Entrenamiento_idEntrenamiento AND E.nivel ='$nivel' AND  ED.Deportista_DNI='$dni'  ";
	  $resultado = $connect->query($consulta);
	  $listaEntrenamientos = array();
	  while ($entrenamiento = mysqli_fetch_assoc($resultado)) {
		  $entrenamientos = new Entrenamiento($entrenamiento["duracion"],$entrenamiento["nombre"],$entrenamiento["nivel"], $entrenamiento["idEntrenamiento"]);
        array_push($listaEntrenamientos, $entrenamientos);
    }
    return $listaEntrenamientos;

  }


  public function listarEntrenamientosCompletadosDeportista($nivel, $dni){

	  global $connect;

	  $consulta = "SELECT * FROM Entrenamiento E, Entrenamiento_has_Deportista ED WHERE E.idEntrenamiento = ED.Entrenamiento_idEntrenamiento AND E.nivel ='$nivel' AND  ED.Deportista_DNI='$dni' AND E.completado = 1 ";
	  $resultado = $connect->query($consulta);
	  $listaEntrenamientos = array();
	  while ($entrenamiento = mysqli_fetch_assoc($resultado)) {
		  $entrenamientos = new Entrenamiento($entrenamiento["duracion"],$entrenamiento["nombre"],$entrenamiento["nivel"], $entrenamiento["idEntrenamiento"]);
        array_push($listaEntrenamientos, $entrenamientos);
    }
    return $listaEntrenamientos;

  }

}
