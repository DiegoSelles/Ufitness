<?php

require_once("../resources/conexion.php");
require_once("../controller/ActividadController.php");

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

    <title> AdminEntrenamientos - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/desplegarMenu.js"></script>
		<script src="js/confirmacionEliminar.js"></script>

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
			$acontroler = new ActividadController();

			/*Se comprueba si la peticion viene con el parametro para eliminar
			y si es así se llama a la funcion del controlador*/
			if (isset($_GET['eliminar'])){
				$acontroler->eliminarActividad($_GET['eliminar']);

				/*Molaba buscar una manera de que despues de que se eliminara una actividad no saliera en la
				barra de direcciones el parametro eliminar=blabla que queda feo. Con la linea siguiente no funciona
				PROBLEMA DE SEGURIDAD: si se conoce este parametro get podrían eliminarse desde la barra de direcciones*/
				header ("Location: adminActividades.php?");
			}

		?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                <strong>Actividades</strong>
            </div>
            <div class="listado">
                <div class="header_lista">
                    <div class="titulo_lista">
                    <h1>Lista de Actividades </h1>
                    </div>
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="Buscar Actividad">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="anadir">
                        <a id="btn_anadir" href="#" class="btn btn-primary" type="button">Añadir Actividad</a>
                    </div>
                </div>
								<?php
								//no utilizo la funcion listarActividades de ActividadControler porque luego no se como iterar ese resultado
									$consulta = mysql_query("SELECT * FROM Actividad");
									while ($actividad = mysql_fetch_assoc($consulta)) {
									 ?>
									  	<ul>
                        <div class="bloque_lista">

                            <div class="titulo_bloque">
															<a href = "verActividad.php?idActividad=<?php echo $actividad['idActividad']; ?>">
																<h1> <?php echo $actividad['nombre']; ?><h1>
															</a>
                            </div>

                            <div class="info_bloque">
                                <p>Horario: <?php echo $actividad['horario']; ?></p>
                            </div>
                            <div class="opciones_bloque">
                                <a id="btn_edit_bloque" href="#" class="btn btn-primary" title="Editar" type="button">
																	<i class="fa fa-edit" aria-hidden="true"></i>
																</a>
																<!--Cuando se pulsa el botón de eliminar se ejecuta una funcion javascript
															 			que está en js/confirmacionEliminar-->
                                <a id="btn_eliminar" href="#" onclick="confirmation(<?php echo $actividad['idActividad']; ?>)"class="btn btn-primary" title="Eliminar" type="button">

																	<i class="fa fa-trash-o" aria-hidden="true"></i>
																</a>
                            </div>
                        </div>
                    </ul>
							<?php
								}
							?>


            </div>
        </div>
    </div>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
