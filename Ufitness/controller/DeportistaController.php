<?php
require_once(__DIR__."/../model/Deportista.php");
require_once(__DIR__."/../model/DeportistaMapper.php");

class DeportistaController /*extends BaseController*/{

  private $deportistaMapper;
  private $UsuarioMapper;

  public function __construct() {
    parent::__construct();

    $this->deportistaMapper = new DeportistaMapper();
    $this->usuarioMapper = new UsuarioMapper();
    //$this->view->setLayout("welcome");
  }

  public function index() {

    // obtain the data from the database
    $posts = $this->postMapper->findAll();

    // put the array containing Post object to the view
    $this->view->setVariable("posts", $posts);

    // render the view (/view/posts/index.php)
    $this->view->render("posts", "index");
  }

  public function register() {


    if (isset($_POST["nombre"])){ //Cogemos los datos de http

      $deportista = new Deportista($_POST["riesgos"],$_POST["tipo"]);
      $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$_POST["edad"],$_POST["dni"],$_POST["rol"]);

      try{
	       $usuario->comprobarDatos(); // if it fails, ValidationException

      	// check if user exists in the database
      	if (!$this->UsuarioMapper->usuarioExiste($_POST["dni"])){

      	  // save the User object into the database
      	  $this->usuarioMapper->save($usuario);
          $this->deportistaMapper->save($deportista);

      	  //$this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");

      	  // perform the redirection. More or less:
      	  // header("Location: index.php?controller=users&action=login")
      	  // die();
      	  //$this->view->redirect("users", "login");
      	} else {
      	  $errors = array();
      	  $errors["dni"] = "El deportista ya existe";
      	  //$this->view->setVariable("errors", $errors);
      	}
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




}

?>
