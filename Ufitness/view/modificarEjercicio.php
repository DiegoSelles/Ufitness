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
$econtroler = new controlador_Ejercicio();

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
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong>Modificar Ejercicio</strong>
        </div>
        <div >
  				<form enctype = "multipart/form-data" action="../controller/controlador.php?controlador=controlador_Ejercicio&amp;accion=modificarEjercicio" method="post" class="formulario">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
						<label for="nombre">Nombre Ejercicio:</label>
            <input type="text" name="nombre" value="<?php echo $ejercicio->getNombre(); ?>"/>
            <label for="tipoEjercicio">Tipo del ejercicio:</label>
            <select name="tipoEjercicio">
                <option value="Cardio" <?php echo (($ejercicio->getTipoEjercicio()=="Cardio")?"selected":""); ?>>Cardio</option>
                <option value="Estiramientos" <?php echo (($ejercicio->getTipoEjercicio()=="Estiramientos")?"selected":""); ?>>Estiramientos</option>
                <option value="Muscular" <?php echo (($ejercicio->getTipoEjercicio()=="Muscular")?"selected":""); ?>>Muscular</option>
            </select>
            <label for="maquina">Maquina:</label>
            <input type="text" name="maquina" value="<?php echo $ejercicio->getMaquina(); ?>"/>
            <label for="grupoMuscular">Grupo Muscular:</label>
            <select name="grupoMuscular">
              <!-- falta ponerle aqui el valor que estaba antes -->
                <option value="Piernas" <?php echo (($ejercicio->getGrupoMuscular()=="Piernas")?"selected":""); ?>>Piernas</option>
                <option value="Brazos" <?php echo (($ejercicio->getGrupoMuscular()=="Brazos")?"selected":""); ?>>Brazos</option>
                <option value="Espalda" <?php echo (($ejercicio->getGrupoMuscular()=="Espalda")?"selected":""); ?>>Espalda</option>
            </select>
            <label for="descripcion">Descripcion:</label>
            <input type="text" name="descripcion" value="<?php echo $ejercicio->getDescripcion(); ?>"/>

            <input type="text" hidden="true" name="dniCreador" value="<?php echo $ejercicio->getUsuarioDni(); ?>" />

            <input type="text" hidden="true" name="idEjercicio" value="<?php echo $id; ?>" />

						<label for="imagen">Imagen:</label>

						<?php if ($ejercicio->getImagen() != null){ ?>
								<div class="responsive">
									<div class="img">
										<a target="_blank" href="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>">
											<img src="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>"  alt="Trolltunga Norway" width="300" height="200">
										</a>
									</div>
								</div>
								<input type="text" hidden="true" name="imagenActual" value="<?php echo $ejercicio->getImagen(); ?>">

						<?php }else { ?>
							<div class="imgs_ejercicio">
								<div class="responsive">
									<div class="img">
										<a target="_blank" href="img/img.png">
											<img src="img/img.png" alt="Trolltunga Norway" width="300" height="200">
										</a>
									</div>
								</div>
						<?php } ?>


						<input type="file" name="imagen"/>
						<br/>

            <input id="submit" class="btn btn-primary" type="submit" value="Guardar Cambios">
            <br/>
            <a id="submit" href="adminEjercicios.php" class="btn btn-primary" type="button">Salir</a>
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
