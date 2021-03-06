<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Actividad.php");


if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
$acontroler = new controlador_Actividad();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
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

    <title> Modificar actividad - Ufitness</title>

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
				if(isset($_GET['idActividad'])){
				$idActividad = $_GET['idActividad'];
				$actividad = $acontroler->buscarActividadById($idActividad);
				}
			?>

			<div id="contenido" class="container-fluid">
				<div class="titulo_seccion">
					<i class="fa fa-futbol-o" aria-hidden="true"></i>
					<strong><?php echo __('Modificar actividad',$lang);?></strong>
				</div>
			<div >

  			<form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Actividad&amp;accion=modificarActividad" method="post" class="formulario">
              <label for="nombre"><?php echo __('Nombre Actividad',$lang);?>: </label>
              <input type="text" name="nombre" value="<?php echo $actividad->getNombre(); ?>" class="input" required="true"/>
              <input type="text" name="id" hidden="True" value ="<?php echo $idActividad ?>" />
              <?php $entrenadores = $ucontroler->listarEntrenadores(); ?>
              <label for="monitor"><?php echo __('Modificar monitor',$lang);?> :</label>
              <select name="monitor" class="select">
                <?php foreach ($entrenadores as $entrenador) { ?>
                  <!-- Parece que funciona el option pero no se ven los nobmres de los entrenadores -->
		     <option value="<?php echo $entrenador->getNombre(); ?>" <?php echo (($entrenador->getNombre()==$actividad->getMonitor())?"selected":""); ?>><?php echo $entrenador->getNombre(); ?></option>

                <?php }?>
			  </select>
              <label for="horario"><?php echo __('Horario',$lang);?>:</label>
							<!--El horario no muestra la fecha anterior como debería -->
              <input type="text" placeholder = "YYYY-MM-DD HH:MM:SS" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}" name="horario" class="input" required="true" value="<?php echo $actividad->getHorario(); ?>"/>
              <label for="lugar"><?php echo __('Lugar',$lang);?>:</label>
              <input type="text" name="lugar" value="<?php echo $actividad->getLugar(); ?>" class="input" required="true"/>
              <label for="numPlazas"><?php echo __('Numero de plazas',$lang);?>:</label>
              <input type="number" name="numPlazas" value="<?php echo $actividad->getNumPlazas(); ?>" class="input" required="true"/>
              <label for="tipo"><?php echo __('Tipo',$lang);?>:</label>
              <input type="text" name="tipo" value="<?php echo $actividad->getTipoActividad(); ?>" class="input" required="true"/>
				<div class="form_submit">
			  	<input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Modificar',$lang);?>">
					<a id="submit" href="adminActividades.php?lang=<?php echo $lang;?>" class="btn btn-primary" type="button"><?php echo __('Volver',$lang);?></a>
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
