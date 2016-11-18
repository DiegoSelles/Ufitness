<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Actividad.php");

if(!isset($_SESSION)) session_start();
global $id;

if(isset($_GET['idActividad'])){
  $id = $_GET['idActividad'];
}
$ucontroler = new controlador_Usuario();
$acontroler = new controlador_Actividad();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
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

    <title> Eliminar Actividad - Ufitness</title>

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

      $actividad = $acontroler->getActividad($id);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-futbol-o" aria-hidden="true"></i>
          <strong>¿Está seguro que quiere eliminar esta actividad?</strong>
        </div>
        <div >
          <form action="../controller/controlador.php?controlador=controlador_Actividad&amp;accion=eliminarActividad" method="post" class="formulario">
              <label>Nombre: <?php echo $actividad->getNombre(); ?></label>
               <br/>
              <label>Numero de Plazas: <?php echo $actividad->getNumPlazas(); ?></label>
               <br/>
              <label>Horario: <?php echo $actividad->getHorario(); ?></label>
               <br/>
              <label>Lugar: <?php echo $actividad->getLugar(); ?></label>
              <br/>
              <label>Tipo de actividad: <?php echo $actividad->getTipoActividad(); ?></label>
              <br/>
              <label>Monitor de la actividad: <?php echo $actividad->getMonitor(); ?></label>
              <br/>

              <!-- Habría que meter imagen y video aqui tambien -->

              <input type="text" hidden="true" name="idActividad" value="<?php echo $id; ?>" />
              <div class="form_submit">
                <input id="submit" class="btn btn-primary" type="submit" value="SI">
                <a id="submit" href="adminActividades.php" class="btn btn-primary" type="button">NO</a>
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
