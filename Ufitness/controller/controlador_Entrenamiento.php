<?php
require_once("../model/Deportista.php");
require_once("../model/EntrenamientoMapper.php");
require_once("../model/EntrenamientoHasEjercicioMapper.php");
require_once("../model/UsuarioMapper.php");

class controlador_Entrenamiento{

  private $entrenamientoMapper;
  private $usuarioMapper;
  private $entrenamientoHasEjercicioMapper;

  public function __construct() {

    $this->entrenamientoMapper = new EntrenamientoMapper();
    $this->usuarioMapper = new UsuarioMapper();
    $this->entrenamientoHasEjercicioMapper = new EntrenamientoHasEjercicioMapper();
  }

  public function buscarEntrenamientoId($id){
    return $this->entrenamientoMapper->buscarEntrenamientoId($id);
  }

  	public function listarEntrenamientos (){
		return $this->entrenamientoMapper->listarEntrenamientos();
	}

  public function listarEntrenamientosNivel($nivel){
    return $this->entrenamientoMapper->listarEntrenamientosNivel($nivel);
  }

  public function ejerciciosEntrenamiento($id){
    return $this->entrenamientoHasEjercicioMapper->ejerciciosEntrenamiento($id);
  }

  public function ejercicioEnEntrenamiento($idEnt,$idEjer){
    $listaEjercicios = $this->entrenamientoHasEjercicioMapper->ejerciciosEntrenamiento($idEnt);

    foreach ($listaEjercicios as $ejercicio) {
      if($ejercicio->getIdEjercicio()==$idEjer){
        return $ejercicio;
      }
    }
    return NULL;
  }

  public function entrenamientoTieneEjer($idEnt,$idEjer){
    $listaEjercicios = $this->entrenamientoHasEjercicioMapper->ejerciciosEntrenamiento($idEnt);

    foreach ($listaEjercicios as $ejercicio) {
      if($ejercicio->getIdEjercicio()==$idEjer){
        return true;
      }
    }
    return false;
  }

  public function modificarEntrenamiento (){
		$entrenamientoMapper = new EntrenamientoMapper();
    $entrenamientoHasEjercicioMapper = new EntrenamientoHasEjercicioMapper();

    if(isset($_POST["nombre"])){ //Cogemos los datos de http
      $idEntrenamiento  = $_POST['idEnt'];
      $entrenamiento = new Entrenamiento($_POST["duracion"],$_POST["nombre"],$_POST["nivel"]);
      $entrenamientoMapper->modificarEntrenamiento($entrenamiento);

      $listaEjerEntAntiguos = $entrenamientoHasEjercicioMapper->ejerciciosEntrenamiento($idEntrenamiento);
      $listaIdEjerAntiguos = array();
      foreach ($listaEjerEntAntiguos as $ejerEntAntiguo) {
        array_push($listaIdEjerAntiguos,$ejerEntAntiguo->getIdEjercicio());
      }


      $ejercicio = $_POST['ejercicio'];
      if(empty($ejercicio))
      {
        echo "No has añadido Ejercicios";
      }
      else
      {
        $N = count($ejercicio);
        for($i=0; $i < $N; $i++)
        {
          $sxr="seriesxRep".$ejercicio[$i];
          $carga="carga".$ejercicio[$i];
          echo $ejercicio[$i]."->".$_POST[$sxr]."->".$_POST[$carga]."    ";
          $entrenamientoHasEjer = new EntrenamientoHasEjercicio($idEntrenamiento,$ejercicio[$i], $_POST[$sxr] , $_POST[$carga]);

          $entcontroller= new controlador_Entrenamiento();
          $entTieneEjer = $entcontroller->entrenamientoTieneEjer($idEntrenamiento,$ejercicio[$i]);

          if($entTieneEjer){
            echo "hola 1";
            $entrenamientoHasEjercicioMapper->modificarEntrenamiento($entrenamientoHasEjer);
          }elseif(!$entTieneEjer){
            echo "hola 2";
            $entrenamientoHasEjercicioMapper->save($entrenamientoHasEjer);
          }
        }
        foreach ($listaIdEjerAntiguos as $idEjerAntiguo) {
          if(!in_array($idEjerAntiguo, $ejercicio)){
            $entrenamientoHasEjercicioMapper->eliminarEjerEntHasEjer($idEntrenamiento,$idEjerAntiguo);
          }
        }
      }
	   }
  }

