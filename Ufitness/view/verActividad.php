<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Actividad.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
global $id;
$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if(isset($_GET['idActividad'])){
$id = $_GET['idActividad'];
	}
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
	header("Location: error.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> AdminActividades - Ufitness</title>

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
		$acontroler = new controlador_Actividad();
		$actividad = $acontroler->buscarActividadById($id);
		$reserva = $acontroler->getReserva($id);
		?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-futbol-o" aria-hidden="true"></i>
              <strong><?php echo $actividad->getNombre(); ?></strong>
              <?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){ ?>
              <a id="btn_editar" href="modificarActividad.php?idActividad=<?php echo $id; ?>" class="btn btn-primary" type="button"> Editar </a>
              <?php } ?>
              <?php if($_SESSION['rol'] == "deportista"){ ?>
			  <form method="post" action="#">
              <input id="btn_reservar" type="submit" value="Reservar Plaza" name="ReservarPlaza">
              <?php if(isset($_POST['ReservarPlaza'])) $acontroler->reservarPlaza($id,$_SESSION['Dni']); ?>
              <?php } ?>
              </form>
			  </div>

            <div class="contenido_pagina">
              <div class="info_actividad">
                <div class="horario_actividad">
                  <h1>Horario: <?php echo $actividad->getHorario(); ?> </h1>
                </div>
                <div class="lugar_actividad">
                  <h1>Lugar: <?php echo $actividad->getLugar(); ?></h1>
                </div>
                <div class="tipo_actividad">
                  <h1>Tipo de actividad: <?php echo $actividad->getTipoActividad(); ?></h1>
                </div>
                <div class="num_plazas">
                  <h1>Numero de plazas: <?php echo $actividad->getNumPlazas(); ?></h1>
                </div>
								<div class="num_plazas">
                  <h1>Monitor de la actividad: <?php echo $actividad->getMonitor(); ?></h1>
                </div>
              </div>
            </div>
        </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
