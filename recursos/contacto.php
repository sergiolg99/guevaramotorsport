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

$consulta = "SELECT `email`, `nombre`, `telefono` FROM `usuarios` WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($result);
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
  <!-- CSS para carrusel infinito -->
  <link rel="stylesheet" href="../css/infinite-slider.css" />
  <link rel="icon" type="image/png" href="./imagenes/logo.png" />
  <title>Guevara MotorSport: Taller & Biker Shop</title>
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
            <li class="nav-item">
              <a class="nav-link" href="motosOcasion.php">MOTOS DE OCASIÓN&nbsp;</a>
            </li>
            <li class="nav-item active">
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
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
          <form name="contacto" class="contacto" method="post" enctype="text/plain">
            <h3 class="h3">Envíanos un correo electrónico &#128394;</h3>
            <br>
            <div class="form-row">
              <div class="campoDatos">
                <input type="text" class="form-control datosContacto noFocus" id="inputName" placeholder="¿Como te llamas?" required value="<?php echo $fila["nombre"]; ?>">
              </div>
              <div class="campoDatos">
                <input type="email" class="form-control datosContacto noFocus" id="inputMail" placeholder="Correo electrónico" required value="<?php echo $fila["email"]; ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="campoDatos">
                <input type="tel" class="form-control datosContacto noFocus" id="inputPhone" placeholder="Nº de teléfono" maxlength="15" required value="<?php echo $fila["telefono"]; ?>">
              </div>
              <div class="campoDatos">
                <input type="text" class="form-control datosContacto noFocus" id="inputAsunto" placeholder="Asunto" required>
              </div>
            </div>
            <br>
            <div class="form-row" style="padding: 0 12px 8px 6px">
              <textarea name="descripcion" id="mensaje" cols="53" rows="8" maxlength="249" class="form-control datosContacto comentariosContacto noFocus" placeholder="Cuéntanos en detalle..." required></textarea>
            </div>
            <button onclick="enviarFormulario('<?php echo $id_usuario; ?>');" class="botonBonitoContacto">ENVIAR</button>
          </form>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
          <div id="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2965.2201380756032!2d-4.5118914331608595!3d41.995550881629015!2m3!1f0!2f0!3f0
        !3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47b1ca3937f617%3A0x7fa6f11d305233ff!2sCobarsa%20Volkswagen!5e0!3m2!1ses!2ses!4v1574166414522!5m2!1ses!2ses" width="100%" height="510px" frameborder="0" style="border-radius:15px;"></iframe>
          </div>
        </div>
      </div>
    </div>
    <br>
    <!-- Carrusel infinito de marcas -->
    <div class="container">
      <div class="slider customer-logos">
        <div class="slide noFocus">
          <img src="imagenes/logos/Honda.png" alt="Logo Honda" />
        </div>
        <div class="slide noFocus">
          <img src="imagenes/logos/Kawasaki.png" alt="Logo Kawasaki" />
        </div>
        <div class="slide noFocus">
          <img src="imagenes/logos/Suzuki.png" alt="Logo Suzuki" />
        </div>
        <div class="slide noFocus">
          <img src="imagenes/logos/Yamaha.png" alt="Logo Yamaha" />
        </div>
        <div class="slide noFocus">
          <img src="imagenes/logos/Kymco.png" alt="Logo Kymco" />
        </div>
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
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ya te marchas?</h5>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script>
  <script src="../js/funciones.js"></script>
  <script>
    $(document).ready(function() {
      if ($('#inputName').val() != "") {
        $("#inputName").prop('disabled', true);
      }
      if ($('#inputPhone').val() != "") {
        $("#inputPhone").prop('disabled', true);
      }
      if ($('#inputMail').val() != "") {
        $("#inputMail").prop('disabled', true);
      }
    });
  </script>
</body>

</html>