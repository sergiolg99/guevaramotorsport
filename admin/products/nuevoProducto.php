<?php
require_once('../recursos/conexionBD.php');
session_start();

if (!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Administrador') {
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
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <i class="fas fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                    <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../users/usuarios.php">Usuarios</a>
                            <a class="collapse-item" href="../users/usuarios_vehiculos.php">Vehículos</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vehicles/vehiculos.php">
                        <i class="fas fa-motorcycle"></i>
                        <span>Modelos Vehículos</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="productos.php">
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
                            <li class="breadcrumb-item"><a href="productos.php">Productos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nuevo Producto</li>
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

                <div class="container-fluid">
                    <!-- Content Row -->
                    <form action="" method="POST" id="crearProducto" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-4">
                                <label for="inputName">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01" placeholder="Precio en €" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del producto" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" required>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock disponible" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="custom-switch form-control-lg">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked value="1">
                                <label class="custom-control-label" for="is_active">Activo</label>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-primary" type="submit" id="submit">Crear Producto</button>
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
        $("#crearProducto").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "crearProducto.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    alert("Producto creado con éxito");
                    window.location.replace("productos.php")
                } else if (echo == "existe") {
                    alert("Este producto ya existe");
                } else if (echo == "errorImagen") {
                    alert("Imagen no disponible");
                } else if (echo == "formato") {
                    alert("Formato de archivo no permitido o excede el tamaño límite de Kbytes.");
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });

        /* Validación tipo fichero */
        $("#imagen").change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                alert('Por favor, selecciona un tipo de archivo válido (JPEG/JPG/PNG).');
                $("#imagen").val('');
                return false;
            }
        });
    </script>
</body>

</html>