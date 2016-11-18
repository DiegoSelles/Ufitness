<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");
require_once("../controller/controlador_Entrenamiento.php");

$ejercontroller = new controlador_Ejercicio();
$entcontroller = new controlador_Entrenamiento();

if(!isset($_SESSION)) session_start();
$ucontroller = new controlador_Usuario();
$usuarioActual =  $ucontroller->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
	header("Location: error.php");
	exit();
}

?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Modificar Entrenamiento - Ufitness</title>

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
			$ejercicios = $ejercontroller->listaEjercicios();
			if(isset($_GET['idEnt'])){
        $idEnt = $_GET['idEnt'];
        $entrenamiento = $entcontroller->buscarEntrenamientoId($idEnt);
				//print_r($entrenamiento);

      }else{
        header("Location: ../view/error.php");
      }
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong><?php echo $entrenamiento->getNombre(); ?></strong>
        </div>
        <div >
  				<form action="../controller/controlador.php?controlador=controlador_Entrenamiento&amp;accion=modificarEntrenamiento" method="post" class="formulario">
              <?php echo "Nombre Entrenamiento" ?>: <input  type="text" name="nombre" value="<?php echo $entrenamiento->getNombre(); ?>" class="input"/>
              <?php echo "Duración" ?>: <input type="text" name="duracion" value="<?php echo $entrenamiento->getDuracion(); ?>" class="input"/>
							<?php echo "Nivel Entrenamiento" ?>: <select name="nivel" class="select">
			                                            <option value="principiante" <?php echo (($entrenamiento->getNivel()=="principiante")?"selected":""); ?>>Principiante</option>
			                                            <option value="intermedio" <?php echo (($entrenamiento->getNivel()=="intermedio")?"selected":""); ?>>Intermedio</option>
																									<option value="avanzado" <?php echo (($entrenamiento->getNivel()=="avanzado")?"selected":""); ?>>Avanzado</option>
            																	 </select>
              <?php echo "Selecciona los ejercicios que formarán parte del entrenamiento" ?>:
								<?php
									foreach ($ejercicios as $ejercicio) {
										$idEjer = $ejercicio->getIdEjercicio();
										$tieneEjer = $entcontroller->entrenamientoTieneEjer($idEnt, $idEjer);
										$entrenamientoHasEjercicio = $entcontroller->ejercicioEnEntrenamiento($idEnt,$idEjer);
										$sxr="seriesxRep".$ejercicio->getIdEjercicio();
										$carga="carga".$ejercicio->getIdEjercicio();
								?>
								<ul>
									<li>
										<input type="checkbox" name="ejercicio[]"  value="<?php echo $ejercicio->getIdEjercicio();?>" <?php echo (($tieneEjer)?"checked":""); ?>> <strong><?php echo $ejercicio->getNombre();?></strong>
										<p>Series x Repetición: <input type="text"  class="input_ejer" name = "<?php echo $sxr;?>" placeholder="Ej: 3x12" <?php if($tieneEjer){ ?> value = <?php echo $entrenamientoHasEjercicio->getSxR(); } ?>  ></p>
										<p>Carga: <input type="text" class="input_ejer" name ="<?php echo $carga;?>" placeholder="Ej: 3" <?php if($tieneEjer){ ?>value = <?php echo $entrenamientoHasEjercicio->getCarga(); } ?> ></p>

									</li>
								</ul>
								<?php
							}
								?>
							<input  type="text" name="idEnt" hidden="true" value="<?php echo $entrenamiento->getId(); ?>"/>
							<div class="form_submit">
								<input id="submit" class="btn btn-primary" type="submit" value="Guardar Cambios">
							  <a id="submit" href="adminEntrenadores.php" class="btn btn-primary" type="button">Volver</a>
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
