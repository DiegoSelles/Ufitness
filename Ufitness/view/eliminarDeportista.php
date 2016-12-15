<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Deportista.php");

if(!isset($_SESSION)) session_start();
global $dni;

if(isset($_GET['dni'])){
  $dni = $_GET['dni'];
}

$ucontroler = new controlador_Usuario();
$dcontroler = new controlador_Deportista();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);

if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador"){
  header("Location: error.php");
  exit();
}

?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Eliminar Deportista - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Rubik|Quattrocento+Sans" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
      <?php
      include("navbar.php");
      include("wrapper.php");

      $deportista = $dcontroler->buscarDeportistaDni($dni);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong>¿Está seguro de que quiere eliminar a este Deportista?</strong>
        </div>
        <div >
          <form action="../controller/controlador.php?controlador=controlador_Deportista&amp;accion=eliminar" method="post" class="formulario">
              <label>Nombre: <?php echo $deportista->getNombre(); ?></label>
               <br/>
              <label>DNI: <?php echo $deportista->getDni(); ?></label>
               <br/>
              <label>Edad: <?php echo $deportista->getEdad(); ?></label>
               <br/>
              <label>E-mail: <?php echo $deportista->getEmail(); ?></label>
              <br/>
              <label>Tipo Deportista: <?php echo $deportista->getTipo(); ?></label>
              <br/>
              <label>Riesgos: <?php echo $deportista->getRiesgos(); ?></label>

              <input type="text" hidden="true" name="dni" value="<?php echo $dni; ?>" />
              <div class="form_submit">
                <input id="submit" class="btn btn-primary" type="submit" value="SI">
                <a id="submit" href="adminDeportistas.php" class="btn btn-primary" type="button">NO</a>
              </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
