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
                            <a class="collapse-item" href="../users/usuarios.php">Usuarios</a>
                            <a class="collapse-item" href="../users/usuarios_vehiculos.php">Vehículos</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vehiculos.php">
                        <i class="fas fa-motorcycle fa-2x text-gray-300"></i>
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
                            <li class="breadcrumb-item"><a href="vehiculos.php">Vehículos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nuevo Vehículo</li>
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
                    <form action="" method="POST" id="createVehicle">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="fabricante">Fabricante</label>
                                <select id="fabricante" class="form-control fabricante" name="fabricante" required>
                                </select>
                                <a class="btn btn-primary noFocus" data-toggle="modal" data-target="#newMaker" style="margin-top: 2%; color: white" role="button"><i class="fas fa-plus"></i> Añadir Fabricante</a>
                            </div>
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-3">
                                <label for="modelo">Modelo</label>
                                <select id="modelo" class="form-control" name="modelo" required>
                                    <option value="0">Esperando...</option>
                                </select>
                                <a class="btn btn-primary noFocus" data-toggle="modal" data-target="#newModel" style="margin-top: 2%; color: white" role="button"><i class="fas fa-plus"></i> Añadir Modelo</a>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cilindrada">Cilindrada</label>
                                <input type="number" class="form-control" id="cilindrada" placeholder="Cilindrada en cc" name="cilindrada" required>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-primary" type="submit" id="submit">Crear Vehículo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal crear fabricante -->
    <div class="modal fade" id="newMaker" tabindex="-1" role="dialog" aria-labelledby="newMakerLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMakerLabel">Crear nuevo fabricante de motos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="inputNewMaker">Nombre</label>
                    <input type="text" id="inputNewMaker" class="form-control" placeholder="Fabricante" name="inputNewMaker" required>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="newMaker()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal crear modelo -->
    <div class="modal fade" id="newModel" tabindex="-1" role="dialog" aria-labelledby="newModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newModelLabel">Crear nuevo modelo de motos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="fabricante">Fabricante</label>
                    <select id="fabricanteModal" class="form-control fabricante" name="fabricante" required>
                    </select>
                    <br>
                    <label for="inputNewModel">Nombre</label>
                    <input type="text" id="inputNewModel" class="form-control" placeholder="Modelo" name="inputNewModel" required>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="newModel()">Guardar</button>
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
                    <a class="btn btn-primary" href="../recursos/salir.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sidebar-admin.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "getMarcas.php",
                success: function(response) {
                    $('.fabricante').html(response).fadeIn();
                }
            });

            $("#fabricante.fabricante").change(function() {
                fabricante = $('.fabricante').val();
                $.ajax({
                    type: "POST",
                    data: "fabricante=" + fabricante,
                    url: "getModelos.php",
                    success: function(response) {
                        $('#modelo').html(response).fadeIn();
                    }
                });
            })
        });

        $("#createVehicle").on("submit", function(e) {
            //Evitamos que se envíe por defecto
            e.preventDefault();
            //Creamos un FormData con los datos del mismo formulario
            modelo = $('#modelo').val();
            cilindrada = $('#cilindrada').val();
            var data = {
                "modelo": modelo,
                "cilindrada": cilindrada
            };
            $.ajax({
                url: "createVehicle.php",
                type: "POST",
                dataType: "HTML",
                data: data,
                //Deshabilitamos el caché
                cache: false,
            }).done(function(echo) {
                if (echo == "exito") {
                    alert("Vehículo creado con éxito");
                    window.location.replace("vehiculos.php");
                } else if (echo == "existe") {
                    alert("Este vehículo ya existe");
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });

        function newMaker() {
            var nombre = $('#inputNewMaker').val();
            if (nombre == "") {
                alert("Faltan datos");
            } else {
                $.ajax({
                    url: "createMaker.php",
                    type: "POST",
                    dataType: "HTML",
                    data: 'nombre=' + nombre,
                    cache: false,

                }).done(function(echo) {
                    if (echo == "exito") {
                        window.location.replace("newVehicle.php")
                        alert("Fabricante creado con éxito");
                    } else if (echo == "existe") {
                        alert("Este fabricante ya existe");
                    } else {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            }
        };

        function newModel() {
            var fabricante = $('#fabricanteModal').val();
            var nombre = $('#inputNewModel').val();
            if (fabricante == "" || nombre == "") {
                alert("Faltan datos");
            } else {
                $.ajax({
                    url: "createModel.php",
                    type: "POST",
                    dataType: "HTML",
                    data: 'nombre=' + nombre + '&fabricante=' + fabricante,
                    cache: false,

                }).done(function(echo) {
                    if (echo == "exito") {
                        window.location.replace("newVehicle.php")
                        alert("Modelo creado con éxito");
                    } else if (echo == "existe") {
                        alert("Este modelo ya existe");
                    } else {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            }
        };
    </script>
</body>

</html>