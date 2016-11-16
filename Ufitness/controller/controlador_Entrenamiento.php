<?php
require_once("../model/Deportista.php");
require_once("../model/EntrenamientoMapper.php");
require_once("../model/EntrenamientoHasEjercicioMapper.php");
require_once("../model/UsuarioMapper.php");

class controlador_Entrenamiento{

  private $entrenamientoMapper;
  private $usuarioMapper;

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

  public function anhadir() {
    echo "hola";
    $entrenamientoMapper = new EntrenamientoMapper();
    $entrenamientoHasEjercicioMapper = new EntrenamientoHasEjercicioMapper();
  }
/*
    if(isset($_POST["nombre"])){ //Cogemos los datos de http

      $entrenamiento = new Entrenamiento($_POST["nombre"],$_POST["duracion"],$_POST["nivel"]);
      $entrenamientoMapper->save($entrenamiento);

      $idEntrenamiento  = $EntrenamientoMapper->buscarEntrenamientoId($entrenamiento);
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
          $entrenamientoHasEjerc = new EntrenamientoHasEjercicio($idEntrenamiento,$ejercicio[$i],$_POST["seriesxRep"],$_POST["carga"]);
          $entrenamientoHasEjercicioMapper->save($entrenamientoHasEjerc);
        }
      }


      try{
	       //$usuario->comprobarDatos(); // if it fails, ValidationException
         //$deportista->comprobarDatos();

      	//#####
      	if (!$usuarioMapper->usuarioExiste($deportista->getDni())){

            $deportistaMapper->guardarDeportista($deportista);
            $usuarioMapper->guardarUsuario($usuario);

            header("Location: ../view/adminDeportistas.php");
      	}} else {

      	  $errors = array();
      	  $errors["dni"] = "El deportista ya existe";
      	  print_r($errors);
          //header("Location: ../view/error.php");
      	}
      }catch(ValidationException $ex) {
	    // Get the errors array inside the exepction...
	     $errors = $ex->getErrors();
       print_r($errors);

     }
    }

    // Put the User object visible to the view
    $this->view->setVariable("user", $user);

    // render the view (/view/users/register.php)
    $this->view->render("users", "register");


  }*/

  public function eliminar() {
    if (!isset($_POST["dni"])) {
      throw new Exception("id is mandatory");
    }
    /*if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing posts requires login");
    }*/


    $deportistadni = $_REQUEST["dni"];
    $deportista = $this->deportistaMapper->buscarDni($deportistadni);

    if ($deportista == NULL) {
      throw new Exception("no such post with id: ".$deportistadni);
    }

    // Delete the Post object from the database
    $this->deportistaMapper->eliminarDeportista($deportista);
    $this->usuarioMapper->eliminarUsuario($deportista);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of posts
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    //$this->view->setFlash(sprintf(i18n("Post \"%s\" successfully deleted."),$post ->getTitle()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=posts&action=index")
    // die();
    //$this->view->redirect("posts", "index");
    header("Location: ../view/adminDeportistas.php");
  }

}

?>
