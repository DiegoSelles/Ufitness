<?php

require_once("../resources/conexion.php");

     switch($_SESSION['rol']){
				case "administrador":
				echo '
			<div id="wrapper">
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.php"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.php"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.php"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                    <li>
                        <a href="adminEntrenadores.php"><i class="fa fa-users" aria-hidden="true"></i> Entrenadores </a>
                    </li>
                    <li>
                        <a href="adminDeportistas.php"><i class="fa fa-users" aria-hidden="true"></i> Deportistas </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>



    </div>';
    break;
    
    case "entrenador":
    
    echo '
				<div id="wrapper">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.php"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.php"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.php"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                    <li>
                        <a href="adminDeportistas.php"><i class="fa fa-users" aria-hidden="true"></i> Deportistas </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


    </div>';
    break;
    
    case "deportista":
    
    echo '
				<div id="wrapper">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="adminActividades.php"><i class="fa fa-futbol-o" aria-hidden="true"></i> Actividades </a>
                    </li>
                    <li>
                        <a href="adminEntrenamientos.php"><i class="fa fa-trophy" aria-hidden="true"></i> Entrenamientos </a>
                    </li>
                    <li>
                        <a href="adminEjercicios.php"><i class="fa fa-bicycle" aria-hidden="true"></i></i> Ejercicios </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        


    </div>';
    break;

		
    } ?>
