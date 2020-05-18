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
    $estado = $_SESSION['estado'];
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
    <!-- CSS Propio -->
    <link rel="stylesheet" href="../css/estilos.css" />
    <link rel="icon" type="image/png" href="imagenes/logo.png" />
    <title>Guevara MotorSport: Taller & Biker Shop</title>
</head>

<body onload="precio()" class="fondo">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light h5" style="background-color: white;">
            <div class="container">
                <button class="navbar-toggler noFocus" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link" href="../index.php">MOTOS DE OCASIÓN&nbsp;</a>
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
                                <a class="dropdown-item usuarioDropdown" style="color: black">MIS DATOS</a>
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


    <div class="container">
        <div class="checkout">
            <div class="credit-card-box">
                <div class="flip">
                    <div class="front">
                        <div class="chip"></div>
                        <div class="logo">
                            <svg version="1.1" id="visa_front" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z" />
                            </svg>
                        </div>
                        <div class="number"></div>
                        <div class="card-holder">
                            <label>TITULAR</label>
                            <div></div>
                        </div>
                        <div class="card-expiration-date">
                            <label>VALIDA HASTA</label>
                            <div></div>
                        </div>
                    </div>
                    <div class="back">
                        <div class="strip"></div>
                        <div class="logo">
                            <svg version="1.1" id="visa_back" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                               c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                               c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                               M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                               c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                               c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                               l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                               C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                               C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                               c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                               h-3.888L19.153,16.8z" />
                            </svg>
                        </div>
                        <div class="ccv">
                            <label>CCV</label>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>

            <form class="form">
                <fieldset>
                    <label for="card-number">NÚMERO TARJETA</label>
                    <div class="row justify-content-center">
                        <input type="text" id="card-number" class="input-cart-number" maxlength="4" required />
                        <input type="text" id="card-number-1" class="input-cart-number" maxlength="4" required />
                        <input type="text" id="card-number-2" class="input-cart-number" maxlength="4" required />
                        <input type="text" id="card-number-3" class="input-cart-number" maxlength="4" required />
                    </div>
                </fieldset>
                <fieldset>
                    <label for="card-holder">TITULAR</label>
                    <input type="text" id="card-holder" required />
                </fieldset>
                <fieldset class="fieldset-expiration">
                    <label for="card-expiration-month">Fecha Expiración</label>
                    <div class="select">
                        <select id="card-expiration-month" required>
                            <option value="">Mes</option>
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                            <option>06</option>
                            <option>07</option>
                            <option>08</option>
                            <option>09</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                    <div class="select">
                        <select id="card-expiration-year" required>
                            <option value="">Año</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                            <option>2028</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset class="fieldset-ccv">
                    <label for="card-ccv">CCV</label>
                    <input type="text" id="card-ccv" maxlength="3" required />
                </fieldset>
                <button class="pagar" id="boton" onclick="pagar()">
                    <span><i class="fab fa-apple-pay"></i>&nbsp;&nbsp;PAGAR <span id="precio"></span></span>
                </button>

            </form>
        </div>
    </div>

    <br>

    <div id="cajaContacto">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fas fa-phone-alt"></i> Teléfono: <a href="tel:+34634473757" style="color:white;" title="Llamar por teléfono">666
                        66 66 66</a>
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
                        una licencia Creative Commons <i class="fab fa-creative-commons"></i> Attribution 4.0
                        International
                        <br>
                        Copyright&copy; 2020 Guevara MotorSport. Todos los derechos reservados</div>
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../js/funciones.js"></script>
</body>

</html>