  public function anhadir() {
    $entrenamientoMapper = new EntrenamientoMapper();
    $entrenamientoHasEjercicioMapper = new EntrenamientoHasEjercicioMapper();


    if(isset($_POST["nombre"])){ //Cogemos los datos de http

      $entrenamiento = new Entrenamiento($_POST["duracion"],$_POST["nombre"],$_POST["nivel"]);
      $entrenamientoMapper->save($entrenamiento);

      $idEntrenamiento  = $entrenamientoMapper->obtenerIdEntrenamiento($entrenamiento);
      $ejercicio = $_POST['ejercicio'];
      if(empty($ejercicio))
      {
        echo "No has añadido Ejercicios";
      }
      else
      {
        $N = count($ejercicio);
        for($i=0; $i < $N; $i++)
        {
          $sxr="seriesxRep".$ejercicio[$i];
          $carga="carga".$ejercicio[$i];
          $entrenamientoHasEjerc = new EntrenamientoHasEjercicio($idEntrenamiento,$ejercicio[$i], $_POST[$sxr] , $_POST[$carga] );

          $entrenamientoHasEjercicioMapper->save($entrenamientoHasEjerc);
        }
      }

      /*
      try{
	       //$usuario->comprobarDatos(); // if it fails, ValidationException
         //$deportista->comprobarDatos();

      	//#####
      	if (!$usuarioMapper->usuarioExiste($deportista->getDni())){

            $deportistaMapper->guardarDeportista($deportista);
            $usuarioMapper->guardarUsuario($usuario);

            header("Location: ../view/adminDeportistas.php");
      	} else {

      	  $errors = array();
      	  $errors["dni"] = "El deportista ya existe";
      	  print_r($errors);
          //header("Location: ../view/error.php");
      	}
      }catch(ValidationException $ex) {
	    // Get the errors array inside the exepction...
	     $errors = $ex->getErrors();
       print_r($errors);

     }*/
    }
    header("Location: ../view/adminEntrenamientos.php");


  }

  public function eliminarEntrenamiento() {

    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }
    $entrenamientoMapper = new EntrenamientoMapper();
    $entrenamientoHasEjercicioMapper = new EntrenamientoHasEjercicioMapper();

    $idEntrenamiento = $_REQUEST["id"];
    $entrenamiento = $entrenamientoMapper->buscarEntrenamientoId($idEntrenamiento);
    $listaEntrenamientoHasEjercicio = $entrenamientoHasEjercicioMapper->ejerciciosEntrenamiento($idEntrenamiento);

    if ($entrenamiento != NULL) {
        $entrenamientoMapper->eliminarEntrenamiento($entrenamiento);
    }else throw new Exception("No existe un Entrenamiento con ID: ".$idEntrenamiento);

    if ($listaEntrenamientoHasEjercicio != NULL) {
      $entrenamientoHasEjercicioMapper->eliminarEntHasEjer($entrenamiento->getId());
    }
    
    header("Location: ../view/adminEntrenamientos.php");
  }

    public function asignarEntrenamiento($dni,$nombre){
	  global $connect;
	  $consulta = "SELECT idEntrenamiento FROM Entrenamiento WHERE nombre= '" .$nombre."'";
	  $resultado = $connect->query($consulta);
	  $entrenamiento = mysqli_fetch_assoc($resultado);
	  $consult="INSERT INTO Entrenamiento_has_Deportista(Entrenamiento_idEntrenamiento,Deportista_DNI) VALUES('".$entrenamiento['idEntrenamiento']."','".$dni."')";
	  $connect->query($consult);

  }

}

?>
