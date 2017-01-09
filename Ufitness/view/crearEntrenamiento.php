<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");

$ejercontroller = new controlador_Ejercicio();

if(!isset($_SESSION)) session_start();
$ucontroller = new controlador_Usuario();
$usuarioActual =  $ucontroller->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador"){
	header("Location: error.php");
	exit();
}

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

    <title> Nuevo Entrenamiento - Ufitness</title>

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
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong><?php echo __('Nuevo Entrenamiento',$lang); ?></strong>
        </div>
        <div >
  				<form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Entrenamiento&amp;accion=anhadir" method="post" class="formulario ">
              <?php echo __('Nombre Entrenamiento',$lang); ?>: <input  type="text" name="nombre" class="input" required="true"/>
              <?php echo __('Duración',$lang); ?>: <input type="text" name="duracion" class="input" required="true"/>
							<?php echo __('Nivel Entrenamiento',$lang); ?>: <select name="nivel" class="select">
			                                            <option value="principiante" selected><?php echo __('Principiante',$lang); ?></option>
			                                            <option value="intermedio"><?php echo __('Intermedio',$lang); ?></option>
																									<option value="avanzado"><?php echo __('Avanzado',$lang); ?></option>
            																	 </select>
              <?php echo __('Selecciona los ejercicios que formarán parte del entrenamiento',$lang); ?>:
								<?php
									foreach ($ejercicios as $ejercicio) {
										$sxr="seriesxRep".$ejercicio->getIdEjercicio();
										$carga="carga".$ejercicio->getIdEjercicio();
								?>
								<ul>
									<li>
											<input type="checkbox" name="ejercicio[]"  value="<?php echo $ejercicio->getIdEjercicio();?>"> <strong><?php echo $ejercicio->getNombre();?></strong>
											<p><?php echo __('Series',$lang); ?> x <?php echo __('Repeticion',$lang); ?> : <input type="text"  class="input_ejer" name = "<?php echo $sxr;?>" placeholder="Ej: 3x12" ></p>
											<p><?php echo __('Carga',$lang); ?> : <input type="number" class="input_ejer" name ="<?php echo $carga;?>" placeholder="Ej: 3"></p>
									</li>
								</ul>
								<?php
									}
								?>
								<div class="form_submit">
										<input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Guardar',$lang); ?> ">
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
