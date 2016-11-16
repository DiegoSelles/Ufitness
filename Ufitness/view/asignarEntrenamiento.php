<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Entrenamiento.php");

if(!isset($_SESSION)) session_start();
$ucontroler = new controlador_Usuario();
$econtroler = new controlador_Entrenamiento();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if(isset($_GET['Dni'])){
$id = $_GET['Dni'];
	}
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

    <title> asignarActividad - Ufitness</title>

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
			$entrenamientos = $econtroler->listarEntrenamientos();
			?>

			<div id="contenido" class="container-fluid">
				<div class="titulo_seccion">
					<i class="fa fa-table" aria-hidden="true"></i>
					<strong>Asignacion de entrenamientos</strong>
				</div>
			<div >
							
              <label for="lista">Entrenamientos</label>
              <select name="entrenamiento">
              <?php foreach ($entrenamientos as $entrenamiento) { ?>
               <option value="Entrenamiento" selected><?php echo $entrenamiento->getNombre(); } ?></option>             
  			   </select>
  			   <form method="post" action="#">
				<input id="btn_reservar" type="submit" value="Asignar entrenamiento" name="AsignarEntrenamiento">
              </form>
              <a href="adminEntrenamientos.php"><input id="btn_crear" type="submit" value="Crear entrenamiento" name="Crear entrenamiento"></a>
              <?php if(isset($_POST['AsignarEntrenamiento'])){
				   $econtroler->asignarEntrenamiento($id,$entrenamiento['nombre']); }?>
			</div>
		</div>
	</div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

