<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Notificacion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Deportista.php");


if(!isset($_SESSION)) session_start();
$dcontroler = new controlador_Deportista();
$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador" && $_SESSION['rol'] != "entrenador"){
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

    <title> Nueva Notificacion - Ufitness</title>

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
          <i class="fa fa-futbol-o" aria-hidden="true"></i>
          <strong>Nueva Notificación</strong>
        </div>
        <div>

					<?php $deportistas = $dcontroler->listaDeportistas();?>
  				<form name="form_notif" action="../controller/controlador.php?controlador=controlador_Notificacion&amp;accion=newNotificacion" method="post" >
						<div class="formulario_not">
							<div class="info_notif">
	              <label for="nombre">Título:</label>
	              <input type="text" name="titulo" class="input_notif" required="true"/>
	              <label for="nombre">Descripción:</label>
	              <textarea name="descripcion" rows="5" cols="4"></textarea>
							</div>
							<div class="receptor_notif">
								<label for="nombre">Enviar a:</label>
								<div class="radioBtn">
									<input type="radio" name="receptor" value="todos" required>Todos
	  						  <input type="radio" name="receptor" value="elegir">Elegir deportistas:
								</div>
								<div class="lista_receptor">
								<ul>
									<?php
									 foreach ($deportistas as $deportista): ?>
									<li>
											<input type="checkbox" name="receptores[]" value="<?php echo $deportista->getDni(); ?>" ><?php echo $deportista->getNombre().": ".$deportista->getDni(); ?></input>
									</li>
								<?php endforeach;?>
								</ul>
								</div>
							</div>
						</div>

							<div class="form_submit">
								<input id="submit" class="btn btn-primary" type="submit" value="Enviar Notificación">
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
