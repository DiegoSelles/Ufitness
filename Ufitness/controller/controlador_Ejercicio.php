<?php
require_once("../model/Ejercicio.php");
require_once("../model/EjercicioMapper.php");

class controlador_Ejercicio{

  private $ejercicioMapper;

  public function __construct() {

    $this->ejercicioMapper = new ejercicioMapper();
  }


  public function register() {

    $deportistaMapper = new DeportistaMapper();
    $usuarioMapper = new UsuarioMapper();

    if(isset($_POST["nombre"])){ //Cogemos los datos de http

      $edad = date(DATE_ATOM)-$_POST["fecha"];//Calculamos la edad

      $deportista = new Deportista($_POST["nombre"],$_POST["email"],$_POST["password"],$edad,$_POST["dni"],"deportista",$_POST["riesgos"],$_POST["tipo"]);
      $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$edad,$_POST["dni"],"deportista");

      try{
	       //$usuario->comprobarDatos(); // if it fails, ValidationException
         //$deportista->comprobarDatos();

      	//#####
      	if (!$usuarioMapper->usuarioExiste($deportista->getDni())){

            $deportistaMapper->guardarDeportista($deportista);
            $usuarioMapper->guardarUsuario($usuario);
            echo "Se ha creado?";
            //header("Location: ../view/adminDeportistas.php");
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

      }
    }
    /*
    // Put the User object visible to the view
    $this->view->setVariable("user", $user);

    // render the view (/view/users/register.php)
    $this->view->render("users", "register");
    */

  }

  public function listaEjercicios(){
    return $this->ejercicioMapper->listarEjercicios();
  }

  public function listaEjerciciosGrupo($grupo){
    return $this->ejercicioMapper->listarEjerciciosGrupo($grupo);
  }

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