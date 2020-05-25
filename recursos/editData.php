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
    $id = $_SESSION['id_usuario'];
}

$consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
$result = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($result)
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
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">CONTACTAR&nbsp;</a>
                        </li>
                        <li class="nav-item" id="iniciarSesion" <?php print($showLogin) ?>>
                            <a class="nav-link" data-toggle="modal" data-target="#inicioSesion">
                                <strong class="fas fa-sign-in-alt"></strong>&nbsp;INICIAR SESIÓN</a>
                        </li>
                        <!-- Botón Usuario -->
                        <li class="nav-item dropdown active" id="usuario" <?php print($showUser) ?>>
                            <a class="nav-link dropdown-toggle noFocus" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: white; border: none;">
                                <a class="dropdown-item usuarioDropdown active" href="misDatos.php">MIS DATOS</a>
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
        <div class="container-fluid">
            <br>
            <div class="row" style="margin-left: 5%; margin-right: 5%;">
                <div class="form-group col-md-6">
                    <h2 id="titulo">Actualizar Datos Personales</h2>
                </div>
                <div class="form-group col-md-5" style="text-align: -webkit-right; margin-top: 1%;">
                    <a class="btn btn-warning" id="changePassword" data-toggle="modal" data-target="#changePasswordModal" style="color: black;"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                </div>
            </div>

            <!-- Content Row -->
            <form action="" method="POST" id="editPersonalData" style="margin-left: 5%; margin-right: 5%;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" required value="<?php echo $fila["email"]; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" name="password" required value="<?php echo $fila["password"]; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputName">Nombre</label>
                        <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre" required value="<?php echo $fila["nombre"]; ?>">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputLastName">Apellidos</label>
                        <input type="text" class="form-control" id="inputLastName" name="apellidos" placeholder="Apellidos" required value="<?php echo $fila["apellidos"]; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Dirección</label>
                    <input type="text" class="form-control" id="inputAddress" name="direccion" placeholder="Dirección" required value="<?php echo $fila["direccion"]; ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Localidad</label>
                        <input type="text" class="form-control" id="inputCity" name="localidad" placeholder="Localidad" required value="<?php echo $fila["localidad"]; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputProvince">Provincia</label>
                        <select id="inputProvince" class="form-control" name="provincia" required>
                            <option selected value="<?php echo $fila["provincia"]; ?>"><?php $consulta2 = "SELECT usuarios.id_usuario, provincias.nombre FROM usuarios 
                                                        INNER JOIN provincias ON usuarios.provincia = provincias.id 
                                                        WHERE usuarios.id_usuario = $fila[id_usuario]";
                                                                                        $result2 = mysqli_query($conexion, $consulta2);
                                                                                        while ($fila2 = mysqli_fetch_array($result2)) {
                                                                                            echo $fila2["nombre"];
                                                                                        };
                                                                                        ?></option>
                            <?php
                            $query = $conexion->query("SELECT * FROM provincias");
                            while ($provincia = mysqli_fetch_array($query)) {
                                echo '<option value="' . $provincia['id'] . '">' . $provincia['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputCP">Cod. Postal</label>
                        <input type="text" class="form-control" id="inputCP" maxlength="5" name="cp" placeholder="Cod. Postal" required value="<?php echo $fila["cp"]; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputPhone">Nº de Teléfono</label>
                        <input type="tel" class="form-control" id="inputPhone" maxlength="9" name="telefono" placeholder="Nº Teléfono" required value="<?php echo $fila["telefono"]; ?>">
                    </div>
                </div>
                <br><br>
                <button class="btn btn-primary" type="submit" id="submit">Actualizar Usuario</button>
            </form>
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
                            Copyright&copy; 2020 Guevara MotorSport. Todos los derechos reservados
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cambiar Contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Cambiar contraseña</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password1">Contraseña</label>
                                <input type="password" class="form-control" name="password1" id="password1" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password2">Repite la contraseña</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Repite la contraseña" required>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" onclick="changePassword()">Guardar</button>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../admin/recursos/salir.php?action=cliente">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <button class="back-to-top" id="back-to-top"></button>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../js/funciones.js"></script>
    <script>
        $("#editPersonalData").on("submit", function(e) {
            e.preventDefault();
            data = $('#editPersonalData').serialize();
            $.ajax({
                url: "../admin/users/updateUser.php?id=<?php echo $id; ?>",
                type: "POST",
                dataType: "HTML",
                data: data,
                cache: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    alert("Usuario actualizado con éxito");
                    window.location.replace("misDatos.php");
                } else if (echo == "existe") {
                    alert("Este correo ya existe, pruebe con otro");
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });

        function changePassword() {
            password1 = $('#password1').val();
            password2 = $('#password2').val();
            if (password1 != "" && password1 == password2) {
                data = {
                    password1: password1,
                    password2: password2
                };

                $.ajax({
                    url: "../admin/users/changePassword.php?id=<?php echo $id; ?>;",
                    type: "POST",
                    dataType: "HTML",
                    data: data,
                    cache: false,
                }).done(function(echo) {
                    if (echo == "exito") {
                        alert("Contraseña cambiada");
                        window.location.replace("")
                    } else if (echo == "error") {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            } else {
                alert("Datos incorrectos");
            }
        };
    </script>
</body>

</html>