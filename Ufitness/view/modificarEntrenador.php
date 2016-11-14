<?php
require_once("../resources/conexion.php");
require_once("../controller/UsuariosController.php");

if(!isset($_SESSION)) session_start();
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador" && $_SESSION['rol'] != "deportista"){
	header("Location: error.php");
	exit();
}

$usuarios = new UsuariosController();

?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Añadir Entrenador - Ufitness</title>

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
      $usuario = $usuarios->listarPorDni($_GET['dni']);
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong>Modificar Entrenador</strong>
        </div>
        <div >
  				<form action="adminEntrenadores.php?controller=usuarios&amp;action=editar" method="post" class="formulario">
              <?php echo $usuario->getNombre(); ?>: <input  type="text" name="nombre" value="" />
              <?php echo "DNI" ?>: <input type="text" name="Dni"/>
              <?php echo "Edad" ?>: <input type="text" name="edad"/>
              <?php echo "E-mail" ?>: <input type="text" name="email"/>
              <?php echo "Contraseña" ?>: <input type="password" name="password"/>
              <input type="text" name="rol" hidden="true" value="entrenador" />
              <input type="text" name="DniAdmin" hidden="true" value=$_SESSION['Dni'] />
              <br/>
              <br/>

							<input id="submit" class="btn btn-primary" type="submit" value="Actualizar">

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