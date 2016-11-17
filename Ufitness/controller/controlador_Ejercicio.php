<?php
require_once("../model/Ejercicio.php");
require_once("../model/EjercicioMapper.php");


class controlador_Ejercicio{

  private $ejercicioMapper;

  public function __construct() {

    $this->ejercicioMapper = new EjercicioMapper();
  }


  public function registrarEjercicio() {


    $target_dir = '../imagenesSubidas/';
    $target_file = $target_dir . basename($_FILES['imagen']['name']);
    $uploadOk = 1;


    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $temp = explode (".", $_FILES['imagen']['name']);
    $nombreImagen = round (microtime(true)) . '.' . end($temp);

    // Comprueba la longitud del archivo
    if ($_FILES["media"]["size"] > 1000000) {
        echo "Tu archivo es demasiado largo. <br/>";
        $uploadOk = 0;
    }
    // Permiso de tipos de imagenes: JPG, JPEG, PNG & GIF
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Lo siento, solo JPG, JPEG, PNG o GIF archivos son permitidos. <br/>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0){
      $nombreImagen = null;
    }else{
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . $nombreImagen);
    }

    $ucontroler = new controlador_Usuario();
    $usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);

    $ejercicioMapper = new EjercicioMapper();

    $ejercicio = new Ejercicio($_POST["nombre"], $usuarioActual->getDni(), $_POST["tipoEjercicio"],
    $_POST["grupoMuscular"], $_POST["maquina"], $_POST["descripcion"], $nombreImagen);

    $ejercicioMapper->registrarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php");

    }


  public function listaEjercicios(){
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
