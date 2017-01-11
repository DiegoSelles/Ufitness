<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Notificacion.php");
require_once("../resources/languages.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
$ncontroler = new controlador_Notificacion();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
	header("Location: error.php");
	exit();
}

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
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
			?>

			<div id="contenido" class="container-fluid">
				<div id="titulo_index" class="titulo_seccion">
					<h1><strong><?php echo __('Bienvenido a Ufitness',$lang); ?></strong></h1>
				</div>
				<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"):?>
				<div class="contenido_index">
					<a type="button" id="btn_notificacion" class="btn btn-primary" href="crearNotificacion.php?lang=<?php echo $lang; ?>" ><?php echo __('Nueva notificacion',$lang); ?></a>
				</div>
				<div class="listado">
					<div class="header_lista">
							<div class="titulo_lista">
									<h1><?php echo __('Ultimas notifaciones',$lang); ?></h1>
							</div>
					</div>
					<?php
						$listaNotificaciones= $ncontroler->listaNotificaciones();
					foreach ($listaNotificaciones as $notificacion ):
					?>
					<ul>

						<div class="bloque_lista">
							<div class="titulo_bloque">
								<a href = "verNotificacion.php?lang=<?php echo $lang; ?>&idNotificacion=<?php echo $notificacion->getId(); ?>">
									<h1><?=$notificacion->getTitulo(); ?><h1>
								</a>
							</div>
							<div class="info_bloque inf_bl">
								<p><?php echo substr($notificacion->getDescripcion(),0,90); ?>...</p>
							</div>
							<div class="opciones_bloque opc_bl">
								<a id="btn_eliminar" href="eliminarNotificacion.php?lang=<?php echo $lang ?>&idNotificacion=<?php echo $notificacion->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</div>
						</div>
	        </ul>
				<?php endforeach;	?>
				</div>

				<?php else:
					$listaNotificaciones = $ncontroler->listaNotificacionesReceptor($_SESSION["Dni"]);
				?>

				<div class="listado">
					<div class="header_lista header_lista_notif">
							<div class="titulo_lista titulo_lista_notif">
								<?php
									if($listaNotificaciones==NULL):
								?>
									<div >
									<h1><?php echo __('No tienes notificaciones nuevas.',$lang); ?></h1>
									</div>
									<div>
										<img class="img-visto" src="img/visto.png" alt="Visto"/>
									</div>
								<?php
									else:
								?>
									<h1><?php echo __('¡Tienes nuevas notificaciones!',$lang); ?></h1>
								<?php
									endif;
								?>
							</div>
					</div>
					<?php foreach ($listaNotificaciones as $notificacionHD ):
								$notificacion = $ncontroler->notificacionId($notificacionHD->getId());

					?>
					<ul>

						<div class="bloque_lista">
							<div class="titulo_bloque tit_bl">
								<a href = "verNotificacion.php?<?php echo $lang; ?>idNotificacion=<?php echo $notificacion->getId(); ?>">
									<h1><?=$notificacion->getTitulo(); ?><h1>
								</a>
							</div>
							<div class="info_bloque  inf_bl ">
								<p><?php echo substr($notificacion->getDescripcion(),0,90); ?>...</p>
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
