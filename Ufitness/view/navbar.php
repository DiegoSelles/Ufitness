<?php

require_once("../resources/conexion.php");

?>



<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-logo" href="adminIndex.php"><img class="img-logo" src="img/logo.png" alt="logo"/></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuarioActual->getNombre(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Opciones </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../controller/controlador.php?controlador=controlador_Usuario&accion=logout"><i class="fa fa-fw fa-power-off"></i> Desconectarse </a>
                        </li>
                    </ul>
                </li>
            </ul>
            </nav>
<!-- Navbar -->
