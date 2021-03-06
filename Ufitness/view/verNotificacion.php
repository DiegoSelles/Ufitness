<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Notificacion.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
global $id;
$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if(isset($_GET['idNotificacion'])){
$id = $_GET['idNotificacion'];
	}
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
	header("Location: error.php");
	exit();
}
if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
           $lang="es";
       }

	$ncontroler = new controlador_Notificacion();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Notificacion - Ufitness</title>

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

		$notificacion = $ncontroler->notificacionId($id);
		?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
							<div class="tit_sec">
              <i class="fa fa-bell" aria-hidden="true"></i>
              <strong><?php echo $notificacion->getTitulo(); ?></strong>
						</div>
						<div class="tit_sec">
							<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"):?>
								<a id="btn_eliminar" href="eliminarNotificacion.php?lang=<?php echo $lang ?>&amp;idNotificacion=<?php echo $notificacion->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							<?php else: ?>
								<form action="../controller/controlador.php?lang=<?php echo $lang; ?>&amp;controlador=controlador_Notificacion&amp;accion=notificacionVista" method="post" id = "form_notificacion">
									<input type="hidden" name="idNotificacion" value="<?=$notificacion->getId();?>">
	                <a onclick="document.getElementById('form_notificacion').submit();" id="btn_visto" class="btn btn-primary " title="<?php echo __('Visto',$lang); ?>" type="button">
	                  <i class="fa fa-check " aria-hidden="true"></i>
	                </a>
                </form>
							<?php endif; ?>
							</div>
			  		</div>

            <div class="contenido_pagina">
              <div class="desc_notif">
                <p> <?php echo $notificacion->getDescripcion(); ?></p>
              </div>
            </div>
        </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
