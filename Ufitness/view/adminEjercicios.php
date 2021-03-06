<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");


if(!isset($_SESSION)) session_start();
$econtroler = new controlador_Ejercicio();
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

    <title> Ejercicios - Ufitness</title>

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

    <!--JavaScript-->
    <script src="js/desplegarMenu.js"></script>
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
              <strong><?php echo __('Ejercicios',$lang); ?></strong>
            </div>
            <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1><?php echo __('Lista de Ejercicios',$lang); ?> </h1>
                </div>
								<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                <div class="anadir">
                  <a id="btn_anadir" href="crearEjercicio.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Añadir Ejercicio',$lang); ?></a>
                </div>
								<?php } ?>
              </div>
              <div class="body_pagina">
                <nav id = "desplegable1">
                  <ul>
              			<li id="nivel1"><a class= "btn_nivel" id = "activador_1"  href="#"><i id = "activador_1" class="fa fa-chevron-down" ></i><?php echo __('Piernas',$lang); ?></a>
											<?php
											 $ejercicios = $econtroler->listaEjerciciosGrupo("Piernas");
											 foreach ($ejercicios as $ejercicio) {
											 ?>
											<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">

														<a href = "../view/verEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>">
                            	<h1> <?php echo $ejercicio->getNombre(); ?> <h1>
														</a>
                          </div>
                          <div class="info_bloque">
                            <p> <?php echo __('Descripción',$lang); ?> : <?php echo substr($ejercicio->getDescripcion(),0,90); ?>...</p>
                            <p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
                            <p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                          </div>
													<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                          <div class="opciones_bloque">
														<a id="btn_edit_bloque" href="../view/modificarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>"
															 class="btn btn-primary" type="button" title="<?php echo __('modificar',$lang); ?>"><i class="fa fa-edit" aria-hidden="true" ></i></a>
                            <a id="btn_eliminar" href="eliminarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>" class="btn btn-primary" type="button" title="<?php echo __('Eliminar',$lang); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
													<?php } ?>
                        </div>
              				</ul>
											<?php } ?>
              			</li>
              		</ul>
                </nav>

                <nav id = "desplegable2">
                  <ul>
                    <li id="nivel2"><a class= "btn_nivel" id = "activador_2"  href="#"><i id = "activador_2" class="fa fa-chevron-down" ></i><?php echo __('Brazos',$lang); ?></a>
											<?php
											 $ejercicios = $econtroler->listaEjerciciosGrupo("Brazos");
											 foreach ($ejercicios as $ejercicio) {
											 ?>
											<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
														<a href = "../view/verEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>">
                            	<h1> <?php echo $ejercicio->getNombre(); ?> <h1>
														</a>
                          </div>
                          <div class="info_bloque">
                            <p> <?php echo __('Descripción',$lang); ?> : <?php echo substr($ejercicio->getDescripcion(),0,90); ?>...</p>
                            <p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
                            <p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                          </div>
													<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                          <div class="opciones_bloque">
														<a id="btn_edit_bloque" href="../view/modificarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>" class="btn btn-primary" type="button"><i class="fa fa-edit" aria-hidden="true" title="<?php echo __('modificar',$lang); ?>"></i></a>
														<a id="btn_eliminar" href="eliminarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>" class="btn btn-primary" type="button" title="<?php echo __('Eliminar',$lang); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                          </div>
                        	</div>
													<?php } ?>
              				</ul>
                      <?php } ?>
                    </li>
                  </ul>
                </nav>

                <nav id = "desplegable3">
                  <ul>
              			<li id="nivel3"><a class= "btn_nivel" id = "activador_3"  href="#"><i id = "activador_3" class="fa fa-chevron-down" ></i><?php echo __('Espalda',$lang); ?></a>
											<?php
											 $ejercicios = $econtroler->listaEjerciciosGrupo("Espalda");
											 foreach ($ejercicios as $ejercicio) {
											 ?>
											<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">

														<a href = "../view/verEjercicio.php?idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>">
                            	<h1> <?php echo $ejercicio->getNombre(); ?> <h1>
														</a>

                          </div>
                          <div class="info_bloque">
                            <p> <?php echo __('Descripción',$lang); ?> : <?php echo substr($ejercicio->getDescripcion(),0,90); ?>...</p>
                            <p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
                            <p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                          </div>
													<?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                          <div class="opciones_bloque">
														<a id="btn_edit_bloque" href="../view/modificarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>" class="btn btn-primary" type="button"><i class="fa fa-edit" aria-hidden="true" title="<?php echo __('modificar',$lang); ?>"></i></a>
														<a id="btn_eliminar" href="eliminarEjercicio.php?lang=<?php echo $lang; ?>&idEjercicio=<?php echo $ejercicio->getIdEjercicio(); ?>" class="btn btn-primary" type="button" title="<?php echo __('Eliminar',$lang); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                         </div>
                        </div>
												<?php } ?>
                      </ul>
                      <?php } ?>
              			</li>
              		</ul>
                </nav>
								<!--
								<nav id = "desplegable4">
                  <ul>
              			<li id="nivel4"><a class= "btn_nivel" id = "activador_4"  href="#"><i id = "activador_4" class="fa fa-chevron-down" ></i> Pectorales</a>
											<?php
											 $ejercicios = $econtroler->listaEjerciciosGrupo("Pectorales");
											 foreach ($ejercicios as $ejercicio) {
											 ?>
											<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> <?php echo $ejercicio->getNombre(); ?> <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción: <?php echo $ejercicio->getNombre(); ?></p>
                            <p>Máquina: <?php echo $ejercicio->getMaquina(); ?></p>
                            <p>Tipo: <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </ul>
                      <?php } ?>
              			</li>
              		</ul>
                </nav>
							-->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
