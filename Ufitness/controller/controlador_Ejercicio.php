<?php
require_once("../model/Ejercicio.php");
require_once("../model/EjercicioMapper.php");

class controlador_Ejercicio{

  private $ejercicioMapper;

  public function __construct() {

    $this->ejercicioMapper = new EjercicioMapper();
  }


  public function registrarEjercicio() {

    $ucontroler = new controlador_Usuario();
    $usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);

    $ejercicioMapper = new EjercicioMapper();
    //Falta mirar como meterle la imagen y el video
    $ejercicio = new Ejercicio($_POST["nombre"], $usuarioActual->getDni(), $_POST["tipoEjercicio"],
    $_POST["grupoMuscular"], $_POST["maquina"], $_POST["descripcion"]);

    $ejercicioMapper->registrarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php");

    }


  public function listarEjercicios(){
    return $this->ejercicioMapper->listarEjercicios();
  }

  public function listaEjerciciosGrupo($grupo){
    return $this->ejercicioMapper->listarEjerciciosGrupo($grupo);
  }

  public function buscarId($id){
    return $this->ejercicioMapper->buscarId($id);
  }

  public function modificarEjercicio(){
    $ejercicioMapper  = new EjercicioMapper();
    $nombre = $_POST['nombre'];
    $dniCreador = $_POST['dniCreador'];
    $tipo = $_POST['tipoEjercicio'];
    $grupoMuscular = $_POST['grupoMuscular'];
    $maquina = $_POST['maquina'];
    $descripcion = $_POST['descripcion'];
    $idEjercicio = $_POST['idEjercicio'];

    $ejercicio= new Ejercicio($nombre, $dniCreador, $tipo, $grupoMuscular, $maquina, $descripcion);
    return $ejercicioMapper->modificarEjercicio($ejercicio, $idEjercicio);
  }

  public function eliminarEjercicio() {
    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }

    $idEjercicio = $_REQUEST["id"];
    $ejercicioMapper = new EjercicioMapper();

    $ejercicio = $ejercicioMapper->buscarId($idEjercicio);

    if ($ejercicio == NULL) {
      throw new Exception("no such post with id: ". $idEjercicio);
    }

    // Delete the Post object from the database
    $ejercicioMapper->eliminarEjercicio($ejercicio);

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
    header("Location: ../view/adminejercicios.php");
  }

}

?>
