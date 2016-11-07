<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once("conexion.php");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> AdminIndex - Ufitness</title>

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

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-logo" href="index.html"><img class="img-logo" src="img/logo.png" alt="logo"/></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
				<?php
					$login = $_SESSION['Dni'];
					$consulta = "SELECT Nombre FROM Usuario WHERE Dni='". $login ."'";
					$nombre = mysql_query($consulta);
					$sql = mysql_fetch_array($nombre)
					?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $sql['Nombre']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Opciones </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Desconectarse </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
            switch($_SESSION['rol']){
				case "administrador":
				echo '
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.html"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.html"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.html"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                    <li>
                        <a href="adminEntrenadores.html"><i class="fa fa-users" aria-hidden="true"></i> Entrenadores </a>
                    </li>
                    <li>
                        <a href="adminDeportistas.html"><i class="fa fa-users" aria-hidden="true"></i> Deportistas </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


    <div id="contenido" class="container-fluid">
      <div id="titulo_index" class="titulo_seccion">
        <h1><strong>Bienvenido a UFitness</strong></h1>
      </div>
      <div class="contenido_index">
        <button type="button" id="btn_notificacion" class="btn btn-primary">Nueva Notificación</button>
      </div>

    </div>
    </div>';
    break;

    case "entrenador":

    echo '
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.html"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.html"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.html"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                    <li>
                        <a href="adminDeportistas.html"><i class="fa fa-users" aria-hidden="true"></i> Deportistas </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


    <div id="contenido" class="container-fluid">
      <div id="titulo_index" class="titulo_seccion">
        <h1><strong>Bienvenido a UFitness</strong></h1>
      </div>
      <div class="contenido_index">
        <button type="button" id="btn_notificacion" class="btn btn-primary">Nueva Notificación</button>
      </div>

    </div>
    </div>';
    break;

    case "deportista":

    echo '
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.html"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.html"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.html"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


    <div id="contenido" class="container-fluid">
      <div id="titulo_index" class="titulo_seccion">
        <h1><strong>Bienvenido a UFitness</strong></h1>
      </div>
      <div class="contenido_index">
        <button type="button" id="btn_notificacion" class="btn btn-primary">Nueva Notificación</button>
      </div>

    </div>
    </div>';
    break;


    } ?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>