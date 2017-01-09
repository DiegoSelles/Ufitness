<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
require_once("../controller/controlador_Entrenamiento.php");
require_once("../controller/controlador_Ejercicio.php");

if(!isset($_SESSION)) session_start();

global $idEntrenamiento;
global $idEjercicio;

$ucontroler = new controlador_Usuario();
$usuarioActual =  $ucontroler->getUsuarioActual($_SESSION['Dni']);
$usuarioDni = $_SESSION['Dni'];
$fecha = date("Y-m-d");
$entcontroller = new controlador_Entrenamiento();
$ejercontroller = new controlador_Ejercicio();

if($_SESSION['rol'] != "deportista"){
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

    <title> Monitorizar Entrenamiento- Ufitness</title>

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

    <!--JavaScript-->
    <script src="js/desplegarMenu.js"></script>
     <script languague="javascript">
        function mostrar(id) {
            div = document.getElementById('oculto-'+id);
            div.style.display = 'block';
            div2 = document.getElementById('botones-'+id);
            div2.style.display = 'none';
            div3 = document.getElementById('info-'+id);
            div3.style.display = 'none';
        }

        function cerrar(id) {
            div = document.getElementById('oculto-'+id);
            div.style.display = 'none';
            div2 = document.getElementById('botones-'+id);
            div2.style.display = 'block';
            div3 = document.getElementById('info-'+id);
            div3.style.display = 'block';

        }

        function borrarTexto() {
            document.getElementById("texto_Anotacion").value = "";
        }






  </script>
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

      //$entrenamiento=$entcontroller->buscarEntrenamientoId($idEntrenamiento);

      if(isset($_GET['idEntrenamiento'])){
        $idEntrenamiento=$_GET['idEntrenamiento'];
        $entrenamiento=$entcontroller->buscarEntrenamientoId($idEntrenamiento);

      }else header("Location: ../view/error.php");




      ?>

      <div id="contenido" class="container-fluid">
         <div class="titulo_seccion">
            <i class="fa fa-table" aria-hidden="true"></i>
              <strong><?php echo __('Monitorizar Entrenamiento',$lang); ?> - <?php echo $entrenamiento->getNombre(); ?> </strong>
          </div>
          <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1><?php echo __('Lista de Ejercicios',$lang); ?></h1>
                </div>
                <div id="custom-search-input">
                  <div class="input-group col-md-12">
                  </div>
                </div>
                <div class="anadir">
                    <a id="btn_anadir"  href="../view/verEntrenamiento.php?lang=<?php echo $lang; ?>&idEntrenamiento=<?php echo$idEntrenamiento; ?>" class="btn btn-primary" type="button"><?php echo __('Volver',$lang); ?></a>
                </div>
              </div>
              <div class="body_pagina">
                <?php $entrenamientoHasEjercicios = $entcontroller->ejerciciosEntrenamiento($entrenamiento->getId());
                    foreach ($entrenamientoHasEjercicios as $entrenamientoHasEjercicio) {
                        $ejercicio = $ejercontroller->buscarId($entrenamientoHasEjercicio->getIdEjercicio());
                ?>
                  <ul>
                    <form action="../controller/controlador.php?<?php echo $lang; ?>&controlador=controlador_Entrenamiento&amp;accion=ejerciciosRealizados" method="post">
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                              <h1>  <?php echo $ejercicio->getNombre(); ?></h1>
                          </div>
                          <div id="info-<?=$ejercicio->getIdEjercicio()?>" class="info_bloque">
                            <p> <?php echo __('Descripción',$lang); ?> : <?php echo $ejercicio->getDescripcion(); ?></p>
                            <p> <?php echo __('Máquina',$lang); ?> : <?php echo $ejercicio->getMaquina(); ?></p>
                            <p> <?php echo __('Tipo',$lang); ?> : <?php echo $ejercicio->getTipoEjercicio(); ?></p>
                            <p> <?php echo __('Series',$lang); ?> X <?php echo __('Repeticion',$lang); ?>: <?php echo $entrenamientoHasEjercicio->getSxR(); ?></p>
                            <p> <?php echo __('Descripción',$lang); ?> : <?php echo $entrenamientoHasEjercicio->getCarga(); ?></p>
                            <p>fecha: <?php echo $fecha; ?></p>
                          </div>
                          <div class="opciones_bloque">
                            <div id="botones-<?= $ejercicio->getIdEjercicio()?>" style="display:block;">
                              <input type="text" name="idEjercicio" hidden="true" value="<?php echo $ejercicio->getIdEjercicio();?>" />
                              <?php $idEjercicio = $ejercicio->getIdEjercicio() ?>
                              <input  type="text" name="dniDeportista" hidden="true" value="<?php echo $usuarioDni;?>" />

                              <input  type="text" name="idEntrenamiento" hidden="true" value="<?php echo $idEntrenamiento;?>" />

                              <input  type="text" name="fecha" hidden="true" value="<?php echo $fecha;?>" />

                              <?php if($entcontroller->ejercicioDiario($usuarioDni,$idEntrenamiento,$idEjercicio,$fecha)): ?>
                                    <label><?php echo __('Ejercicio Realizado',$lang); ?></label>
                              <?php endif ?>

                              <input id="btn_edit_bloque" title="<?php echo __('Verificar',$lang); ?>" class="btn btn-primary btn_verificar" type="submit" value="V" >

                              <a id="btn_eliminar" href="javascript:mostrar(<?=$ejercicio->getIdEjercicio()?>);" class="btn btn-primary" title="<?php echo __('Anotaciones',$lang); ?>" type="button"><i class="fa fa-book" aria-hidden="true"></i></a>
                          </div>
                          <div id="oculto-<?=$ejercicio->getIdEjercicio()?>" style="display:none">
                              <h4><?php echo __('Anotaciones',$lang); ?></h4>
                              <textarea rows="4" cols="50" name="anotacion" ></textarea>
                              <input  type="button" name="submit" value="<?php echo __('Guardar',$lang); ?>" onclick="cerrar(<?=$ejercicio->getIdEjercicio()?>)">
                              <input  type="button" name="submit" value="<?php echo __('Borrar',$lang); ?>" onclick="borrarTexto(<?=$ejercicio->getIdEjercicio()?>)">
                              <input  type="button" name="submit" value="<?php echo __('Cancelar',$lang); ?>" onclick="cerrar(<?=$ejercicio->getIdEjercicio()?>);">
                          </div>
                        </div>
                       </div>
                      </ul>
                    </form>
                  </ul>
                    <?php } ?>
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
