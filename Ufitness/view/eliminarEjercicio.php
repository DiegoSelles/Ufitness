<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Ejercicio.php");

if(!isset($_SESSION)) session_start();
global $id;

if(isset($_GET['idEjercicio'])){
  $id = $_GET['idEjercicio'];
}
$ucontroler = new controlador_Usuario();
$econtroler = new controlador_Ejercicio();
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

    <title> Eliminar Ejercicio - Ufitness</title>

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

      $ejercicio = $econtroler->buscarId($id);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-bicycle" aria-hidden="true"></i>
          <strong>¿Está seguro que quiere eliminar este ejercicio?</strong>
        </div>
        <div >
          <form action="../controller/controlador.php?controlador=controlador_Ejercicio&amp;accion=eliminarEjercicio" method="post" class="formulario">
              <label>Nombre: <?php echo $ejercicio->getNombre(); ?></label>
               <br/>
              <label>Tipo: <?php echo $ejercicio->getTipoEjercicio(); ?></label>
               <br/>
              <label>Grupo Muscular: <?php echo $ejercicio->getGrupoMuscular(); ?></label>
               <br/>
              <label>Descripción: <?php echo $ejercicio->getDescripcion(); ?></label>
              <br/>
              <label>Dni del creador: <?php echo $ejercicio->getUsuarioDni(); ?></label>
              <br/>

              <?php if ($ejercicio->getImagen() != null){ ?>

                  <div class="img">
                    <a target="_blank" href="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>">
                      <img src="../imagenesSubidas/<?php echo $ejercicio->getImagen(); ?>"  alt="Trolltunga Norway" width="300" height="200">
                    </a>
                  </div>
                  <br/>
              <?php } ?>

              <?php if ($ejercicio->getVideo() != null){ ?>
								<iframe width="420" height="315" src="<?php echo $ejercicio->getVideo(); ?>" allowfullscreen></iframe>
							 <?php } ?>


               <br/>
              <input type="text" hidden="true" name="id" value="<?php echo $id; ?>" />

              <input id="submit" class="btn btn-primary" type="submit" value="SI">
              <br/>
              <a id="submit" href="adminEjercicios.php" class="btn btn-primary" type="button">NO</a>

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
