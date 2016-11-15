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


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> AdminEntrenadores - Ufitness</title>

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
    <script src="js/confirmacionEliminarEntrenador.js"></script>
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

      if (isset($_GET['eliminar'])){
        $ucontroler->eliminar($_GET['eliminar']);
       // echo "    blabla";
        /*Molaba buscar una manera de que despues de que se eliminara una actividad no saliera en la
        barra de direcciones el parametro eliminar=blabla que queda feo. Con la linea siguiente no funciona
        PROBLEMA DE SEGURIDAD: si se conoce este parametro get podrían eliminarse desde la barra de direcciones*/
        //header("Location: adminEntrenadores.php");
      }
      else
      {
        //header("Location: error.php");
      }


			?>

 <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-users" aria-hidden="true"></i>
              <strong>Entrenadores</strong>
            </div>
            <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1>Lista de Entrenadores </h1>
                </div>
                <div id="custom-search-input">
                  <div class="input-group col-md-12">
                      
                  </div>
                </div>
                <div class="anadir">
                  <a id="btn_anadir"  href="../view/crearEntrenador.php" class="btn btn-primary" type="button">Añadir Entrenador</a>
                </div>
              </div>
              <div class="body_pagina">
                <ul>
                    <li>

                      <?php
                         $usuarios = $ucontroler->listarEntrenadores();
                         foreach ($usuarios as $usuario) {
                         ?>

                      <div class="bloque_lista">
                        <div class="titulo_bloque">
                          <h1> <?php echo $usuario->getNombre(); ?><h1>
                        </div>
                        <div class="info_bloque">
                          <p>Dni: <?php echo $usuario->getDni(); ?>    </p>
                          <p>Edad: <?php echo $usuario->getEdad(); ?>    </p>
                          <p>Email:   <?php echo $usuario->getEmail(); ?> </p>
                        </div>
                        <div class="opciones_bloque">
                                                     
                           <?php $usuarioEliminar = $usuario->getDni(); ?>
                           <script type="text/javascript">
                             var usuarioEliminar = '<?php echo $usuarioEliminar; ?>'
                           </script>

                            <a id="btn_edit_bloque" href="../view/modificarEntrenador.php?dni=<?php echo $usuarioEliminar; ?>" class="btn btn-primary" type="button"><i class="fa fa-edit" aria-hidden="true" title="modificar"></i></a> 

                            <a id="btn_eliminar" href="eliminarEntrenador.php?dni=<?php echo $usuarioEliminar; ?>" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                      </div>

                       <?php }; ?>

                    </li>
                </ul>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
