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

$id = $_GET['id'];

/* Consulta SQL para obtener la información de cada moto */
$consulta = "SELECT * FROM motos WHERE id_moto = '$id'";
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
    <!-- CSS para la parte administrador -->
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
                <li class="nav-item active">
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
                            <li class="breadcrumb-item active" aria-current="page">Editar Vehículo</li>
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
                    <form action="" method="POST" id="editarVehiculo">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="fabricante">Fabricante</label>
                                <select id="fabricante" class="form-control fabricante" name="fabricante" required>
                                    <?php $consulta2 = "SELECT moto_makers.nombre, moto_makers.id_maker FROM motos
                                                        INNER JOIN moto_models ON motos.modelo = moto_models.id_model
                                                        INNER JOIN moto_makers on moto_models.fabricante = moto_makers.id_maker
                                                        WHERE motos.id_moto = $fila[id_moto]";
                                    $resultado2 = mysqli_query($conexion, $consulta2);
                                    while ($fila2 = mysqli_fetch_array($resultado2)) {
                                        echo '<option selected value="' . $fila2["id_maker"] . '">' . $fila2["nombre"] . '</option>';
                                    };
                                    $query = "SELECT id_maker, nombre FROM moto_makers ORDER BY nombre";
                                    $resultado3 = mysqli_query($conexion, $query);

                                    while ($fila3 = mysqli_fetch_array($resultado3)) {
                                        echo '<option value="' . $fila3["id_maker"] . '">' . $fila3["nombre"] . '</option>';
                                    } ?>
                                </select>
                                <a class="btn btn-primary noFocus" data-toggle="modal" data-target="#nuevaMarca" style="margin-top: 2%; color: white" role="button"><i class="fas fa-plus"></i> Añadir Fabricante</a>
                            </div>
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-3">
                                <label for="modelo">Modelo</label>
                                <select id="modelo" class="form-control" name="modelo" required>
                                    <?php $consulta4 = "SELECT moto_models.nombre, moto_models.id_model FROM motos 
                                                        INNER JOIN moto_models ON motos.modelo = moto_models.id_model 
                                                        WHERE motos.id_moto = $fila[id_moto]";
                                    $resultado4 = mysqli_query($conexion, $consulta4);
                                    while ($fila4 = mysqli_fetch_array($resultado4)) {
                                        echo '<option selected value="' . $fila4["id_model"] . '">' . $fila4["nombre"] . '</option>';
                                    };
                                    ?>
                                </select>
                                <a class="btn btn-primary noFocus" data-toggle="modal" data-target="#nuevoModelo" style="margin-top: 2%; color: white" role="button"><i class="fas fa-plus"></i> Añadir Modelo</a>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cilindrada">Cilindrada</label>
                                <input type="number" class="form-control" id="cilindrada" placeholder="Cilindrada en cc" name="cilindrada" required value="<?php echo $fila['cilindrada']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="custom-switch form-control-lg">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="<?php echo $fila["is_active"]; ?>">
                                <label class="custom-control-label" for="is_active">Is Active</label>
                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-primary" type="submit" id="submit">Actualizar Vehículo</button>
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
    <div class="modal fade" id="nuevaMarca" tabindex="-1" role="dialog" aria-labelledby="nuevaMarcaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevaMarcaLabel">Crear nuevo fabricante de motos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="inputNuevaMarca">Nombre</label>
                    <input type="text" id="inputNuevaMarca" class="form-control" placeholder="Fabricante" name="inputNuevaMarca" required>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="nuevaMarca()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal crear modelo -->
    <div class="modal fade" id="nuevoModelo" tabindex="-1" role="dialog" aria-labelledby="nuevoModeloLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoModeloLabel">Crear nuevo modelo de motos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="fabricante">Fabricante</label>
                    <select id="fabricanteModal" class="form-control" name="fabricante" required>
                    </select>
                    <br>
                    <label for="inputNuevoModelo">Nombre</label>
                    <input type="text" id="inputNuevoModelo" class="form-control" placeholder="Modelo" name="inputNuevoModelo" required>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="nuevoModelo()">Guardar</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            let isActive = $('#is_active').val();
            if (isActive == 1) {
                $("#is_active").prop("checked", true);
            } else {
                $("#is_active").prop("checked", false);
            }

            $.ajax({
                type: "POST",
                url: "getMarcas.php",
                success: function(response) {
                    $('#fabricanteModal').html(response).fadeIn();
                }
            });

            $("#fabricante").change(function() {
                fabricante = $('#fabricante').val();
                $.ajax({
                    type: "POST",
                    data: "fabricante=" + fabricante,
                    url: "getModelos.php",
                    success: function(response) {
                        $('#modelo').html(response).fadeIn();
                    }
                });
            });
        });

        $("#editarVehiculo").on("submit", function(e) {
            let isCheck = $('#is_active').is(":checked");
            if (isCheck == true) {
                $("#is_active").val(1);
            } else {
                $("#is_active").val(0);
            }
            e.preventDefault();
            modelo = $('#modelo').val();
            cilindrada = $('#cilindrada').val();
            is_active = $('#is_active').val();
            var data = {
                "modelo": modelo,
                "cilindrada": cilindrada,
                "is_active": is_active
            };
            $.ajax({
                url: "updateVehiculo.php?id=<?php echo $fila["id_moto"]; ?>",
                type: "POST",
                dataType: "HTML",
                data: data,
                cache: false,

            }).done(function(echo) {
                if (echo == "exito") {
                    alert("Vehículo actualiado con éxito");
                    window.location.replace("vehiculos.php")
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });

        function nuevaMarca() {
            var nombre = $('#inputNuevaMarca').val();
            if (nombre == "") {
                alert("Faltan datos");
            } else {
                $.ajax({
                    url: "crearMarca.php",
                    type: "POST",
                    dataType: "HTML",
                    data: 'nombre=' + nombre,
                    cache: false,

                }).done(function(echo) {
                    if (echo == "exito") {
                        window.location.replace("nuevoVehiculo.php")
                        alert("Fabricante creado con éxito");
                    } else if (echo == "existe") {
                        alert("Este fabricante ya existe");
                    } else {
                        alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                    }
                });
            }

        };

        function nuevoModelo() {
            var fabricante = $('#fabricanteModal').val();
            var nombre = $('#inputNuevoModelo').val();
            if (fabricante == "" || nombre == "") {
                alert("Faltan datos");
            } else {
                $.ajax({
                    url: "crearModelo.php",
                    type: "POST",
                    dataType: "HTML",
                    data: 'nombre=' + nombre + '&fabricante=' + fabricante,
                    cache: false,

                }).done(function(echo) {
                    if (echo == "exito") {
                        window.location.replace("nuevoVehiculo.php")
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