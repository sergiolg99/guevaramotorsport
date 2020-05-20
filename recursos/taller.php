<?php
require_once('../admin/recursos/conexionBD.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['estado'])) {
  $showUser = "style='display: none'";
  $showLogin = "style='';";
  $usuario = "";
} else {
  $showUser = "style='';";
  $showLogin = "style='display: none'";
  $id_usuario = $_SESSION['id_usuario'];
  $usuario = $_SESSION['usuario'];
}

$consulta = "SELECT `email`, `nombre`, `apellidos`, `telefono` FROM `usuarios` WHERE id_usuario = '$id_usuario'";
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
  <link rel="stylesheet" href="../css/estilos.css" />
  <link rel="icon" type="image/png" href="imagenes/logo.png" />
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
            <li class="nav-item active">
              <a class="nav-link" href="taller.php">RESERVAR CITA&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tienda.php">TIENDA&nbsp;</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">MOTOS DE OCASIÓN&nbsp;</a>
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
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                <i class="fas fa-user-circle"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: white; border: none;">
                <a class="dropdown-item usuarioDropdown" href="misDatos.php" style="color: black">MIS DATOS</a>
                <a class="dropdown-item usuarioDropdown" href="citas.php">CITAS TALLER</a>
                <a class="dropdown-item usuarioDropdown" style="color: black">PEDIDOS</a>
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
    <div id="container">
      <form name="cita" id="cita" class="reserva" method="POST" enctype="text/plain">
        <div class="row">
          <h2 id="titulo">Solicitud de cita previa <i class="fas fa-clipboard-list"></i></h2>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div id="">
              <fieldset class="fieldsetTaller">
                <legend>Datos de la moto</legend>
                <?php
                if (isset($_SESSION['usuario'])) {
                  echo '<div class="custom-control custom-radio custom-control-inline">
                        <input class="custom-control-input" type="radio" name="selectMotoOptions" id="motoPropiaRadio" value="motoPropia">
                        <label class="custom-control-label" for="motoPropiaRadio">Seleccionar desde tus vehículos</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input class="custom-control-input" type="radio" name="selectMotoOptions" id="otraMotoRadio" value="otraMoto">
                        <label class="custom-control-label" for="otraMotoRadio">Seleccionar otra moto</label>
                      </div> <br><br>';
                }
                ?>
                <div id="otraMoto" <?php if (isset($_SESSION['usuario'])) {
                                      echo 'style="display: none";';
                                    } ?>>
                  <label>Marca:</label>
                  <select name="fabricante" id="fabricante" class="selectMarca"></select>
                  <br><br>
                  <label>Modelo:</label>
                  <select name="modelo" id="modelo" class="selectMarca">
                    <option value="0">Esperando...</option>
                  </select>
                  <br><br>
                  <label>Cilindrada:</label>
                  <select name="cilindrada" id="cilindrada" class="selectMarca" required>
                    <option value="0">Esperando...</option>
                  </select>
                </div>
                <div id="motoPropia" style="display: none">
                  <label>Selecciona tu moto:</label>
                  <select name="moto" id="moto" class="selectMarca " required>
                    <option value="0">Selecciona tu moto...</option>
                    <?php
                    $query = "SELECT moto_models.nombre, motos_usuarios.matricula, motos.id_moto FROM motos_usuarios 
                    INNER JOIN motos on motos_usuarios.id_moto = motos.id_moto
                    INNER JOIN moto_models on motos.modelo = moto_models.id 
                    WHERE motos_usuarios.id_usuario = $id_usuario";
                    $resultado = mysqli_query($conexion, $query);
                    while ($datos = mysqli_fetch_array($resultado)) {
                      echo '<option value="' . $datos['id_moto'] . '">' . $datos['nombre']  . " / " . $datos['matricula'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </fieldset>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div id="datosPersonales">
              <fieldset class="fieldsetTaller">
                <legend>Datos Personales</legend>
                <label>Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="datosReserva noFocus" placeholder="Nombre" value="<?php echo $fila["nombre"]; ?>" required>
                <br><br>
                <label>Teléfono de contacto:</label>
                <input type="tel" name="telefono" id="telefono" class="datosReserva noFocus" maxlength="9" placeholder="Número de movil" required value="<?php echo $fila["telefono"]; ?>">
                <br><br>
                <label>Email:</label>
                <input type="email" name="email" id="email" class="datosReserva noFocus" placeholder="Correo electrónico" value="<?php echo $fila["email"]; ?>">
              </fieldset>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div id="datosCita">
              <fieldset class="fieldsetTaller">
                <legend>Datos de la cita</legend>
                <label>Día de la cita:</label>
                <input type="date" id="fecha" name="fecha" placeholder="Elige un día para la cita" class="datosReserva noFocus" 
                  min="<?php echo date("Y-m-d"); ?>" max="<?php $date = new DateTime('+2 month');echo $date->format('Y-m-d'); ?>" 
                  value="<?php echo date("Y-m-d"); ?>" required>
                <br><br>
                <label>Hora:</label>
                <input type="time" id="hora" name="hora" class="datosReserva noFocus" min="08:30" max="20:00" step="900">
              </fieldset>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div id="comentariosTaller">
              <label>A realizar:</label>
              <textarea name="comentarios" id="comentarios" class="comentariosReserva noFocus" rows="8" maxlength="249" placeholder="Escriba aquí las tareas a realizar"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div id="botonesTaller">
            <button type="reset" class="botonBonitoTaller">RESETEAR</button>
            <button type="submit" class="botonBonitoTaller enviarTaller">ENVIAR</button>
          </div>
        </div>
      </form>

      <br>

      <div id="cajaContacto">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <i class="fas fa-phone-alt"></i> Teléfono: <a href="tel:+34634473757" style="color:white;" title="Llamar por teléfono">666 66
                66
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
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script>
  <script src="../js/funciones.js"></script>
  <script>
    $(document).ready(function() {
      if ($('#nombre').val() != "") {
        $("#nombre").prop('disabled', true);
      }
      if ($('#telefono').val() != "") {
        $("#telefono").prop('disabled', true);
      }
      if ($('#email').val() != "") {
        $("#email").prop('disabled', true);
      }

      $('input:radio[name="selectMotoOptions"]').change(
        function() {
          if (this.checked && this.value == 'motoPropia') {
            $("#motoPropia").css("display", "");
            $("#otraMoto").css("display", "none");
          } else if (this.checked && this.value == 'otraMoto') {
            $("#motoPropia").css("display", "none");
            $("#otraMoto").css("display", "");
          }
        }
      );

      $.ajax({
        type: "POST",
        url: "../admin/vehicles/getMarcasMotos.php",
        success: function(response) {
          $('#fabricante').html(response).fadeIn();
        }
      });

      $("#fabricante").change(function() {
        fabricante = $('#fabricante').val();
        $.ajax({
          type: "POST",
          data: "fabricante=" + fabricante,
          url: "../admin/vehicles/getModelosMotos.php",
          success: function(response) {
            $('#modelo').html(response).fadeIn();
          }
        });
      });

      $("#modelo").change(function() {
        modelo = $('#modelo').val();
        $.ajax({
          type: "POST",
          data: "modelo=" + modelo,
          url: "../admin/vehicles/getCilindradaMotos.php",
          success: function(response) {
            $('#cilindrada').html(response).fadeIn();
          }
        });
      });
    });

    $("#cita").on("submit", function(e) {
      e.preventDefault();
      id_usuario = "<?php echo $_SESSION['id_usuario']; ?>";
      comentarios = $('#comentarios').val();
      fecha = $('#fecha').val() + " " + $('#hora').val() + ":00";
      nombre = $('#nombre').val();
      telefono = $('#telefono').val();
      email = $('#email').val();

      if (id_usuario != "") {
        tipoUser = "cliente";
      } else {
        tipoUser = "visitante"
      }
      if ($('#cilindrada').val() == "0") {
        moto = $('#moto').val();
      } else {
        moto = $('#cilindrada').val();
      }

      if (moto == "0") {
        alert("Selecciona una moto");
      } else {
        data = {
          tipoUser: tipoUser,
          moto: moto,
          id_usuario: id_usuario,
          nombre: nombre,
          telefono: telefono,
          email: email,
          comentarios: comentarios,
          fecha: fecha
        };

        $.ajax({
          url: "../admin/tasks/crearCita.php",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {
          if (echo == "exito") {
            alert("Cita concertada con éxito");
            window.location.replace("../index.php");
          } else {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      }
    });
  </script>
</body>

</html>