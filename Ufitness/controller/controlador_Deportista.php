<?php
require_once("../model/Deportista.php");
require_once("../model/DeportistaMapper.php");
require_once("../model/UsuarioMapper.php");

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

      $deportista = new Deportista($_POST["nombre"],$_POST["email"],$_POST["password"],$_POST["fecha"],$_POST["dni"],"deportista",$_POST["riesgos"],$_POST["tipo"]);
      $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$_POST["fecha"],$_POST["dni"],"deportista");

      try{
	       //$usuario->comprobarDatos(); // if it fails, ValidationException
         //$deportista->comprobarDatos();

      	//#####
      	if (!$usuarioMapper->usuarioExiste($deportista->getDni())){

            $deportistaMapper->guardarDeportista($deportista);
            $usuarioMapper->guardarUsuario($usuario);

            echo '<script language="javascript">alert("Se ha creado el deportista."); window.location.href="../view/adminDeportistas.php";</script>';
      	} else {
      	  echo '<script language="javascript">alert("Ya existe un deportista con el mismo DNI."); window.location.href="../view/adminDeportistas.php";</script>';

      	}
      }catch(ValidationException $ex) {
	    // Get the errors array inside the exepction...
	     $errors = $ex->getErrors();
       print_r($errors);

      }
    }
  }

  public function listaDeportistas(){
    return $this->deportistaMapper->listarDeportistas();
  }

  public function listaDeportistasTipo($tipo){
    return $this->deportistaMapper->listarDeportistasTipo($tipo);
  }

  public function eliminar() {

    $deportistaMapper = new DeportistaMapper();
    $usuarioMapper = new UsuarioMapper();
    if (!isset($_POST["dni"])) {
      throw new Exception("id is mandatory");
    }
    /*if (!isset($this->currentUser)) {
      throw new Exception("Not in session. Editing posts requires login");
    }*/
    $deportistadni = $_REQUEST["dni"];
    echo $deportistadni;
    $deportista = $deportistaMapper->buscarDni($deportistadni);
    print_r($deportista);
    if ($deportista == NULL) {
      throw new Exception("No existe deportista con DNI: ".$deportistadni);
    }

    // Delete the Post object from the database
    $deportistaMapper->eliminarDeportista($deportista);
    $usuarioMapper->eliminarUsuario($deportista->getDni());

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

  public function buscarDeportistaDni($dni){
    return $this->deportistaMapper->buscarDni($dni);
  }

  public function modificarDeportista(){
    $deportistaMapper  = new DeportistaMapper();
    $usuarioMapper  = new UsuarioMapper();
    $nombre_deportista = $_POST['nombre'];
    $dni_deportista = $_POST['dni'];
    $email_deportista = $_POST['email'];
    $tipo_deportista = $_POST['tipo'];
    $riesgos_deportista = $_POST['riesgos'];
    $fecha_deportista = $_POST['fecha'];
    $password_deportista = $_POST['password'];
    $dniAntiguo = $_POST['dniAntiguo'];

    $deportista= new Deportista($nombre_deportista, $email_deportista, $password_deportista,$fecha_deportista,$dni_deportista,"deportista", $riesgos_deportista,$tipo_deportista);
    $usuario = new Usuario($nombre_deportista,$email_deportista,$password_deportista,$fecha_deportista,$dni_deportista,"deportista");
    $deportistaMapper->modificarDeportista($deportista,$dniAntiguo);
    $usuarioMapper->modificarUsuario($usuario,$dniAntiguo);
    echo '<script language="javascript">alert("Se ha modificado el deportista."); window.location.href="../view/adminDeportistas.php";</script>';
  }

}

?>
