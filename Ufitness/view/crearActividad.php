<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
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

    <title> userIndex - Ufitness</title>

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
      $ucontroler = new controlador_Usuario();
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-futbol-o" aria-hidden="true"></i>
          <strong>Nueva Actividad</strong>
        </div>
        <div >
  				<form action="../controller/controlador.php?controlador=controlador_Actividad&accion=registrarActividad" method="post" class="formulario">
              <label for="nombre">Nombre Actividad:</label>
              <input type="text" name="nombre"/>
              <label for="monitor">DNI del monitor:</label>
              <?php $entrenadores = $ucontroler->listarEntrenadores(); ?>
              <select name="monitor">
                <?php foreach ($entrenadores as $entrenador) { ?>
                  <!-- Parece que funciona el option pero no se ven los nobmres de los entrenadores -->
                  <option value="dni_entrenador" selected><?php echo $entrenador['nombre']; ?></option>
                <?php }?>
  						</select>
              <label for="horario">Horario:</label>
              <input type="datetime-local" name="horario"/>
              <label for="lugar">Lugar:</label>
              <input type="text" name="lugar"/>
              <label for="numPlazas">Numero de Plazas:</label>
              <input type="number" name="lugar"/>
              <label for="tipo">Tipo:</label>
              <input type="text" name="tipo"/>
							<input id="submit" class="btn btn-primary" type="submit" value="Registrar">

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
<?php session_destroy() ?>
