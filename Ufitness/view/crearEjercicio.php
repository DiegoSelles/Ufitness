<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");


if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
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

    <title> Nuevo Ejercicio - Ufitness</title>

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
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-bicycle" aria-hidden="true"></i>
          <strong>Nuevo Ejercicio</strong>
        </div>
        <div >

          <form enctype = "multipart/form-data" action="../controller/controlador.php?controlador=controlador_Ejercicio&amp;accion=registrarEjercicio" method="post" class="formulario">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input"/>

						<label for="nombre">Nombre Ejercicio:</label>
						<input type="text" name="nombre" class="input" required="true"/>
						<label for="tipoEjercicio">Tipo del ejercicio:</label>
						<select name="tipoEjercicio" class="select">
								<option value="Cardio" >Cardio</option>
								<option value="Estiramientos">Estiramientos</option>
								<option value="Muscular">Muscular</option>
						</select>
						<label for="maquina">Maquina:</label>
						<input type="text" name="maquina" class="input"/>
						<label for="grupoMuscular">Grupo Muscular:</label>
						<select name="grupoMuscular" class="select">
								<option value="Piernas" >Piernas</option>
								<option value="Brazos">Brazos</option>
								<option value="Espalda">Espalda</option>
						</select>
						<label for="descripcion">Descripcion:</label>
						<input type="text" name="descripcion" class="input"/>
						<label for="video">Video:</label>
						<input type="text" name="urlYoutube" class="input"/>
						<br/>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" />
						<br/>
						<div class="form_submit">
						<input id="submit" class="btn btn-primary" type="submit" value="Registrar">
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
