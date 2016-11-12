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

?>

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
    <div id="wrapper">
			<?php
			include("navbar.php");
			include("wrapper.php");
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong>Nuevo Deportista</strong>
        </div>
        <div >
  				<form action="../?controller=deportista&amp;action=register" method="post" class="formulario">
              <?php echo "Nombre Completo" ?>: <input  type="text" name="nombre"/>
              <?php echo "DNI" ?>: <input type="text" name="dni"/>
              <?php echo "Fecha Nacimiento" ?>: <input type="date" name="nombre"/>
              <?php echo "e-mail" ?>: <input type="text" name="email"/>
              <?php echo "Contraseña" ?>: <input type="text" name="password"/>
              <?php echo "Rol" ?>: <select name="rol">
                                            <option value="deportista" selected>Deportista</option>
                                            <option value="administrador">Administrador</option>
                                            <option value="entrenador">Entrenador</option>
            											</select>
              <?php echo "Riesgos" ?>: <textarea name="riesgos" rows="10" cols="20"></textarea>
							<input id="submit" class="btn btn-primary" type="submit" value="Registrar">

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
<?php session_destroy() ?>