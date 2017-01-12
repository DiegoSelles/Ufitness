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
    
    if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}

    if(isset($_POST["nombre"])){ //Cogemos los datos de http

      $deportista = new Deportista($_POST["nombre"],$_POST["email"],$_POST["password"],$_POST["fecha"],$_POST["dni"],"deportista",$_POST["riesgos"],$_POST["tipo"]);
      $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$_POST["fecha"],$_POST["dni"],"deportista");

      try{

      	if (!$usuarioMapper->usuarioExiste($deportista->getDni())){

            $deportistaMapper->guardarDeportista($deportista);
            $usuarioMapper->guardarUsuario($usuario);

            echo '<script language="javascript">alert("'.__('Se ha creado el deportista.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';
      	} else {
      	  echo '<script language="javascript">alert("'.__('Ya existe un deportista con el mismo DNI.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';

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
    if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}
	
    if (!isset($_POST["dni"])) {
      throw new Exception("id is mandatory");
    }

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

    header("Location: ../view/adminDeportistas.php?lang=$lang");
  }

  public function buscarDeportistaDni($dni){
    return $this->deportistaMapper->buscarDni($dni);
  }

  public function modificarDeportista(){
    $deportistaMapper  = new DeportistaMapper();
    $usuarioMapper  = new UsuarioMapper();
        if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
	} else {
		$lang = "es";
	}
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
    echo '<script language="javascript">alert("'.__('Se ha modificado el deportista.',$lang).'"); window.location.href="../view/adminDeportistas.php?lang='.$lang.'";</script>';
  }

}

?>
