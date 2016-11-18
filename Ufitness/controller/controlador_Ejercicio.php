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
    if ($_FILES["imagen"]["size"] > 1000000 ) {
        echo "Tu archivo es demasiado largo. <br/>";
        $uploadOk = 0;
    }
    // Permiso de tipos de imagenes: JPG, JPEG, PNG & GIF
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
    && $imageFileType != "GIF" ) {
        echo "Lo siento, solo JPG, JPEG, PNG o GIF archivos son permitidos. <br/>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0){
      $nombreImagen = null;
    }else{
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . $nombreImagen);
    }

    $ucontroler = new controlador_Usuario();
    $econtroler = new controlador_Ejercicio();
    $usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);

    $ejercicioMapper = new EjercicioMapper();
    $urlVideo = null;
    $bool = $econtroler->youtubeId($_POST['urlYoutube']);
    if ($bool){
      $urlVideo = $_POST['urlYoutube'];
    }

    $ejercicio = new Ejercicio($_POST["nombre"], $usuarioActual->getDni(), $_POST["tipoEjercicio"],
    $_POST["grupoMuscular"], $_POST["maquina"], $_POST["descripcion"], $nombreImagen, $urlVideo);

    $ejercicioMapper->registrarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php");

  }

  public function youtubeId($url) {
    if($url != '') {
      $rx = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name
             /watch\?v=([^&]+)           # URI with video id as capture group 1
             ~x';
        $match = preg_match($rx, $url, $matches);
        if((int) $match > 0) {
                return true;
        }
    }
    return false;
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

    $econtroler = new controlador_Ejercicio();
    $ejercicioMapper  = new EjercicioMapper();
    $nombre = $_POST['nombre'];
    $dniCreador = $_POST['dniCreador'];
    $tipo = $_POST['tipoEjercicio'];
    $grupoMuscular = $_POST['grupoMuscular'];
    $maquina = $_POST['maquina'];
    $descripcion = $_POST['descripcion'];
    $idEjercicio = $_POST['idEjercicio'];
    $imagenActual = null;
    if (isset ($_POST['imagenActual'])){
      $imagenActual = $_POST['imagenActual'];
    }

    //Manejar la imagen
    $target_dir = '../imagenesSubidas/';
    $target_file = $target_dir . basename($_FILES['imagen']['name']);
    $uploadOk = 1;


    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $temp = explode (".", $_FILES['imagen']['name']);
    $nombreImagen = round (microtime(true)) . '.' . end($temp);

    // Comprueba la longitud del archivo
    if ($_FILES["imagen"]["size"] > 1000000 ) {
        echo "Tu archivo es demasiado largo. <br/>";
        $uploadOk = 0;
    }
    // Permiso de tipos de imagenes: JPG, JPEG, PNG & GIF
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
    && $imageFileType != "GIF") {
        echo "Lo siento, solo JPG, JPEG, PNG o GIF archivos son permitidos. <br/>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0){
      $nombreImagen = $imagenActual;
    }else{
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . $nombreImagen);
      $econtroler->eliminarImagen ($imagenActual);
    }

    $ejercicio= new Ejercicio($nombre, $dniCreador, $tipo, $grupoMuscular, $maquina, $descripcion, $nombreImagen);
    return $ejercicioMapper->modificarEjercicio($ejercicio, $idEjercicio);
  }

  public function eliminarImagen ($nombreImagen){
    unlink ("../imagenesSubidas/". $nombreImagen);
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

    $ejercicioMapper->eliminarEjercicio($ejercicio);

    header("Location: ../view/adminEjercicios.php");
  }

}

?>
