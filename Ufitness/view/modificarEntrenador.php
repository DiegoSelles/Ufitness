<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
global $dni;
if(isset($_GET['dni'])){
$dni = $_GET['dni'];
}
$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
if($_SESSION['rol'] != "administrador"){
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

    <title> Modificar Entrenador - Ufitness</title>

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

      $usuario = $ucontroler->buscarPorDni($dni);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-edit" aria-hidden="true"></i>
          <strong><?php echo __('Modificar Entrenador',$lang); ?></strong>
        </div>
        <div >
         <form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Usuario&amp;accion=editar" method="post" class="formulario">
              <?php echo  __('Nombre',$lang);  ?>: <input  type="text" name="nombre" value="<?php echo $usuario->getNombre(); ?>" class="input" required="true"/> <br/>
              <?php echo "DNI" ?>: <input type="text" name="Dni" value="<?php echo $usuario->getDni(); ?>"  class="input" required="true" pattern="[0-9]{8}[A-Z]{1}" title="<?php echo __('El formato debe coincidir con 8 números y 1 letra.',$lang); ?>"/>
              <br/>
              <?php echo __('Fecha Nacimiento',$lang); ?>: <input type="date" name="fecha" value="<?php echo $usuario->getFecha(); ?>" required="true" />
              <br/>
              <?php echo "E-mail" ?>: <input type="text" name="email" value="<?php echo $usuario->getEmail(); ?>" class="input"/>
              <br/>
              <?php echo __('Contraseña',$lang); ?>: <input type="password" name="password" value="<?php echo $usuario->getPassword(); ?>" class="input" required="true" />

              <input type="text" name="rol" hidden="true" value="entrenador" class="input"/>
              <input type="text" name="dniAntiguo" hidden="true" value="<?php echo $usuario->getDni(); ?>" class="input"/>
              <input type="text" name="DniAdmin" hidden="true" value=$_SESSION['Dni'] class="input"/>

             <!-- <input type="text" hidden="true" name="dni" value="<?php echo $dni; ?>" />-->
             <div class="form_submit">
               <input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('Guardar Cambios',$lang); ?>">
               <a id="submit" href="adminEntrenadores.php?lang=<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('Volver',$lang); ?></a>
 						</div>
              <br/>
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
