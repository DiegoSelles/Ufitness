<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Notificacion.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
$ncontroler = new controlador_Notificacion();
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

    <title> Inicio - Ufitness</title>

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

			$listaNotificaciones = $ncontroler->viewNotificacion($_SESSION["Dni"]);

			?>

			<div id="contenido" class="container-fluid">
				<div id="titulo_index" class="titulo_seccion">
					<h1><strong>Bienvenido a UFitness</strong></h1>
				</div>
				<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"):?>
				<div class="contenido_index">
					<a type="button" id="btn_notificacion" class="btn btn-primary" href="crearNotificacion.php" >Nueva Notificacion</a>
				</div>

				<?php else:?>

				<div class="listado">
					<div class="header_lista">
							<div class="titulo_lista">
								<?php

								?>
									<h1>Nuevas Notificaciones!</h1>
							</div>
					</div>
					<?php foreach ($listaNotificaciones as $notificacion ):?>
					<ul>
						<div class="bloque_lista">
							<div class="titulo_bloque titulo_bloque_notif">
									<h1><?=$notificacion->getTitulo(); ?><h1>
							</div>
							<div class="info_bloque info_bloque_notif">
								<p><?php echo $notificacion->getDescripcion(); ?></p>
							</div>
							<div class="opciones_bloque">
								<form action="../controller/controlador.php?controlador=controlador_Notificacion&amp;accion=notificacionVista" method="post" id = "form_notificacion">
                  <input type="hidden" name="idNotificacion" value="<?=$notificacion->getId();?>">
	                <a onclick="document.getElementById('form_notificacion').submit();" id="btn_visto" class="btn btn-primary " title="visto" type="button">
	                  <i class="fa fa-check " aria-hidden="true"></i>
	                </a>
                </form>
							</div>
						</div>
	        </ul>
				<?php endforeach;	?>
				</div>
				<?php endif;?>
			</div>
	 </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
