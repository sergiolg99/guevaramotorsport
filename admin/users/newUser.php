<?php
require_once('../recursos/conexionBD.php');
session_start();

if (!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autenticado') {
    header('Location: ../administrar.php');
} else {
    $estado = $_SESSION['estado'];
    require('../recursos/sesiones.php');
    $usuario = $_SESSION['usuario'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="../../recursos/imagenes/logo.png" />
    <title>Guevara MotorSport - Admin</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Custom styles for this template-->
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
                <li class="nav-item">
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
                            <li class="breadcrumb-item active" aria-current="page">Nuevo Usuario</li>
                        </ol>
                    </nav>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Cerrar Sesíon
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form action="" method="POST" id="createUser">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com" name="email" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword">Contraseña</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña" name="password" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword2">Repite la contraseña</label>
                                <input type="password" class="form-control" id="inputPassword2" placeholder="Repite la contraseña" name="password2" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputName">Nombre</label>
                                <input type="text" class="form-control" id="inputName" name="nombre" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputLastName">Apellidos</label>
                                <input type="text" class="form-control" id="inputLastName" name="apellidos" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Calle Mayor 72" name="direccion" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Localidad</label>
                                <input type="text" class="form-control" id="inputCity" name="localidad" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputProvince">Provincia</label>
                                <select id="inputProvince" class="form-control" name="provincia" required>
                                    <option value="0">Selecciona...</option>
                                    <?php
                                    $query = $conexion->query("SELECT `id`, `nombre` FROM provincias");
                                    while ($provincia = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $provincia['id'] . '">' . $provincia['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputCP">Cod. Postal</label>
                                <input type="text" class="form-control" id="inputCP" maxlength="5" name="cp" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputPhone">Teléfono</label>
                                <input type="tel" class="form-control" id="inputPhone" maxlength="9" placeholder="Nº de Teléfono" name="telefono" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="custom-switch form-control-lg">
                                <input type="checkbox" class="custom-control-input" id="inputIsAdmin" name="is_admin" checked value="1">
                                <label class="custom-control-label" for="inputIsAdmin">Is Admin</label>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-primary" type="submit" id="submit">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                    <a class="btn btn-primary" href="../recursos/salir.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Plugins para la página -->
    <script src="../../js/sidebar-admin.min.js"></script>
    <script>
        $("#createUser").on("submit", function(e) {
            password1 = $('#inputPassword').val();
            password2 = $('#inputPassword2').val();
            if (password1 != password2) {
                e.preventDefault();
                alert("Contraseñas no iguales");
            } else {
                e.preventDefault();
                data = $('#createUser').serialize();
                $.ajax({
                    url: "createUser.php",
                    type: "POST",
                    dataType: "HTML",
                    data: data,
                    cache: false,

                }).done(function(echo) {
                    if (echo == "exito") {
                        alert("Usuario creado con éxito");
                        window.location.replace("usuarios.php")
                    } else if (echo == "existe") {
                        alert("Este usuario ya existe");
                    } else {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            }
        });
    </script>
</body>

</html>