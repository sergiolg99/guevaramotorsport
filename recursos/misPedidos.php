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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.css" />
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
                                <a class="dropdown-item usuarioDropdown" href="misDatos.php">MIS DATOS</a>
                                <a class="dropdown-item usuarioDropdown" href="citas.php">CITAS TALLER</a>
                                <a class="dropdown-item usuarioDropdown active" href="misPedidos.php">PEDIDOS</a>
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
            <!-- Content Row -->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2 id="titulo">Mis Pedidos</h2>
                            <br>
                            <table class="table" id="pedidos" cellspacing="0" style="margin-top: 1%">
                                <thead>
                                    <tr>
                                        <th>Nº de pedido</th>
                                        <th>Fecha</th>
                                        <th>Productos</th>
                                        <th>Precio Total</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta = "SELECT `id_venta`, `id_usuario`, `fecha`, `precio_total`, `completada` FROM `ventas` WHERE id_usuario = '$id'";
                                    $resultado = mysqli_query($conexion, $consulta);
                                    while ($fila = mysqli_fetch_array($resultado)) { ?>
                                        <tr>
                                            <td><?php echo "#" . $fila["id_venta"]; ?></td>
                                            <td><?php echo $fila["fecha"]; ?></td>
                                            <td><?php $consulta2 = "SELECT productos.nombre FROM venta_productos 
                                                  INNER JOIN productos ON venta_productos.id_producto = productos.id_producto WHERE venta_productos.id_venta = $fila[id_venta]";
                                                $resultado2 = mysqli_query($conexion, $consulta2);
                                                while ($fila2 = mysqli_fetch_array($resultado2)) {
                                                    echo $fila2["nombre"] . ", ";
                                                }
                                                ?></td>
                                            <td><?php echo $fila["precio_total"] . " €"; ?></td>
                                            <td><?php
                                                if ($fila['completada'] == 1) {
                                                    echo "Terminado";
                                                } else {
                                                    echo "En Curso";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger noFocus" title="Anular pedido" onclick="borrarUsuarioVehiculo('<?php echo $fila2["id"]; ?>');"><i class="fas fa-trash-alt" style="color: white"></i></a>
                                            </td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                            <div class="form-group col" style="text-align: -webkit-left">
                                <br><br>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#addVehicle" style="color: white"><i class="fas fa-plus"></i> Añadir Vehículo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        <!--Delete Usuario_Vehiculo Modal-->
        <div class="modal fade" id="deleteUserVehicleModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserVehicleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserVehicleModal">Borrar Vehículo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="font-size: 18px">
                        Estas seguro que quieres borrar este vehículo?
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" id="submit" name="submit">Borrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Asociar Vehiculo a Usuario -->
        <div class="modal fade" id="addVehicle" tabindex="-1" role="dialog" aria-labelledby="addVehicleLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVehicleLabel">Añadir Vehículo</h5>
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
                                    <input type="text" class="form-control" name="year" id="year" placeholder="Año" maxlength="4">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="matricula">Matrícula</label>
                                    <input type="text" class="form-control" name="matricula" id="matricula" maxlength="8" placeholder="Matrícula">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" onclick="addVehicle()">Guardar</button>
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
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.js"></script>
        <script src="../js/funciones.js"></script>
        <script>
            $(document).ready(function() {
                $('#pedidos').DataTable({
                    "order": [
                        [1, 'asc'],
                        [4, 'asc'],
                    ]
                });
            });

            function borrarUsuarioVehiculo(id) {
                $('#deleteUserVehicleModal').modal();
                $('#submit').click(function(e) {
                    e.preventDefault();
                    data = {
                        "id": id
                    };

                    $.ajax({
                        url: "../admin/users/deleteUserVehicle.php",
                        type: "POST",
                        dataType: "HTML",
                        data: data,
                        cache: false,

                    }).done(function(echo) {
                        if (echo == "exito") {
                            alert("Vehículo borrado con éxito");
                            window.location.replace("misDatos.php")
                        } else if (echo == "error") {
                            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                        }
                    });
                });
            };
        </script>
</body>

</html>