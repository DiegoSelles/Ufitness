<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Deportista.php");

if(!isset($_SESSION)) session_start();


$ucontroler = new controlador_Usuario();
$dcontroler = new controlador_Deportista();
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

    <title> Modificar Deportista - Ufitness</title>

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

			if(isset($_GET['dniDeportista'])){
				$dniDeportista = $_GET['dniDeportista'];
				$deportista = $dcontroler->buscarDeportistaDni($dniDeportista);

			}else{
				header("Location: ../view/error.php");
			}
			?>

			<div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-users" aria-hidden="true"></i>
          <strong><?php echo __('Modificar Deportista',$lang); ?></strong>
        </div>
        <div >
  				<form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Deportista&amp;accion=modificarDeportista" method="post" class="formulario">
              <?php echo __('Nombre completo',$lang); ?>: <input  type="text" name="nombre" value="<?php echo $deportista->getNombre(); ?>" class="input" required="true"/>
              <?php echo "DNI" ?>: <input type="text" name="dni" value="<?php echo $deportista->getDni(); ?>" class="input" pattern="[0-9]{8}[A-Z]{1}" title="<?php echo __('El formato debe coincidir con 8 números y 1 letra.',$lang); ?>"/>
              <input type="text" name="dniAntiguo" hidden="true" value="<?php echo $deportista->getDni(); ?>"/>
              <?php echo __('Fecha Nacimiento',$lang); ?>: <input type="date" name="fecha" class="input" required="true" value="<?php echo $deportista->getFecha(); ?>"/>
              <?php echo "e-mail" ?>: <input type="text" name="email" value="<?php echo $deportista->getEmail(); ?>" class="input"/>
              <!--<?php echo  __('Contraseña',$lang); ?>:--> <input type="password" hidden = "true" name="password" value="<?php echo $deportista->getPassword(); ?>" class="input"/>
              <?php echo __('Modificar Tipo Deportista',$lang); ?>: <select name="tipo" class="select">
        			                                            <option value="tdu" <?php echo (($deportista->getTipo()=="tdu")?"selected":""); ?>>TDU</option>
        			                                            <option value="pef" <?php echo (($deportista->getTipo()=="PEF")?"selected":""); ?>>PEF</option>
            																	           </select>
              <?php echo __('Riesgos',$lang); ?>: <textarea name="riesgos" rows="5" cols="20"><?php echo $deportista->getRiesgos(); ?> </textarea>
							<div class="form_submit">
								<input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Guardar Cambios',$lang); ?>">
								<a id="submit" href="adminDeportistas.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Volver',$lang); ?> </a>
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
