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
$econtroler = new controlador_Ejercicio();

if (isset($_GET['lang'])) {
     $lang = $_GET['lang'];
       }else{
		   $lang="es";
	   }

?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Modificar Ejercicio - Ufitness</title>

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
      if(isset($_GET['idEjercicio'])){
        $id = $_GET['idEjercicio'];
        $ejercicio = $econtroler->buscarId($id);

      }else{
        header("Location: ../view/error.php");
      }
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
					<i class="fa fa-bicycle" aria-hidden="true"></i>
          <strong><?php echo __('Modificar Ejercicio',$lang); ?></strong>
        </div>
        <div >
  				<form enctype = "multipart/form-data" action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Ejercicio&amp;accion=modificarEjercicio" method="post" class="formulario">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input"/>
						<label for="nombre"><?php echo __('Nombre Ejercicio',$lang); ?> :</label>
            <input type="text" name="nombre" value="<?php echo $ejercicio->getNombre(); ?>" class="input" required="true"/>
            <label for="tipoEjercicio"><?php echo __('Tipo de Ejercicio',$lang); ?>:</label>
            <select name="tipoEjercicio" class="select">
                <option value="Cardio" <?php echo (($ejercicio->getTipoEjercicio()=="Cardio")?"selected":""); ?>><?php echo __('Cardio',$lang); ?></option>
                <option value="Estiramientos" <?php echo (($ejercicio->getTipoEjercicio()=="Estiramientos")?"selected":""); ?>><?php echo __('Estiramientos',$lang); ?></option>
                <option value="Muscular" <?php echo (($ejercicio->getTipoEjercicio()=="Muscular")?"selected":""); ?>><?php echo __('Muscular',$lang); ?></option>
            </select>
            <label for="maquina"><?php echo __('Máquina',$lang); ?> :</label>
            <input type="text" name="maquina" value="<?php echo $ejercicio->getMaquina(); ?>" class="input" />
            <label for="grupoMuscular"><?php echo __('Grupo Muscular',$lang); ?>: </label>
            <select name="grupoMuscular" class="select">
              <!-- falta ponerle aqui el valor que estaba antes -->
                <option value="Piernas" <?php echo (($ejercicio->getGrupoMuscular()=="Piernas")?"selected":""); ?>><?php echo __('Piernas',$lang); ?></option>
                <option value="Brazos" <?php echo (($ejercicio->getGrupoMuscular()=="Brazos")?"selected":""); ?>><?php echo __('Brazos',$lang); ?></option>
                <option value="Espalda" <?php echo (($ejercicio->getGrupoMuscular()=="Espalda")?"selected":""); ?>><?php echo __('Espalda',$lang); ?></option>
            </select>
            <label for="descripcion"><?php echo __('Descripción',$lang); ?>:</label>
            <textarea name="descripcion" rows="3" cols="10"> <?php echo $ejercicio->getDescripcion(); ?> </textarea>

            <input type="text" hidden="true" name="dniCreador" value="<?php echo $ejercicio->getUsuarioDni(); ?>" />

            <input type="text" hidden="true" name="idEjercicio" value="<?php echo $id; ?>" />

						<label for="imagen"><?php echo __('Imagén',$lang); ?>:</label>

						<?php if ($ejercicio->getImagen() != null){ ?>
								<div class="responsive">
									<div class="img">
										<a target="_blank" href="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>">
											<img src="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>"  alt="Trolltunga Norway" width="300" height="200">
										</a>
									</div>
								</div>
								<input type="text" hidden="true" name="imagenActual" value="<?php echo $ejercicio->getImagen(); ?> " class="input">

						<?php }else { ?>
							<div class="imgs_ejercicio">
									<div class="img">
										<a target="_blank" href="img/img.png">
											<img src="img/img.png" alt="img/img.png" width="300" height="200">
										</a>
									</div>
						<?php } ?>

						<input type="file" name="imagen"/>
						<br/>
						<input type="text" hidden="true" name="videoActual" value="<?php echo $ejercicio->getVideo(); ?>">

						<label for="video"><?php echo __('Vídeo',$lang); ?>:</label>

						<?php if ($ejercicio->getVideo() != null){ ?>
							<iframe width="420" height="315" src="<?php echo $ejercicio->getVideo(); ?>" allowfullscreen></iframe>
						 <?php } ?>

 						<input type="text" name="urlYoutube" placeholder="https://www.youtube.com/watch?v=OgIRAjnnJzI"/>
						<div class="form_submit">
	            <input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Guardar Cambios',$lang); ?>">
	            <a id="submit" href="adminEjercicios.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Volver',$lang); ?></a>
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
