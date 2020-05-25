<?php
require_once('admin/recursos/conexionBD.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['usuario'])) {
  $showUser = "style='display: none'";
  $showLogin = "style='';";
} else {
  $showUser = "style='';";
  $showLogin = "style='display: none'";
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id_usuario'];
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
  <link rel="stylesheet" href="css/estilos.css" />
  <!-- CSS para carrusel infinito -->
  <link rel="stylesheet" href="css/infinite-slider.css" />
  <link rel="icon" type="image/png" href="./recursos/imagenes/logo.png" />
  <title>Guevara MotorSport: Taller & Biker Shop</title>
</head>

<body class="fondo">
  <!-- Cabecera web -->
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light h5" style="background-color: white;">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Logo empresa -->
        <a class="navbar-brand justify-content-center" href="index.php"><img src="./recursos/imagenes/logoTransparente.png" class="mobile agrandar" style="width: 110px;" alt="Logo empresa"></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">INICIO&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./recursos/taller.php">RESERVAR CITA&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./recursos/tienda.php">TIENDA&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./recursos/motosOcasion.php">MOTOS DE OCASIÓN&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./recursos/contacto.php">CONTACTAR&nbsp;</a>
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
                <a class="dropdown-item usuarioDropdown" href="recursos/misDatos.php">MIS DATOS</a>
                <a class="dropdown-item usuarioDropdown" href="recursos/citas.php">CITAS TALLER</a>
                <a class="dropdown-item usuarioDropdown" href="recursos/misPedidos.php">PEDIDOS</a>
                <a class="dropdown-item usuarioDropdown" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                  CERRAR SESIÓN
                </a>
              </div>
            </li>
          </ul>
          <a class="navbar-brand" href="./recursos/carrito.php"><img src="./recursos/imagenes/carrito.png" class="mobile agrandar" style="width: 40px;" alt="Imagen carrito"></a>
        </div>
      </div>
    </nav>
  </header>

  <!-- INICIO PÁGINA -->

  <!-- Carrusel de imágenes -->
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./recursos/imagenes/imagen4.jpg" class="d-block w-100" alt="Tienda de productos para el motorista">
        <div class="carousel-caption d-none d-md-block">
          <h2>
            <span style="color: white; font-style: italic; font-weight: bold;">TU TALLER DE MOTOS EN PALENCIA</span>
          </h2>
          <br>
          <a class="btn btn-lg bonito" href="recursos/tienda.php">COMPRAR PRODUCTOS</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./recursos/imagenes/imagen2.jpg" class="d-block w-100" alt="Zona de taller para motos">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="h2">
            <span style="color: white; width: fit-content; font-style: italic;">TALLER ESPECIALIZADO, <br> TU MOTO AL
              DETALLE</span>
          </h2>
          <br>
          <a class="btn btn-lg bonito" href="recursos/taller.php">PIDE CITA YA</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="./recursos/imagenes/imagen3.jpg" class="d-block w-100" alt="Colección de motos de ocasión">
        <div class="header-text d-none d-md-block text-left">
          <h3>
            <span style="color: white; font-style: italic;">CONSULTA NUESTRO CATÁLOGO DE MOTOS DE OCASIÓN</span>
          </h3>
          <br>
          <a class="btn btn-lg bonito" href="#">MOTOS DE OCASIÓN</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Carrusel infinito de marcas -->
  <div class="container">
    <div class="slider customer-logos">
      <div class="slide noFocus">
        <img src="recursos/imagenes/logos/Honda.png" alt="Logo Honda" />
      </div>
      <div class="slide noFocus">
        <img src="recursos/imagenes/logos/Kawasaki.png" alt="Logo Kawasaki" />
      </div>
      <div class="slide noFocus">
        <img src="recursos/imagenes/logos/Suzuki.png" alt="Logo Suzuki" />
      </div>
      <div class="slide noFocus">
        <img src="recursos/imagenes/logos/Yamaha.png" alt="Logo Yamaha" />
      </div>
      <div class="slide noFocus">
        <img src="recursos/imagenes/logos/Kymco.png" alt="Logo Kymco" />
      </div>
    </div>
  </div>

  <br>

  <div class="container">
    <h1 class="titulo">
      <span style="color: red; font-style: italic;">GUEVARA MOTORSPORT</span>, TU CENTRO INTEGRAL DE
      MOTOCICLISMO EN PALENCIA
    </h1>
  </div>

  <br>

  <div class="container">
    <h2 class="texto">
      <span style="color: red; font-style: italic;">Guevara MotorSport</span> no es solo un taller
      multimarca, es tu centro de referencia en Palencia.<br><br>
      Equipación para ti y para tu moto. Un servicio profesional que te asesorará en todo momento para
      que
      disfrutes de tu pasión igual que lo hacemos nosotros.<br><br>
      Ofrecemos a nuestros clientes un lugar donde pueden encontar tanto <u>motos</u>, como
      <u>accesorios para las motos</u> y <u>para el piloto</u>.<br><br>
      Disponemos de un taller especializado en todas las marcas y con garantías oficiales. Disponemos de
      herramienta especializada de última generación para
      realizar un trabajo profesional. <br><br>
      Te llevamos el <u>mantenimiento de tu moto, sus revisiones, etc.</u><br><br>
      En <span style="color: red; font-style: italic;">Guevara MotorSport</span> siempre mantenemos un
      trato cercano y personalizado con nuestros clientes, para que en cualquier momento sepan como va el
      trabajo que se realiza a su moto.
    </h2>
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
                <div id="response"></div>
              </div>
              <!--Footer-->
              <div class="modal-footer">
                <div class="options text-center text-md-right mt-1">
                  <p>No estás registrado? <a href="#tabRegister" class="blue-text" data-toggle="tab">Regístrate</a>
                  </p>
                  <p>He olvidado la <a href="#" class="blue-text">Contraseña</a></p>
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
                <div id="response"></div>
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

  <!-- FOOTER PÁGINA -->
  <div id="cajaContacto">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <em class="fas fa-phone-alt"></em> Teléfono: <a href="tel:+34634473757" style="color:white;" title="Llamar por teléfono">666 66 66
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
            Excepto donde se indique lo contrario, el contenido de este sitio está licenciado bajo una
            licencia Creative Commons <em class="fab fa-creative-commons"></em> Attribution 4.0 International
            <br>
            Copyright&copy; 2020 Guevara MotorSport. Todos los derechos reservados
          </div>
        </div>
      </div>
      <br>
      <a class="btn btn-sm admin" href="admin/administrar.php">ADMINISTRAR</a>
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
        <div class="modal-body">Selecciona "Cerrar Sesión" si estas listo para terminar tu sesión actual</div>
        <br>
        <div class="modal-footer">
          <button class="btn" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="admin/recursos/salir.php?action=cliente">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <button class="back-to-top" id="back-to-top"></button>

  <!-- SCRIPTS JAVASCRIPT -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script>
  <script src="js/funciones.js"></script>
  <script>
    function inicioSesion() {
      let email = $('#inputEmailLogin').val();
      let contrasenna = $('#inputPasswordLogin').val();
      var data = {
        email: email,
        contrasenna: contrasenna
      };

      $.ajax({
        url: "admin/recursos/verificar.php?action=cliente",
        type: "POST",
        dataType: "HTML",
        data: data,
        cache: false,

      }).done(function(echo) {
        if (echo !== "") {
          $("#response").html(echo);
        } else {
          // window.location.replace("");
          window.location.replace("");
        }
      });
    }

    function registrarse() {
      let email = $('#inputEmailRegister').val();
      let password = $('#inputPasswordRegister1').val();
      let password2 = $('#inputPasswordRegister2').val();

      if (password == password2) {
        var data = {
          email: email,
          password: password
        };

        $.ajax({
          url: "admin/users/createUser.php?action=cliente",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {
          if (echo == "exito") {
            alert("Usuario creado con éxito");
            var data1 = {
              email: email,
              contrasenna: password
            };

            $.ajax({
              url: "admin/recursos/verificar.php?action=cliente",
              type: "POST",
              dataType: "HTML",
              data: data1,
              cache: false,

            }).done(function(echo) {
              if (echo !== "") {
                $("#response").html(echo);
              } else {
                window.location.replace("");
              }
            });
          } else if (echo == "existe") {
            alert("Este usuario ya existe");
          } else {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      } else {
        $("#response").text("Las contraseñas no son iguales");
      }
    }
  </script>

</body>

</html>