<?php
require_once('../admin/recursos/conexionBD.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['estado'])) {
  $showUser = "style='display: none'";
  $showLogin = "style='';";
} else {
  $showUser = "style='';";
  $showLogin = "style='display: none'";
  $id_usuario = $_SESSION['id_usuario'];
  $usuario = $_SESSION['usuario'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- BootStrap y FontAwesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- CSS para modal Inicio Sesión-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.13.0/css/mdb.min.css" rel="stylesheet">
  <!-- CSS Propio -->
  <link rel="stylesheet" href="../css/estilos.min.css" />
  <link rel="icon" type="image/png" href="./imagenes/logo.png" />
  <title>Guevara MotorSport: Taller & Biker Shop</title>
  <style type="text/css">
    .spinner {
      background-color: transparent;
      transform: translateZ(0);
      animation-iteration-count: infinite;
      animation-timing-function: linear;
      animation-duration: .9s;
      animation-name: spinner-loading
    }

    @keyframes spinner-loading {
      0% {
        transform: rotate(0deg)
      }

      to {
        transform: rotate(1turn)
      }
    }
  </style>
</head>

<body class="fondoLiso">
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light h5" style="background-color: white;">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand justify-content-center" href="../index.php"><img src="./imagenes/logoTransparente.png" class="mobile agrandar" style="width: 110px;" alt="Logo empresa"></a>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">INICIO&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="taller.php">RESERVAR CITA&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tienda.php">TIENDA&nbsp;</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="motosOcasion.php">MOTOS DE OCASIÓN&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.php">CONTACTAR&nbsp;</a>
            </li>
            <li class="nav-item" id="iniciarSesion" <?php print($showLogin) ?>>
              <a class="nav-link" data-toggle="modal" data-target="#inicioSesion">
                <strong class="fas fa-sign-in-alt"></strong>&nbsp;INICIAR SESIÓN</a>
            </li>
            <!-- Botón Usuario -->
            <li class="nav-item dropdown" id="usuario" <?php print($showUser) ?>>
              <a class="nav-link dropdown-toggle noFocus" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                <i class="fas fa-user-circle"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: white; border: none;">
                <a class="dropdown-item usuarioDropdown" href="misDatos.php">MIS DATOS</a>
                <a class="dropdown-item usuarioDropdown" href="citas.php">CITAS TALLER</a>
                <a class="dropdown-item usuarioDropdown" href="misPedidos.php">PEDIDOS</a>
                <a class="dropdown-item usuarioDropdown" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                  CERRAR SESIÓN
                </a>
              </div>
            </li>
          </ul>
          <a class="navbar-brand" href="carrito.php"><img src="./imagenes/carrito.png" class="mobile agrandar" style="width: 40px;" alt="Imagen carrito"></a>
        </div>
      </div>
    </nav>
  </header>



  <div id="main">
    <div class="container">
      <br><br>
      <div class="row">
        <h1 class="titulo">Página en progreso, disculpen las molestias. <span class="fas fa-spinner spinner"></span></h1>
      </div>
    </div>
    <br><br>
    <div class="container">
      <h3 class="texto">
        En <span style="color: red; font-style: italic;">Guevara MotorSport</span> nos orgullecemos del trabajo que estamos realizando.
        Aun así, somos conscientes de que nos queda un largo camino por recorrer, y esta página es reflejo de ello.<br><br>
        Nuestra sección dedicada a las motos de ocasión es nuestro siguiente gran paso para convertirnos en un referente entre los talleres y tiendas
        dedicadas al mundo de la moto.<br><br>
        En cuanto esté disponible la nueva sección, serán los primeros en enterarse. Muchas gracias.
      </h3>
    </div>

    <!--Modal: Inicio sesion / registrarse -->
    <div class="modal fade" id="inicioSesion" tabindex="0" role="dialog" aria-hidden="true">
      <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content form-elegant">
          <!--Modal cascading tabs-->
          <div class="modal-c-tabs">
            <!-- Pestañas -->
            <ul class="nav nav-tabs md-tabs tabs-2 red darken-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabLogin" role="tab"><strong class="fas fa-user mr-1"></strong>
                  INICIAR SESIÓN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabRegister" role="tab"><strong class="fas fa-user-plus mr-1"></strong>
                  REGISTRARSE</a>
              </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
              <!--Panel Login-->
              <div class="tab-pane fade in show active" id="tabLogin" role="tabpanel">
                <!--Body-->
                <div class="modal-body mb-1">
                  <div class="md-form form-sm mb-5">
                    <a class="fas fa-envelope prefix"></a>
                    <input type="email" id="inputEmailLogin" class="form-control form-control-sm validate">
                    <label data-error="Incorrecto" data-success="Correcto" for="inputEmailLogin">CORREO
                      ELECTRÓNICO</label>
                  </div>
                  <div class="md-form form-sm mb-4">
                    <a class="fas fa-lock prefix"></a>
                    <input type="password" id="inputPasswordLogin" class="form-control form-control-sm">
                    <label data-error="Incorrecto" data-success="Correcto" for="inputPasswordLogin">CONTRASEÑA</label>
                  </div>
                  <div class="text-center mt-2">
                    <button class="btn btn-info" onclick="inicioSesion()">INICIAR SESIÓN </button>
                  </div>
                  <div class="response"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-center text-md-left mt-1">
                    <p>No estás registrado? <a href="#tabRegister" class="blue-text" data-toggle="tab">Regístrate</a>
                    </p>
                    <p>He olvidado la <a href="#" class="blue-text">Contraseña</a> (en desarrollo).</p>
                  </div>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
              <!--/.Panel Login-->

              <!--Panel Registro-->
              <div class="tab-pane fade" id="tabRegister" role="tabpanel">
                <!--Body-->
                <div class="modal-body">
                  <div class="md-form form-sm mb-5">
                    <a class="fas fa-envelope prefix"></a>
                    <input type="email" id="inputEmailRegister" class="form-control form-control-sm validate">
                    <label data-error="Incorrecto" data-success="Correcto" for="inputEmailRegister">CORREO
                      ELECTRÓNICO</label>
                  </div>
                  <div class="md-form form-sm mb-5">
                    <a class="fas fa-lock prefix"></a>
                    <input type="password" id="inputPasswordRegister1" class="form-control form-control-sm">
                    <label data-error="Incorrecto" data-success="Correcto" for="inputPasswordRegister1">CONTRASEÑA</label>
                  </div>
                  <div class="md-form form-sm mb-4">
                    <a class="fas fa-lock prefix"></a>
                    <input type="password" id="inputPasswordRegister2" class="form-control form-control-sm">
                    <label data-error="Incorrecto" data-success="Correcto" for="inputPasswordRegister2">REPITA LA
                      CONTRASEÑA</label>
                  </div>
                  <div class="text-center form-sm mt-2">
                    <button class="btn btn-info" onclick="registrarse()">REGISTRARSE </button>
                  </div>
                  <div class="response"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-right">
                    <p class="pt-1">Ya tienes una cuenta? <a data-toggle="tab" href="#tabLogin" class="blue-text">Inicia
                        Sesión</a></p>
                  </div>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
              <!--/.Panel Registro-->
            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>

    <br><br>

    <div id="cajaContacto">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <i class="fas fa-phone-alt"></i> Teléfono: <a href="tel:+34634473757" style="color:white;" title="Llamar por teléfono">666 66 66
              66</a>
          </div>
          <br>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            &#9993; Email: <a href="mailto:sergiolg_99@hotmail.com?Subject=Contacto%20desde%20la%20pagina%20web" style="color:white;" title="Enviar correo">info@guevaramotorsport.com</a>
          </div>
        </div>
        <hr>
        <div class="row copy">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="copyright">
              Excepto donde se indique lo contrario, el contenido de este sitio está licenciado bajo
              una licencia Creative Commons <i class="fab fa-creative-commons"></i> Attribution 4.0 International
              <br>
              Copyright&copy; 2020 Guevara MotorSport. Todos los derechos reservados</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Ya te marchas?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Cerrar Sesión" si estas listo para terminar tu sesión actual.</div>
        <div class="modal-footer">
          <button class="btn" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../admin/recursos/salir.php?action=cliente">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <button class="back-to-top" id="back-to-top"></button>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script>
  <script src="../js/funciones.js"></script>
</body>

</html>