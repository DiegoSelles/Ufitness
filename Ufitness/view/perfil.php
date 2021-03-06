<?php 
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");

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

    <title> userIndex - Ufitness</title>

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

			<?php 
			include("navbar.php");
			include("wrapper.php"); 
			/*$sql = "SELECT * FROM Usuario WHERE DNI ='". $_SESSION['Dni'] ."' ";
			$consulta = mysql_query($sql);
			$datos = mysql_fetch_array($consulta);*/
			?>
			
			<div id="datos_user" class="container-fluid">
				<div id="titulo_perfil" class="titulo_seccion">
					<h2><strong><?php echo __('Perfil',$lang); ?> : </strong><?php echo $_SESSION['rol']; ?></h2>
						<div class="bloque_lista">
							<div class="info_bloque">
								<h4><strong> <?php echo __('Nombre',$lang); ?> : </strong><br> <?php echo $usuarioActual-> getNombre(); ?></br></h4>
								<h4><strong> Dni: </strong><br> <?php echo $usuarioActual-> getDni(); ?> </br></h4>
								<h4><strong> Email: </strong><br> <?php  echo $usuarioActual-> getEmail(); ?> </br></h4>
								<h4><strong> <?php echo __('Edad',$lang) ; ?>: </strong><br> <?php echo $usuarioActual-> getEdad(); ?> </br></h4>
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




