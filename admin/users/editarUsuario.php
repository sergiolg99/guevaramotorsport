<?php
require_once('../recursos/conexionBD.php');
session_start();

if (!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autenticado') {
    header('Location: ../index.php');
} else {
    $estado = $_SESSION['estado'];
    require('../recursos/sesiones.php');
    $usuario = $_SESSION['usuario'];
}

$id = $_GET['id'];

$consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
$resultado = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($resultado)
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../../recursos/imagenes/logo.png" />
    <title>Guevara MotorSport - Admin</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- CSS para la parte administrador-->
    <link href="../../css/sidebar-admin.css" rel="stylesheet">

    <style type="text/css">
        .custom-control-input {
            font-size: 25px;
        }

        input::placeholder {
            font-size: 14px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="navbar-nav" style="height: 95%">
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="../dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <i class="fas fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                    <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="usuarios.php">Usuarios</a>
                            <a class="collapse-item" href="usuarios_vehiculos.php">Vehículos</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vehicles/vehiculos.php">
                        <i class="fas fa-motorcycle"></i>
                        <span>Modelos Vehículos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../products/productos.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Productos en venta</span>
                    </a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="../tasks/citas.php">
						<i class="fas fa-wrench"></i>
						<span>Citas Taller</span>
					</a>
                </li>
                <li class="nav-item">
					<a class="nav-link" href="../sales/pedidos.php">
						<i class="fas fa-coins"></i>
						<span>Pedidos</span>
					</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../messages/mensajes.php">
                        <i class="fas fa-comment-alt"></i>
                        <span>Mensajes</span>
                    </a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </div>
            <div class="text-center">
                <div class="container">
                    <span style="color: white; font-size: 12px">Backend v2.0</span>
                </div>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="usuarios.php">Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                        </ol>
                    </nav>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="usuarioDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Cerrar Sesíon
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Inicio Contenido Página -->
                <div class="container-fluid">
                    <div class="form-group col" style="text-align: -webkit-right;">
                        <a class="btn btn-outline-dark" id="asociarVehiculo" data-toggle="modal" data-target="#asociarVehiculoUsuario" style="color: black;"><i class="fas fa-edit"></i> Asociar Vehículo</a>
                        <a class="btn btn-warning" id="changePassword" data-toggle="modal" data-target="#changePasswordModal" style="color: black;"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                    </div>
                    <form action="" method="POST" id="editarUsuario">
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
                                <input type="text" class="form-control" id="inputName" name="nombre" required value="<?php echo $fila["nombre"]; ?>">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputLastName">Apellidos</label>
                                <input type="text" class="form-control" id="inputLastName" name="apellidos" required value="<?php echo $fila["apellidos"]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" class="form-control" id="inputAddress" name="direccion" required value="<?php echo $fila["direccion"]; ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Localidad</label>
                                <input type="text" class="form-control" id="inputCity" name="localidad" required value="<?php echo $fila["localidad"]; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputProvince">Provincia</label>
                                <select id="inputProvince" class="form-control" name="provincia" required>
                                    <option selected value="<?php echo $fila["provincia"]; ?>"><?php $consulta2 = "SELECT usuarios.id_usuario, provincias.nombre FROM usuarios 
                                                        INNER JOIN provincias ON usuarios.provincia = provincias.id_provincia
                                                        WHERE usuarios.id_usuario = $fila[id_usuario]";
                                                        $resultado2 = mysqli_query($conexion, $consulta2);
                                                        while ($fila2 = mysqli_fetch_array($resultado2)) {
                                                            echo $fila2["nombre"];
                                                        };
                                                        ?></option>
                                    <?php
                                    $query = $conexion->query("SELECT * FROM provincias");
                                    while ($provincia = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $provincia['id_provincia'] . '">' . $provincia['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputCP">Cod. Postal</label>
                                <input type="text" class="form-control" id="inputCP" maxlength="5" name="cp" required value="<?php echo $fila["cp"]; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputPhone">Teléfono</label>
                                <input type="tel" class="form-control" id="inputPhone" maxlength="9" name="telefono" required value="<?php echo $fila["telefono"]; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="custom-switch form-control-lg">
                                <input type="checkbox" class="custom-control-input" id="inputIsAdmin" name="is_admin" value="<?php echo $fila["is_admin"]; ?>">
                                <label class="custom-control-label" for="inputIsAdmin">Is Admin</label>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-primary" type="submit" id="submit">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Asociar Vehiculo a Usuario -->
    <div class="modal fade" id="asociarVehiculoUsuario" tabindex="-1" role="dialog" aria-labelledby="asociarVehiculoUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="asociarVehiculoUsuarioLabel">Asociar vehículo a usuario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fabricante">Fabricante</label>
                                <select id="fabricante" class="form-control" name="fabricante" required>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modelo">Modelo</label>
                                <select id="modelo" class="form-control" name="modelo" required>
                                    <option value="0">Esperando...</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cilindrada">Cilindrada</label>
                                <select id="cilindrada" class="form-control" name="cilindrada" required>
                                    <option value="0">Esperando...</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="year">Año</label>
                                <input type="text" class="form-control" name="year" id="year" placeholder="Año" maxlength="4" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-7">
                                <label for="matricula">Matrícula</label>
                                <input type="text" class="form-control" name="matricula" id="matricula" maxlength="8" placeholder="Matrícula" required>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" onclick="asociarVehiculoUsuario()">Guardar</button>
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
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../recursos/salir.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap y jQuery core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- JS para la parte administrador -->
    <script src="../../js/sidebar-admin.min.js"></script>
    <script>
        $(document).ready(function() {
            let isAdmin = $('#inputIsAdmin').val();
            if (isAdmin == 1) {
                $("#inputIsAdmin").prop("checked", true);
            } else {
                $("#inputIsAdmin").prop("checked", false);
            }

            $.ajax({
                type: "POST",
                url: "../vehicles/getMarcas.php?action=exist",
                success: function(response) {
                    $('#fabricante').html(response).fadeIn();
                }
            });

            $("#fabricante").change(function() {
                fabricante = $('#fabricante').val();
                $.ajax({
                    type: "POST",
                    data: "fabricante=" + fabricante,
                    url: "../vehicles/getModelos.php?action=exist",
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
                    url: "../vehicles/getCilindrada.php",
                    success: function(response) {
                        $('#cilindrada').html(response).fadeIn();
                    }
                });
            });
        });

        $("#editarUsuario").on("submit", function(e) {
            let isCheck = $('#inputIsAdmin').is(":checked");
            if (isCheck == true) {
                $("#inputIsAdmin").val(1);
            } else {
                $("#inputIsAdmin").val(0);
            }
            e.preventDefault();
            data = $('#editarUsuario').serialize();
            $.ajax({
                url: "updateUsuario.php?id=<?php echo $fila["id_usuario"]; ?>",
                type: "POST",
                dataType: "HTML",
                data: data,
                cache: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    alert("Usuario actualizado con éxito");
                    window.location.replace("usuarios.php")
                } else if (echo == "existe") {
                        alert("Este correo ya existe, pruebe con otro");
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });

        function asociarVehiculoUsuario() {
            usuario = <?php echo $_GET["id"]; ?>;
            moto = $('#cilindrada').val();
            year = $('#year').val();
            matricula = $('#matricula').val().toUpperCase();
            if (usuario !== "" && moto != 0 && year !== "" && matricula !== "") {
                data = {
                    usuario: usuario,
                    moto: moto,
                    year: year,
                    matricula: matricula
                };

                $.ajax({
                    url: "asociarUsuariosVehiculos.php",
                    type: "POST",
                    dataType: "HTML",
                    data: data,
                    cache: false,
                }).done(function(echo) {
                    if (echo == "exito") {
                        alert("Vehículo asociado");
                        window.location.replace("usuarios.php")
                    } else if (echo == "existe") {
                        alert("Esta matrícula ya existe");
                    } else if (echo == "error") {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            } else {
                alert("Faltan datos");
            }
        };

        function changePassword() {
            password1 = $('#password1').val();
            password2 = $('#password2').val();
            if (password1 != "" && password1 == password2) {
                data = {
                    password1: password1,
                    password2: password2
                };

                $.ajax({
                    url: "changePassword.php?id=<?php echo $_GET["id"]; ?>;",
                    type: "POST",
                    dataType: "HTML",
                    data: data,
                    cache: false,
                }).done(function(echo) {
                    if (echo == "exito") {
                        alert("Contraseña cambiada");
                        window.location.replace("editarUsuario.php?id=<?php echo $_GET["id"]; ?>")
                    } else if (echo == "error") {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            } else {
                alert("Faltan datos");
            }
        };
    </script>
</body>

</html>