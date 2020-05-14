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
    <link rel="icon" type="image/png" href="imagenes/logo.png" />
    <title>Guevara MotorSport: Taller & Biker Shop</title>
  </head>

  <body class="fondoLiso">
    <header class="sticky-top">
      <nav class="navbar navbar-expand-lg navbar-light h5" style="background-color: white;">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand justify-content-center" href="../index.html"><img src="./imagenes/logoTransparente.png"
              class="mobile agrandar" style="width: 110px;" alt="Logo empresa"></a>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="../index.html">INICIO&nbsp;</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="taller.html">RESERVAR CITA&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="tienda.html">TIENDA&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index.html">MOTOS DE OCASIÓN&nbsp;</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contacto.html">CONTACTAR&nbsp;</a>
              </li>
              <li class="nav-item" id="iniciarSesion">
                <a class="nav-link" data-toggle="modal" data-target="#inicioSesion"><i
                    class="fas fa-sign-in-alt"></i>&nbsp;INICIAR SESIÓN</a>
              </li>
              <li class="nav-item dropdown" id="usuario" hidden>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                  style="background-color: white; border: none;">
                  <a class="dropdown-item" href="#" style="color: black">MIS DATOS</a>
                  <a class="dropdown-item" href="#" style="color: black">PEDIDOS</a>
                  <a class="dropdown-item" href="#" style="color: black">CERRAR SESIÓN</a>
                </div>
              </li>
            </ul>
            <a class="navbar-brand" href="carrito.html"><img src="./imagenes/carrito.png" class="mobile agrandar"
                style="width: 40px;" alt="Imagen carrito"></a>
          </div>
        </div>
      </nav>
    </header>



    <div id="main">
      <div id="container">
        <form name="cita" class="reserva" method="POST" enctype="text/plain">
          <div class="row">
            <h2 id="titulo">Solicitud de cita previa &#128394;</h2>
          </div>

          <br>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div id="moto">
                <fieldset class="fieldsetTaller">
                  <legend>Datos de la moto</legend>
                  <label>Marca:</label>
                  <select name="marca" id="marca" class="selectMarca">
                    <option selected> Marca
                    <option value="honda">Honda
                    <option value="yamaha">Yamaha
                    <option value="kawasaki">Kawasaki
                    <option value="ducati">Ducati
                    <option value="triumph">Triumph
                    <option value="suzuki">Suzuki
                    <option value="aprilia">Aprilia
                  </select>

                  <br><br>

                  <label>Modelo:</label>
                  <input type="text" name="modelo" class="datosReserva noFocus" placeholder="Modelo">

                  <br><br>

                  <label>Año:</label>
                  <select name="año" id="anno" class="datosReserva noFocus">
                    <option value="0">Selecciona...</option>
                  </select>
                </fieldset>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div id="datosPersonales">
                <fieldset class="fieldsetTaller">
                  <legend>Datos Personales</legend>
                  <label>Nombre completo:</label>
                  <input type="text" name="nombre" class="datosReserva noFocus" value="" size="26"
                    placeholder="Nombre y apellidos" />

                  <br><br>

                  <label>Teléfono de contacto:</label>
                  <input type="tel" name="telefono" class="datosReserva noFocus" value="" maxlength="9"
                    placeholder="Número de movil" />

                  <br><br>

                  <label>Email:</label>
                  <input type="email" name="email1" class="datosReserva noFocus" value="" size="25"
                    placeholder="example@correo.com" />
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
                  <input type="date" id="fecha" name="fecha" class="datosReserva noFocus">
                  <br><br>
                  <label>Hora:</label>
                  <input type="time" id="hora" name="hora" class="datosReserva noFocus">
                </fieldset>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div id="comentariosTaller">
                <label>Comentarios:</label>
                <textarea name="comentarios" class="comentariosReserva noFocus" rows="8"
                  placeholder="Escriba aquí sus peticiones y comentarios"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="botonesTaller">
              <button onclick="funcionReset()" class="botonBonitoTaller">RESETEAR</button>
              <button onclick="comprobarEnviar()" class="botonBonitoTaller enviarTaller">ENVIAR</button>
            </div>
          </div>
        </form>

        <br>

        <div id="cajaContacto">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <i class="fas fa-phone-alt"></i> Teléfono: <a href="tel:+34634473757" style="color:white;"
                  title="Llamar por teléfono">666 66
                  66
                  66</a>
              </div>
              <br>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                &#9993; Email: <a href="mailto:sergiolg_99@hotmail.com?Subject=Contacto%20desde%20la%20pagina%20web"
                  style="color:white;" title="Enviar correo">info@guevaramotorsport.com</a>
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
      <div class="modal fade" id="inicioSesion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
          <!--Content-->
          <div class="modal-content form-elegant">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

              <!-- Pestañas -->
              <ul class="nav nav-tabs md-tabs tabs-2 red darken-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tabLogin" role="tab"><i
                      class="fas fa-user mr-1"></i>
                    INICIAR SESIÓN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tabRegister" role="tab"><i
                      class="fas fa-user-plus mr-1"></i>
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
                      <input type="email" id="modalLRInput10" class="form-control form-control-sm validate">
                      <label data-error="Incorrecto" data-success="Correcto" for="modalLRInput10">CORREO
                        ELECTRÓNICO</label>
                    </div>

                    <div class="md-form form-sm mb-4">
                      <a class="fas fa-lock prefix"></a>
                      <input type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                      <label data-error="Incorrecto" data-success="Correcto" for="modalLRInput11">CONTRASEÑA</label>
                    </div>
                    <div class="text-center mt-2">
                      <button class="btn btn-info">INICIAR SESIÓN </button>
                    </div>
                  </div>
                  <!--Footer-->
                  <div class="modal-footer">
                    <div class="options text-center text-md-right mt-1">
                      <p>No estás registrado? <a href="#tabRegister" class="blue-text" data-toggle="tab">Regístrate</a>
                      </p>
                      <p>He olvidado la <a href="#" class="blue-text">Contraseña</a></p>
                    </div>
                    <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                      data-dismiss="modal">Cerrar</button>
                  </div>

                </div>
                <!--/.Panel Login-->

                <!--Panel Registro-->
                <div class="tab-pane fade" id="tabRegister" role="tabpanel">

                  <!--Body-->
                  <div class="modal-body">
                    <div class="md-form form-sm mb-5">
                      <a class="fas fa-envelope prefix"></a>
                      <input type="email" id="modalLRInput12" class="form-control form-control-sm validate">
                      <label data-error="Incorrecto" data-success="Correcto" for="modalLRInput12">CORREO
                        ELECTRÓNICO</label>
                    </div>

                    <div class="md-form form-sm mb-5">
                      <a class="fas fa-lock prefix"></a>
                      <input type="password" id="modalLRInput13" class="form-control form-control-sm validate">
                      <label data-error="Incorrecto" data-success="Correcto" for="modalLRInput13">CONTRASEÑA</label>
                    </div>

                    <div class="md-form form-sm mb-4">
                      <a class="fas fa-lock prefix"></a>
                      <input type="password" id="modalLRInput14" class="form-control form-control-sm validate">
                      <label data-error="Incorrecto" data-success="Correcto" for="modalLRInput14">REPITA LA
                        CONTRASEÑA</label>
                    </div>

                    <div class="text-center form-sm mt-2">
                      <button class="btn btn-info">REGISTRARSE </button>
                    </div>

                  </div>
                  <!--Footer-->
                  <div class="modal-footer">
                    <div class="options text-right">
                      <p class="pt-1">Ya tienes una cuenta? <a data-toggle="tab" href="#tabLogin"
                          class="blue-text">Inicia
                          Sesión</a></p>
                    </div>
                    <button type="button" class="btn btn-outline-info waves-effect ml-auto"
                      data-dismiss="modal">Cerrar</button>
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

    <button class="back-to-top" id="back-to-top"></button>


    <script>
      function ComboAno() {
        var n = (new Date()).getFullYear()
        var select = document.getElementById("anno");
        for (var i = n; i >= 1950; i--) select.options.add(new Option(i, i));
      };
      window.onload = ComboAno;
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.12.0/js/mdb.min.js"></script>
    <script src="../js/funciones.js"></script>
  </body>

</html>