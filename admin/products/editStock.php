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
    <!-- Custom styles for datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.css" />
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
            <div id="content" style="max-height: 100%">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="productos.php">Productos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gestionar Stock</li>
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
                    <!-- DataTable -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="stock" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Imagen</th>
                                            <th>Precio</th>
                                            <th>Stock Actual</th>
                                            <th>Gestionar Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = "SELECT `id_producto`, `nombre`, `precio`, `descripcion`, `stock`, `is_active` FROM productos";
                                        $result = mysqli_query($conexion, $consulta);
                                        while ($fila = mysqli_fetch_array($result)) { ?>
                                            <tr>
                                                <td><?php echo $fila["nombre"]; ?></td>
                                                <td><img src="obtenerImagen.php?id=<?php echo $fila["id_producto"]; ?>" width="80" height="80" id="imagenProducto" /></td>
                                                <td><?php echo $fila["precio"] . " €"; ?></td>
                                                <td><?php
                                                    if ($fila['stock'] > 0) {
                                                        echo $fila['stock'];
                                                    } else {
                                                        echo "<span class='fas fa-exclamation-circle' style='color:red';></span>";
                                                    }
                                                    ?></td>
                                                <td>
                                                    <a class="btn btn-primary noFocus" onclick="stockMenos('<?php echo $fila["id_producto"]; ?>');"><i class="fas fa-minus" style="color: white"></i></a>
                                                    <a class="btn btn-primary noFocus" onclick="stockMas('<?php echo $fila["id_producto"]; ?>');"><i class="fas fa-plus" style="color: white"></i></a>
                                                </td>
                                            </tr>
                                        <?php }; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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


    <!-- Bootstrap JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Page level plugins -->
    <script src="../../js/sidebar-admin.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#stock').DataTable({
                scrollY: 420
            });
        });

        function stockMas(id) {
            data = {
                "id_producto": id,
                "action": "mas"
            };

            $.ajax({
                url: "updateStock.php",
                type: "POST",
                dataType: "HTML",
                data: data,
                cache: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    window.location.replace("editStock.php")
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        };

        function stockMenos(id) {
            data = {
                "id_producto": id,
                "action": "menos"
            };

            $.ajax({
                url: "updateStock.php",
                type: "POST",
                dataType: "HTML",
                data: data,
                cache: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    window.location.replace("editStock.php")
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        };
    </script>

</body>

</html>