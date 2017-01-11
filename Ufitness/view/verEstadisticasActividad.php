<?php
require_once("../resources/conexion.php");
require_once("../controller/controlador_Actividad.php");
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

    <title> Actividad- Ufitness</title>

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
    <script languague="javascript">
        function mostrarInd() {
            div = document.getElementById('ocultoI');
            div.style.display = 'block';
        }
        function cerrarInd() {
            div = document.getElementById('ocultoI');
            div.style.display = 'none';
        }
        ///////////////////////////////////////////////////////
        function mostrarGrupo() {
            div = document.getElementById('ocultoG');
            div.style.display = 'block';
        }

        function cerrarGrupo() {
            div = document.getElementById('ocultoG');
            div.style.display = 'none';
        }
        //////////////////////////////////////////////////////
        function mostrarPEF() {
            div = document.getElementById('ocultoP');
            div.style.display = 'block';
        }
        function cerrarPEF() {
            div = document.getElementById('ocultoP');
            div.style.display = 'none';
        }
        ////////////////////////////////////////////////
        function mostrarTDU() {
            div = document.getElementById('ocultoT');
            div.style.display = 'block';
        }
        function cerrarTDU() {
            div = document.getElementById('ocultoT');
            div.style.display = 'none';
        }
</script>

</head>

<body>

    <div id="wrapper">

        <?php
        include("navbar.php");
        include("wrapper.php");
        $acontroler = new controlador_Actividad();
        $numeroActividades = $acontroler->numeroActividades();
        $numeroMedioPlazas = $acontroler->numeroMedioPlazas();
        $actividadPopular = $acontroler->actividadMasSolicitada();
        $actividadIndividual = $acontroler->actividadIndividual();
        $actividadGrupo = $acontroler->actividadGrupo();
        $actividadTDU = $acontroler->actividadesPorTDU();
        $actividadPEF = $acontroler->actividadesPorPEF();
        
        ?>

        <div id="contenido" class="container-fluid">
            <div class="titulo_seccion">
              <i class="fa fa-futbol-o" aria-hidden="true"></i>
              <strong>Estadísticas de Actividades</strong>
            </div>
            <div class="contenido_pagina">
              <div class="info_actividad">
                <div class="num_plazas">
                    <h4>Actividad más popular: <strong><?php echo $actividadPopular;?></strong> </h4>
                </div>
                <div class="num_plazas">
                  <h4>Actividades Individuales: <strong><?php echo $actividadIndividual;?></strong></h4>
                  <button onclick="mostrarInd()">ver</button>
                  <button onclick="cerrarInd()">cerrar</button>
                </div>
                <div class="num_plazas" id="ocultoI" style="display:none">
                    <?php
                        $arrayActividades = $acontroler->listarActividadesInd();
                        foreach ($arrayActividades as $actividad ){
                        ?>
                        <ul>
                            <div class="bloque_lista">
                                <p> <?php echo $actividad->getNombre(); ?><p>
                                <p>Horario: <?php echo $actividad->getHorario(); ?></p>
                                <p>Numero de plazas: <?php echo $actividad->getNumPlazas(); ?></p>
                                <p>Lugar: <?php echo $actividad->getLugar(); ?></p>
                            </div>
                        </ul>
                    <?php } ?>
                </div>
                <div class="num_plazas">
                    <h4>Actividades en grupo: <strong><?php echo $actividadGrupo;?></strong></h4>
                <button onclick="mostrarGrupo()">ver</button>
                <button onclick="cerrarGrupo()">cerrar</button>
                </div>
                <div class="num_plazas" id="ocultoG" style="display:none">
                    <?php
                        $arrayActividades = $acontroler->listarActividadesGrupo();
                        foreach ($arrayActividades as $actividad ){
                        ?>
                        <ul>
                           <div class="bloque_lista">
                                <p> <?php echo $actividad->getNombre(); ?><p>
                                <p>Horario: <?php echo $actividad->getHorario(); ?></p>
                                <p>Numero de plazas: <?php echo $actividad->getNumPlazas(); ?></p>
                                <p>Lugar: <?php echo $actividad->getLugar(); ?></p>
                            </div>
                         </ul>
                    <?php } ?>
                </div>
                <div class="num_plazas">
                  <h4>Actividades por tipo de deportista:</h4>
                  <h4>PEF: <strong><?php echo $actividadPEF;?></strong></h4> 
                    <button onclick="mostrarPEF()">ver</button>
                    <button onclick="cerrarPEF()">cerrar</button>
                    <div class="num_plazas" id="ocultoP" style="display:none">
                    <?php
                        $arrayActividades = $acontroler->listarActividadesPEF();
                        foreach ($arrayActividades as $actividad ){
                        ?>
                        <ul>
                            <div class="bloque_lista">
                                <p> <?php echo $actividad->getNombre(); ?><p>
                                <p>Horario: <?php echo $actividad->getHorario(); ?></p>
                                <p>Numero de plazas: <?php echo $actividad->getNumPlazas(); ?></p>
                                <p>Lugar: <?php echo $actividad->getLugar(); ?></p>
                            </div>
                         </ul>
                    <?php } ?>
                </div>
                  <h4>TDU: <strong><?php echo $actividadTDU;?></strong></h4>
                    <button onclick="mostrarTDU()">ver</button>
                    <button onclick="cerrarTDU()">cerrar</button>
                    <div class="num_plazas" id="ocultoT" style="display:none">
                    <?php
                        $arrayActividades = $acontroler->listarActividadesTDU();
                        foreach ($arrayActividades as $actividad ){
                        ?>
                        <ul>
                            <div class="bloque_lista">
                                <p> <?php echo $actividad->getNombre(); ?><p>
                                <p>Horario: <?php echo $actividad->getHorario(); ?></p>
                                <p>Numero de plazas: <?php echo $actividad->getNumPlazas(); ?></p>
                                <p>Lugar: <?php echo $actividad->getLugar(); ?></p>
                            </div>
                         </ul>
                    <?php } ?>
                </div>
                </div>
                <div class="num_plazas">
                  <h4>Total actividades: <strong><?php echo $numeroActividades;?></strong> </h4>
                </div>
                <div class="num_plazas">
                  <h4>Media de plazas: <strong><?php echo $numeroMedioPlazas;?></strong></h4>
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
