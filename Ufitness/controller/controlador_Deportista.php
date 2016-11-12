<?php
require_once(__DIR__."/../model/Deportista.php");
require_once(__DIR__."/../model/DeportistaMapper.php");
require_once(__DIR__."/../model/UsuarioMapper.php");

class controlador_Deportista{

  private $deportistaMapper;
  private $usuarioMapper;

  public function __construct() {

    $this->deportistaMapper = new DeportistaMapper();
    $this->usuarioMapper = new UsuarioMapper();
  }


  public function register() {

    $deportistaMapper = new DeportistaMapper();
    $usuarioMapper = new UsuarioMapper();

    if(isset($_POST["nombre"])){ //Cogemos los datos de http

      $edad = date(DATE_ATOM)-$_POST["fecha"];//Calculamos la edad
      echo $_POST["nombre"];
      $deportista = new Deportista($_POST["nombre"],$_POST["email"],$_POST["password"],$edad,$_POST["dni"],"deportista",$_POST["riesgos"],$_POST["tipo"]);
      $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$edad,$_POST["dni"],"deportista");

      try{
	       //$usuario->comprobarDatos(); // if it fails, ValidationException
         //$deportista->comprobarDatos();
         $deportistaMapper->save($deportista);
         //$usuarioMapper->save($usuario);  //No llamarlo hasta tener lo de Emily
      	// check if user exists in the database
      	/*if (!$this->UsuarioMapper->usuarioExiste($_POST["dni"])){

      	  // save the User object into the database
      	  //$this->usuarioMapper->save($usuario);
          $this->deportistaMapper->save($deportista);

      	  //$this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");

      	  // perform the redirection. More or less:
      	  // header("Location: index.php?controller=users&action=login")
      	  // die();
      	  //$this->view->redirect("users", "login");*/
          header("Location: ../view/adminDeportistas.php");
      	/*} else {
      	  $errors = array();
      	  $errors["dni"] = "El deportista ya existe";
      	  //$this->view->setVariable("errors", $errors);
      	}*/
      }catch(ValidationException $ex) {
	// Get the errors array inside the exepction...
	/*$errors = $ex->getErrors();
	// And put it to the view as "errors" variable
	$this->view->setVariable("errors", $errors);*/
}
    }
    /*
    // Put the User object visible to the view
    $this->view->setVariable("user", $user);

    // render the view (/view/users/register.php)
    $this->view->render("users", "register");
    */

  }

  public function listaDeportistas(){
    return $this->deportistaMapper->listarDeportistas();
  }

  public function listaDeportistasTipo($tipo){
    return $this->deportistaMapper->listarDeportistasTipo($tipo);
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
      throw new Exception("no such post with id: ".$postid);
    }

    // Delete the Post object from the database
    $this->deportistaMapper->eliminar($deportista);

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
