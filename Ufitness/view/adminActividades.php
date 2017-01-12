<?php
require_once("../controller/controlador_Actividad.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
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

    <title> Actividades - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/desplegarMenu.js"></script>
		<script src="js/confirmacionEliminar.js"></script>

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

			if (isset($_GET['eliminar'])){
				$acontroler->eliminarActividad($_GET['eliminar']);
				echo "<script language='javascript'>window.location='../view/adminActividades.php'</script>";
			}

		?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                <strong><?php echo __('Actividades',$lang);?></strong>
            </div>
            <div class="listado">
                <div class="header_lista">
                    <div class="titulo_lista">
                    <h1><?php echo __('Lista de Actividades',$lang); ?> </h1>
                    </div>
						<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                            <div class="anadir">
                                <a id="btn_anadir" href="../view/crearActividad.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Añadir Actividad',$lang);?></a>

                                <a id="btn_anadir" href="../view/verEstadisticasActividad.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Estadísticas',$lang); ?></a>
                            </div>
						<?php }?>
                </div>
				<?php

				$arrayActividades = $acontroler->listarActividades();
				foreach ($arrayActividades as $actividad ){
				?>
				<ul>
					<div class="bloque_lista">
						<div class="titulo_bloque">
							<a href = "verActividad.php?lang=<?php echo $lang; ?>&idActividad=<?php echo $actividad->getId(); ?>">
								<h1> <?php echo $actividad->getNombre(); ?><h1>
							</a>
						</div>
						<div class="info_bloque">
							<p><?php echo __('Horario',$lang);?>:<?php echo $actividad->getHorario(); ?></p>
							<p><?php echo __('Tipo de actividad',$lang);?>:<?php echo $actividad->getTipoActividad(); ?></p>
							<p><?php echo __('Numero de plazas',$lang);?>:<?php echo $actividad->getNumPlazas(); ?></p>
							<p><?php echo __('Lugar',$lang);?>:<?php echo $actividad->getLugar(); ?></p>
						</div>
						<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
						<div class="opciones_bloque">
							<a id="btn_edit_bloque" href="modificarActividad.php?lang=<?php echo $lang; ?>&idActividad=<?php echo $actividad->getId(); ?>" class="btn btn-primary" title="<?php echo __('Editar',$lang); ?>" type="button">
								<i class="fa fa-edit" aria-hidden="true"></i>
							</a>
							<a id="btn_eliminar" href="eliminarActividad.php?lang=<?php echo $lang; ?>&idActividad=<?php echo $actividad->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
						</div>
						<?php }	?>
					</div>
                 </ul>
				<?php }	?>
            </div>
        </div>
    </div>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
