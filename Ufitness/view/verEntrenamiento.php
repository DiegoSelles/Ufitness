<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Entrenamiento.php");
require_once("../controller/controlador_Ejercicio.php");

$entcontroller = new controlador_Entrenamiento();
$ejercontroller = new controlador_Ejercicio();

if(!isset($_SESSION)) session_start();
$ucontroller = new controlador_Usuario();
$usuarioActual =  $ucontroller->getUsuarioActual($_SESSION['Dni']);
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

    <title> Entrenamiento - Ufitness</title>

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
			if(isset($_GET['idEntrenamiento'])){
				$idEntrenamiento=$_GET['idEntrenamiento'];
				$entrenamiento=$entcontroller->buscarEntrenamientoId($idEntrenamiento);
			}else header("Location: ../view/error.php");

			?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-trophy" aria-hidden="true"></i>
              <strong><?php echo $entrenamiento->getNombre(); ?></strong>
							<?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){ ?>
              <a id="btn_editar" href="../view/modificarEntrenamiento.php?lang=<?php echo $lang; ?>&idEnt=<?php echo $entrenamiento->getId(); ?>" class="btn btn-primary" type="button"><?php echo __('Editar',$lang); ?> </a>
							<?php } ?>
							<?php if($_SESSION['rol'] == "deportista"){ ?>
              	<a id="btn_editar" href="../view/monitorizarEntrenamiento.php?lang=<?php echo $lang; ?>&idEntrenamiento=<?php echo $idEntrenamiento;?>" class="btn btn-primary" type="button"><?php echo __('Monitorizar Entrenamiento',$lang); ?> </a>
							<?php } ?>
            </div>
            <div class="body_pagina">
							<div class="header_lista">
                <div class="titulo_lista">
                  <h1><?php echo __('Lista de Ejercicios',$lang); ?> </h1>
                </div>
								<div>
	                <p> <?php echo __('Duración',$lang); ?> : <?php echo $entrenamiento->getDuracion(); ?> min.</p>
                </div>
              </div>

							<div class="listado">
								<ul>
										<?php
										 $entrenamientoHasEjercicios = $entcontroller->ejerciciosEntrenamiento($entrenamiento->getId());
										 foreach ($entrenamientoHasEjercicios as $entrenamientoHasEjercicio) {
											 $ejercicio = $ejercontroller->buscarId($entrenamientoHasEjercicio->getIdEjercicio());
										 ?>
										<ul>
											<div class="bloque_lista">
												<div class="titulo_bloque">
														<a href="../view/verEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>"><h1> <?php echo $ejercicio->getNombre(); ?> </h1></a>
													</a>
												</div>
												<div class="info_bloque">
													<p> <?php echo __('Descripción',$lang); ?> : <?php echo substr($ejercicio->getDescripcion(),0,90); ?>...</p>
													<p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
													<p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
													<p> <?php echo __('series',$lang); ?> X <?php echo __('Repeticion',$lang); ?> : <?php echo $entrenamientoHasEjercicio->getSxR(); ?></p>
													<p> <?php echo __('Carga',$lang); ?> : <?php echo $entrenamientoHasEjercicio->getCarga(); ?></p>
												</div>
											</div>
										</ul>
										<?php } ?>
									</li>
								</ul>
        			</div>
    </div>



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
