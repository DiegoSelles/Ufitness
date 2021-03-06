<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Entrenamiento.php");
require_once("../resources/languages.php");

$econtroller = new controlador_Entrenamiento();
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

    <title> Entrenamientos - Ufitness</title>

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
                <i class="fa fa-trophy" aria-hidden="true"></i>
                <strong><?php echo __('Entrenamientos',$lang); ?></strong>
              </div>
              <div class="listado">
                <div class="header_lista">
                  <div class="titulo_lista">
                    <h1><?php echo __('Lista de Entrenamientos',$lang); ?> </h1>
                  </div>
                  <?php if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "entrenador"){?>
                  <div class="anadir">
                    <a id="btn_anadir" href="../view/crearEntrenamiento.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Añadir Entrenamiento',$lang); ?></a>
                  </div>
                  <?php }  ?>
				</div>

            <div class="body_pagina">
				<?php
				$entrenamientos = $econtroller->listarEntrenamientosNivel("principiante");
				if($entrenamientos != NULL){ ?>
				<nav id = "desplegable1">
					<ul>
						<li id="nivel1"><a id = "activador_1" class= "btn_nivel" href="#"><i id = "activador_1" class="fa fa-chevron-down"></i><?php echo __('Principiante',$lang); ?></a>
						<?php foreach ($entrenamientos as $entrenamiento) {	?>
					<ul>

                    <div class="bloque_lista">
                      <div class="titulo_bloque">
                        <a href="verEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEntrenamiento=<?php echo $entrenamiento->getId(); ?>">
							<h1><?php echo $entrenamiento->getNombre(); ?></h1>
						</a>
                      </div>

                      <div class="info_bloque">
                        <p> <?php echo __('Duración',$lang); ?> : <?php echo $entrenamiento->getDuracion(); ?> min.</p>
                      </div>

                      <?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){ ?>

                      <div class="opciones_bloque">
						<a id="btn_imprimir" href="imprimirEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEnt=<?php echo $entrenamiento->getId();?>" class="btn btn-primary" title="<?php echo __('Imprimir',$lang); ?>" type="button"><i class="fa fa-print" aria-hidden="true"></i></a>
						<a id="btn_eliminar" href="eliminarEntrenamiento.php?lang=<?php echo $lang ?>&amp;idEnt=<?php echo $entrenamiento->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					  <?php } ?>
					  </div>
                  </div>
				</ul>
					<?php }} ?>
          	</li>
          </ul>
         </nav>

			<?php
			$entrenamientos = $econtroller->listarEntrenamientosNivel("intermedio");
			if($entrenamientos != NULL){
			?>
            <nav id = "desplegable2">
              <ul>
          		<li id="nivel2"><a id = "activador_2" class= "btn_nivel" href="#"><i id = "activador_2" class="fa fa-chevron-down"></i><?php echo __('Intermedio',$lang); ?></a>
					<?php foreach ($entrenamientos as $entrenamiento) { ?>
					<ul>
                    <div class="bloque_lista">
                      <div class="titulo_bloque">
						<a href="verEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEntrenamiento=<?php echo $entrenamiento->getId(); ?>">
							<h1><?php echo $entrenamiento->getNombre(); ?></h1>
						</a>
                      </div>

                      <div class="info_bloque">
                        <p> <?php echo __('Duración',$lang); ?> : <?php echo $entrenamiento->getDuracion(); ?> min.</p>
                      </div>

                      <?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){ ?>
                      <div class="opciones_bloque">
						  <a id="btn_imprimir" href="imprimirEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEnt=<?php echo $entrenamiento->getId();?>" class="btn btn-primary" title="<?php echo __('Imprimir',$lang); ?>" type="button"><i class="fa fa-print" aria-hidden="true"></i></a>
                          <a id="btn_eliminar" href="eliminarEntrenamiento.php?lang=<?php echo $lang ?>&amp;idEnt=<?php echo $entrenamiento->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </div>
                      <?php } ?>
                    </div>
          		</ul>
                  <?php }} ?>
          			</li>
          		</ul>
            </nav>

			<?php
			$entrenamientos = $econtroller->listarEntrenamientosNivel("avanzado");
			if($entrenamientos != NULL){
			?>
            <nav id = "desplegable3">
              <ul>
          		<li id="nivel3"><a id = "activador_3" class= "btn_nivel" href="#"><i id = "activador_3" class="fa fa-chevron-down"></i><?php echo __('Avanzado',$lang); ?></a>
					<?php
					foreach ($entrenamientos as $entrenamiento) {
					?>
			<ul>
            <div class="bloque_lista">
				<div class="titulo_bloque">
					<a href="verEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEntrenamiento=<?php echo $entrenamiento->getId(); ?>">
						<h1><?php echo $entrenamiento->getNombre(); ?></h1>
					</a>
                 </div>

                 <div class="info_bloque">
					<p> <?php echo __('Duración',$lang); ?> : <?php echo $entrenamiento->getDuracion(); ?> min.</p>
                 </div>
                     <?php if($_SESSION['rol'] == "administrador"  || $_SESSION['rol'] == "entrenador" ){ ?>
                 <div class="opciones_bloque">
					 <a id="btn_imprimir" href="imprimirEntrenamiento.php?lang=<?php echo $lang; ?>&amp;idEnt=<?php echo $entrenamiento->getId();?>" class="btn btn-primary" title="<?php echo __('Imprimir',$lang); ?>" type="button"><i class="fa fa-print" aria-hidden="true"></i></a>
                    <a id="btn_eliminar" href="eliminarEntrenamiento.php?lang=<?php echo $lang ?>&amp;idEnt=<?php echo $entrenamiento->getId(); ?>" class="btn btn-primary" title="<?php echo __('Eliminar',$lang); ?>" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                 </div>
                     <?php } ?>
                 </div>
			 </ul>
              		<?php }} ?>
          	</li>
          </ul>
         </nav>
        </div>

       </div>
      </div>
     </div>

    </div>



    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
