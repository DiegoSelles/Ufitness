<?php

require_once("../resources/conexion.php");
require_once("../resources/languages.php");

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
                <a class="navbar-logo" href="adminIndex.php?lang=<?php echo $lang; ?>"><img class="img-logo" src="img/logo.png" alt="logo"/></a>
                <?php if(isset($_SESSION)){
						if($lang == "es"){
							echo '<a class="idiomaEN" href="adminIndex.php?lang=en"><img class="img-ID" src="img/EN.png" alt="Ingles"/></a>';
						}else{
							echo '<a class="idiomaESP" href="adminIndex.php?lang=es"><img class="img-ID" src="img/ES.png" alt="Español"/></a>';
						}
					}else{ 
						echo '<a class="idiomaEN" href="index.php?lang=en"><img class="img-ID" src="img/EN.png" alt="Ingles"/></a>';
						echo '<a class="idiomaESP" href="index.php?lang=es"><img class="img-ID" src="img/ES.png" alt="Español"/></a>';
						}
                ?>
				
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuarioActual->getNombre(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php?lang=<?php echo $lang; ?>"><i class="fa fa-fw fa-user"></i> <?php echo __('Perfil',$lang); ?> </a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> <?php echo __('Opciones',$lang); ?> </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../controller/controlador.php?lang=<?php echo $lang; ?>&controlador=controlador_Usuario&accion=logout"><i class="fa fa-fw fa-power-off"></i> <?php echo __('Desconectarse',$lang); ?> </a>
                        </li>
                    </ul>
                </li>
            </ul>
            </nav>
<!-- Navbar -->
