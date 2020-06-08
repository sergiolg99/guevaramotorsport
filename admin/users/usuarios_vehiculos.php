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
  <!-- CSS para la parte administrador -->
  <link href="../../css/sidebar-admin.css" rel="stylesheet">
  <!-- Estilos para la tabla -->
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
        <li class="nav-item active">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
            <i class="fas fa-users"></i>
            <span>Usuarios</span>
          </a>
          <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="usuarios.php">Usuarios</a>
              <a class="collapse-item" href="#">Vehículos</a>
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
      <div id="content" style="max-height: 100%">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="usuarios.php">Usuarios</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lista de Usuarios por Vehículos</li>
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
          <!-- DataTable -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="usuarios_vehiculos" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Fabricante</th>
                      <th>Modelo</th>
                      <th>Matrícula</th>
                      <th>Año</th>
                      <th>Activo</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta = "SELECT `id_motosUsuarios`, `id_usuario`, `id_moto`, `matricula`, `year`, `is_active` FROM motos_usuarios";
                    $result = mysqli_query($conexion, $consulta);
                    while ($fila = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td><?php $consulta3 = "SELECT usuarios.email FROM motos_usuarios 
                                                  INNER JOIN usuarios ON motos_usuarios.id_usuario = usuarios.id_usuario WHERE motos_usuarios.id_motosUsuarios = $fila[id_motosUsuarios]";
                            $result3 = mysqli_query($conexion, $consulta3);
                            while ($fila3 = mysqli_fetch_array($result3)) {
                              echo $fila3["email"];
                            }
                            ?></td>
                        <td><?php $consulta4 = "SELECT moto_models.fabricante, moto_makers.nombre FROM motos_usuarios 
                                                  INNER JOIN motos ON motos_usuarios.id_moto = motos.id_moto
                                                  INNER JOIN moto_models on motos.modelo = moto_models.id_model
                                                  INNER JOIN moto_makers on moto_models.fabricante = moto_makers.id_maker
                                                  WHERE motos_usuarios.id_motosUsuarios = $fila[id_motosUsuarios]";
                            $result4 = mysqli_query($conexion, $consulta4);
                            while ($fila4 = mysqli_fetch_array($result4)) {
                              echo $fila4["nombre"];
                            }
                            ?></td>
                        <td><?php $consulta5 = "SELECT moto_models.nombre FROM motos_usuarios 
                                                  INNER JOIN motos ON motos_usuarios.id_moto = motos.id_moto
                                                  INNER JOIN moto_models on motos.modelo = moto_models.id_model WHERE motos_usuarios.id_motosUsuarios = $fila[id_motosUsuarios]";
                            $result5 = mysqli_query($conexion, $consulta5);
                            while ($fila5 = mysqli_fetch_array($result5)) {
                              echo $fila5["nombre"];
                            }
                            ?></td>
                        <td><?php echo $fila["matricula"]; ?></td>
                        <td><?php echo $fila["year"]; ?></td>
                        <td><?php
                            if ($fila['is_active'] == 1) {
                              echo "<span class='fas fa-check-circle' style='color:green';></span>";
                            } else {
                              echo "<span class='fas fa-times-circle' style='color:red';></span>";
                            }
                            ?>
                        </td>
                        <td>
                          <a class="btn btn-danger noFocus" style="cursor: pointer;" onclick="borrarUsuarioVehiculo('<?php echo $fila["id_motosUsuarios"]; ?>');"><i class="fas fa-trash-alt" style="color: white"></i></a>
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

  <!--Delete Usuario_Vehiculo Modal-->
  <div class="modal fade" id="borrarUsuarioVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="borrarUsuarioVehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="borrarUsuarioVehiculoModal">Borrar relación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Estas seguro que quieres borrar esta relación?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger" id="submit" name="submit">Borrar</button>
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

  <!-- Bootstrap y jQuery core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- JS para la parte administrador -->
  <script src="../../js/sidebar-admin.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#usuarios_vehiculos').DataTable();
    })

    function borrarUsuarioVehiculo(id) {
      $('#borrarUsuarioVehiculoModal').modal();
      $('#submit').click(function(e) {
        e.preventDefault();
        data = {
          "id": id
        };

        $.ajax({
          url: "borrarUsuarioVehiculo.php",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {
          if (echo == "exito") {
            alert("Relación borrada con éxito");
            window.location.replace("usuarios_vehiculos.php")
          } else if (echo == "error") {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      });
    };
  </script>

</body>

</html>