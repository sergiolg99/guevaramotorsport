<?php
require_once('../recursos/conexionBD.php');
//Reanudamos la sesión
session_start();

//Comprobamos si el usario está logueado
//Si no lo está, se le redirecciona al index
//Si lo está, definimos el botón de cerrar sesión y la duración de la sesión
if (!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autenticado') {
    header('Location: ../index.php');
} else {
    $estado = $_SESSION['estado'];
    require('../recursos/sesiones.php');
    $usuario = $_SESSION['usuario'];
}

$id = $_GET['id_usuario'];

$consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
$result = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($result)
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

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="navbar-nav" style="height: 95%">
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="../dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Components</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Components:</h6>
                            <a class="collapse-item" href="buttons.html">Buttons</a>
                            <a class="collapse-item" href="cards.html">Cards</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Addons
                </div>

                <!-- Nav Item - Charts -->
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
                        <i class="fas fa-motorcycle fa-2x text-gray-300"></i>
                        <span>Modelos Vehículos</span>
                    </a>
                    </>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
            </div>
            <div class="text-center">
                <div class="container">
                    <span style="color: white; font-size: 12px">Backend v1.0</span>
                </div>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="usuarios.php">Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                        </ol>
                    </nav>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 medium" style="font-size: 20px"><?php print($usuario) ?></span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                                    Cerrar Sesíon
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <form action="" method="POST" id="editUser">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required value="<?php echo $fila["email"]; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword">Contraseña</label>
                                <input type="password" class="form-control" id="inputPassword" name="password" required value="<?php echo $fila["password"]; ?>">
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
                                                        INNER JOIN provincias ON usuarios.provincia = provincias.id WHERE usuarios.id_usuario = $fila[id_usuario]";
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
                                <input type="text" class="form-control" id="inputCP" maxlength="5" name="cp" required value="<?php echo $fila["cp"]; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputDNI">DNI</label>
                                <input type="text" class="form-control" id="inputDNI" maxlength="9" name="dni" required value="<?php echo $fila["dni"]; ?>">
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
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

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

    <!-- Custom scripts for all pages-->
    <script src="../../js/sidebar-admin.min.js"></script>
    <script>
        $(document).ready(function() {
            let isAdmin = $('#inputIsAdmin').val();
            if (isAdmin == 1) {
                $("#inputIsAdmin").prop("checked", true);
            } else {
                $("#inputIsAdmin").prop("checked", false);
            }
        });
        $("#editUser").on("submit", function(e) {
            let isCheck = $('#inputIsAdmin').is(":checked");

            if (isCheck == true) {
                $("#inputIsAdmin").val(1);
            } else {
                $("#inputIsAdmin").val(0);
            }
            e.preventDefault();
            //Evitamos que se envíe por defecto
            //Creamos un FormData con los datos del mismo formulario
            data = $('#editUser').serialize();
            $.ajax({
                //Definimos la URL del archivo al cual vamos a enviar los datos
                url: "updateUser.php?id_usuario=<?php echo $fila["id_usuario"]; ?>",
                //Definimos el tipo de método de envío
                type: "POST",
                //Definimos el tipo de datos que vamos a enviar y recibir
                dataType: "HTML",
                //Definimos la información que vamos a enviar
                data: data,
                //Deshabilitamos el caché
                cache: false,
            }).done(function(echo) {
                //Una vez que recibimos respuesta
                //comprobamos si la respuesta no es vacía
                if (echo == "exito") {
                    //Si hay respuesta mostramos el mensaje
                    alert("Usuario actualizado con éxito");
                    window.location.replace("usuarios.php")
                } else {
                    alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
                }
            });
        });
    </script>
</body>

</html>