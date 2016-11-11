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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> AdminEjercicios - Ufitness</title>

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
              <strong>Nombre Ejercicio</strong>
              <a id="btn_editar" href="#" class="btn btn-primary" type="button"> Editar </a>
            </div>
            <div class="contenido_pagina">
              <div class="info_ejercicio">
                <div class="descripcion_ejer">
                  <h1>Descripción: </h1>
                </div>
                <div class="musculo_ejer">
                  <h1>Músculos: </h1>
                </div>
                <div class="maquina_ejer">
                  <h1>Máquina: </h1>
                </div>
              </div>
              <div class="imgs_ejercicio">
                <div class="responsive">
                  <div class="img">
                    <a target="_blank" href="img/img.png">
                      <img src="img/img.png" alt="Trolltunga Norway" width="300" height="200">
                    </a>
                  </div>
                </div>
                <div class="responsive">
                  <div class="img">
                    <a target="_blank" href="img/img.png">
                      <img src="img/img.png" alt="Forest" width="600" height="400">
                    </a>
                  </div>
                </div>
                <div class="responsive">
                  <div class="img">
                    <a target="_blank" href="img/img.png">
                      <img src="img/img.png" alt="Northern Lights" width="600" height="400">
                    </a>
                  </div>
                </div>
                <div class="responsive">
                  <div class="img">
                    <a target="_blank" href="img/img.png">
                      <img src="img/img.png" alt="Mountains" width="600" height="400">
                    </a>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            <div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
