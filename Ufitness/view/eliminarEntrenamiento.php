<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Entrenamiento.php");
require_once("../controller/controlador_Ejercicio.php");
require_once("../controller/controlador_Usuario.php");

if(!isset($_SESSION)) session_start();
global $id;

if(isset($_GET['idEnt'])){
  $id = $_GET['idEnt'];
}
$ucontroller = new controlador_Usuario();
$entcontroller = new controlador_Entrenamiento();
$ejercontroller = new controlador_Ejercicio();

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

    <title> Eliminar Entrenamiento - Ufitness</title>

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

      $entrenamiento = $entcontroller->buscarEntrenamientoId($id);
      $listaEntHasEjer  = $entcontroller->ejerciciosEntrenamiento($id);

      ?>

      <div id="contenido" class="container-fluid">
        <div class="titulo_seccion">
          <i class="fa fa-bicycle" aria-hidden="true"></i>
          <strong><?php echo __('¿Está seguro que quiere eliminar este entrenamiento?',$lang); ?></strong>
        </div>
        <div >
          <form action="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Entrenamiento&amp;accion=eliminarEntrenamiento" method="post" class="formulario">
              <label><?php echo __('Nombre',$lang); ?> : <?php echo $entrenamiento->getNombre(); ?></label>
               <br/>
              <label> <?php echo __('Duración',$lang); ?> : <?php echo $entrenamiento->getDuracion(); ?></label>
               <br/>
              <label> <?php echo __('Nivel',$lang); ?> : <?php echo $entrenamiento->getNivel(); ?></label>
               <br/>
              <label><?php echo __('Ejercicios del entrenamiento',$lang); ?>: </label>
              <?php
                  foreach ($listaEntHasEjer as $entHasEjer) {
                    $ejercicio = $ejercontroller->buscarId($entHasEjer->getIdEjercicio());

              ?>
              <ul>
                <div class="bloque_lista">
                  <div class="titulo_bloque">
                      <h1> <?php echo $ejercicio->getNombre(); ?> <h1>
                    </a>
                  </div>
                  <div class="info_bloque">
                    <p> <?php echo __('Descripción',$lang); ?> : <?php echo $ejercicio->getDescripcion(); ?></p>
                    <p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
                    <p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                    <p> <?php echo __('Series',$lang); ?> X <?php echo __('Repeticion',$lang); ?>: <?php echo $entHasEjer->getSxR(); ?></p>
                    <p> <?php echo __('Carga',$lang); ?> : <?php echo $entHasEjer->getCarga(); ?></p>
                  </div>
                </div>
              </ul>
              <?php }?>

              <!-- Habría que meter imagen y video aqui tambien -->

              <input type="text" hidden="true" name="id" value="<?php echo $id; ?>" />
              <div class="form_submit">
                <input id="submit" class="btn btn-primary" type="submit" value="<?php echo __('SI',$lang); ?>">
                <a id="submit" href="adminEjercicios.php?<?php echo $lang; ?>" class="btn btn-primary" type="button"><?php echo __('NO',$lang); ?></a>
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
