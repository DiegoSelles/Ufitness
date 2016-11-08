<?php 
require_once("../resources/conexion.php");
if(!isset($_SESSION)) session_start();
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

    <title> AdminEjercicios - Ufitness</title>

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
              <i class="fa fa-bicycle" aria-hidden="true"></i>
              <strong>Ejercicios</strong>
            </div>
            <div class="listado">
              <div class="header_lista">
                <div class="titulo_lista">
                  <h1>Lista de Ejercicios </h1>
                </div>
                <div id="custom-search-input">
                  <div class="input-group col-md-12">
                      <input type="text" class="form-control input-lg" placeholder="Buscar Ejercicio" />
                      <span class="input-group-btn">
                          <button class="btn btn-info btn-lg" type="button">
                              <i class="glyphicon glyphicon-search"></i>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="anadir">
                  <a id="btn_anadir" href="#" class="btn btn-primary" type="button">Añadir Ejercicio</a>
                </div>
              </div>
              <div class="body_pagina">
                <nav id = "desplegable1">
                  <ul>
              			<li id="nivel1"><a class= "btn_nivel" id = "activador_1"  href="#"><i id = "activador_1" class="fa fa-chevron-down" ></i> Piernas</a>
              				<ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
              				</ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </ul>
              			</li>
              		</ul>
                </nav>

                <nav id = "desplegable2">
                  <ul>
                    <li id="nivel2"><a class= "btn_nivel" id = "activador_2"  href="#"><i id = "activador_2" class="fa fa-chevron-down" ></i> Brazos</a>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
              				</ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
              				</ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
              				</ul>
                    </li>
                  </ul>
                </nav>

                <nav id = "desplegable3">
                  <ul>
              			<li id="nivel3"><a class= "btn_nivel" id = "activador_3"  href="#"><i id = "activador_3" class="fa fa-chevron-down" ></i> Espalda</a>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
              				</ul>
                      <ul>
                        <div class="bloque_lista">
                          <div class="titulo_bloque">
                            <h1> Nombre Ejercicio <h1>
                          </div>
                          <div class="info_bloque">
                            <p>Descripción</p>
                            <p>Máquina</p>
                            <p>Músculo</p>
                          </div>
                          <div class="opciones_bloque">
                              <a id="btn_eliminar" href="#" class="btn btn-primary" title="Eliminar" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </ul>
              			</li>
              		</ul>
                </nav>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>