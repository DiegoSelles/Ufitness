<?php 
require_once("../resources/conexion.php");
require_once("../controller/controlador_Usuario.php");
//ejercicios 
//entrenamientos

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
              <i class="fa fa-table" aria-hidden="true"></i>
              <strong>Monitorizar Entrenamiento</strong>
            </div>
            <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1>Lista de Ejercicios </h1>
                </div>
                <div id="custom-search-input">
                  <div class="input-group col-md-12">
          
                  </div>
                </div>
                <div class="anadir">
                <a id="btn_anadir"  href="#" class="btn btn-primary" type="button">Finalizar Entrenamiento</a>
                </div>
              </div>

              <div class="body_pagina">
                <ul>
                    <li>

                  <!--    <?php
                         $usuarios = $ucontroler->listarEntrenadores();
                         foreach ($usuarios as $usuario) {
                         ?> -->

                      <div class="bloque_lista">
                        <div class="titulo_bloque">
                        <h1> Ejercicio 1 </h1>
                      <!--      <h1> <?php echo $usuario->getNombre(); ?><h1> -->
                        </div>
                        <div class="info_bloque">
                      <!--    <p>Dni: <?php echo $usuario->getDni(); ?>    </p>
                          <p>Edad: <?php echo $usuario->getEdad(); ?>    </p>
                          <p>Email:   <?php echo $usuario->getEmail(); ?> </p> -->
                        </div>
                        <div class="opciones_bloque">
                            
                            <a id="btn_edit_bloque" href="#" class="btn btn-primary" title="Verificar" type="button" ><i class="fa fa-check" aria-hidden="true"></i></a> 

                            <a id="btn_eliminar" href="#" class="btn btn-primary" title="Anotaciones" type="button"><i class="fa fa-book" aria-hidden="true" onclick=""></i></a>


                            <form hidden="true" name="anotaciones_form">
                            <textarea rows="4" cols="50" name="Anotacion" hidden="true">
                              
                            </textarea>
                            <input type="button" name="submit" value="guardar">
                            </form>

                        </div>
                      </div>

                    <!--   <?php }; ?> -->

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
