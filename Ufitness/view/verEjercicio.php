<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");


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

    <title> Ejercicio - Ufitness</title>

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
			$econtroler = new controlador_Ejercicio();
			$id = $_GET['idEjercicio'];
			$ejercicio = $econtroler->buscarId($id);
		?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-bicycle" aria-hidden="true"></i>
              <strong><?php echo $ejercicio->getNombre(); ?></strong>
							<?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){?>
							<a id="btn_editar" href="../view/modificarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $id; ?>" class="btn btn-primary" type="button"><?php echo __('Editar',$lang); ?></a>
							<?php } ?>
						</div>



            <div class="contenido_pagina">
              <div class="info_ejercicio">
                <div class="descripcion_ejer">
                  <h1><?php echo __('Descripción',$lang); ?> : <?php echo $ejercicio->getDescripcion(); ?></h1>
                </div>
                <div class="musculo_ejer">
                  <h1><?php echo __('Músculos',$lang); ?> : <?php echo $ejercicio->getGrupoMuscular(); ?></h1>
                </div>
                <div class="maquina_ejer">
                  <h1> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></h1>
                </div>
              </div>
							<?php if ($ejercicio->getImagen() != null){ ?>
	                <div class="responsive">
	                  <div class="img">
	                    <a target="_blank" href="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>">
	                      <img src="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>"  alt="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>" width="300" height="200">
	                    </a>
	                  </div>
	                </div>
							<?php }else { ?>
								<div class="imgs_ejercicio">
	                <div class="responsive">
	                  <div class="img">
	                    <a target="_blank" href="img/img.png">
	                      <img src="img/img.png" alt="img/img.png" width="300" height="200">
	                    </a>
	                  </div>
	                </div>
							<?php } ?>
              </div>
							<?php if ($ejercicio->getVideo() != null){ ?>
								<iframe width="420" height="315" src="<?php echo $ejercicio->getVideo(); ?>" allowfullscreen></iframe>
							<?php } ?>
            <div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
