<?php
if(!isset($_SESSION)) session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Index  - Ufitness</title>

    <link href="css/style.css" rel="stylesheet">

    <link href="css/carousel.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a class="navbar-logo" href="index.html"><img class="img-logo" src="img/logo.png" alt="logo"/></a>
            </div>
            <!-- Top Menu Items -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Log In <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center"><h3><b>Log In</b></h3></div>
                                    <div class="form-group">
                                      <form action="../controller/controlador.php?controlador=controlador_Usuario&accion=login" method="post">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" autocomplete="off">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" autocomplete="off">
                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-success" value="Log In">
                                      </form>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="checkbox" tabindex="3" name="remember" id="remember">
                                                <label for="remember"> Remember Me</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a tabindex="5" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6">
                            </div>
                        </ul>
                    </li>
                </ul>
        </nav>
    </div>

    <div>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
            <li class="" data-target="#myCarousel" data-slide-to="1"></li>
            <li class="" data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="item active item-1">
                <img class="img-rounded img-responsive body-img" src="img/correr.jpg" alt="imagen corriendo"/>
              <div class="container">
                <div class="carousel-caption">
                  <h1>Unete</h1>
                  <p>Accede a la web con contenidos deportivos de todo tipo</p>
                  <a href="#about" class="btn btn-circle page-scroll">
                  </a>
                </div>
              </div>
            </div>
            <div class="item item-2">
                <img class="img-rounded img-responsive body-img" src="img/pabellon.jpg" alt="pabellon"/>
              <div class="container">
                <div class="carousel-caption">
                  <h1>Visita nuestras instalaciones</h1>
                  <a href="#about" class="btn btn-circle page-scroll">
                  </a>
                </div>
              </div>
            </div>
            <div class="item item-3">
                <img class="img-rounded img-responsive body-img" src="img/instalaciones.jpg" alt="instalaciones pabellon"/>
              <div class="container">
                <div class="carousel-caption">
                  <h1>¿A qué esperas?</h1>
                  <p>Vente</p>
                  <a href="#about" class="btn btn-circle page-scroll">
                  </a>
                </div>
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>

    <iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1432.5318683749404!2d-7.851455647052176!3d42.3421717493788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ffebfc4e9e631%3A0x8a96205e37b805b4!2sPolideportivo+Universitario%2C+%E2%9B%89+Campus+As+Lagoas%2C+4.%C2%BA+piso%2C+32004+Orense%2C+Ourense!5e0!3m2!1ses!2ses!4v1478299773129" frameborder="0" style="border:0" allowfullscreen></iframe>

    <div class="container">
      <footer class="bg-white">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>© 2016 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



</body>


</html>
