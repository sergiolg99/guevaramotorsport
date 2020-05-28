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
        <li class="nav-item">
          <a class="nav-link" href="../products/productos.php">
            <i class="fas fa-shopping-cart"></i>
            <span>Productos en venta</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">
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
              <li class="breadcrumb-item"><a href="#">Citas Taller</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lista de Citas</li>
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
              <div class="custom-switch form-control-lg" style="margin-left: 0.5%; margin-bottom: 0.5%">
                <input type="checkbox" class="custom-control-input" id="verTerminadas" name="verTerminadas">
                <label class="custom-control-label" for="verTerminadas">Ver citas terminadas</label>
              </div>
              <div class="table-responsive" id="citasPendientes">
                <table class="table citas" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Modelo Moto</th>
                      <th>A realizar</th>
                      <th>Fecha</th>
                      <th>Completada</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta = "SELECT `id_cita`, `id_usuario`, `id_moto`, `fecha`, `comentarios`, `completada` FROM citas WHERE completada = 0";
                    $result = mysqli_query($conexion, $consulta);
                    while ($fila = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td><?php $consulta2 = "SELECT usuarios.email FROM citas 
                                                  INNER JOIN usuarios ON citas.id_usuario = usuarios.id_usuario
                                                  WHERE citas.id_cita = $fila[id_cita]";
                            $result2 = mysqli_query($conexion, $consulta2);
                            while ($fila2 = mysqli_fetch_array($result2)) {
                              echo $fila2["email"];
                            } ?></td>
                        <td><?php $consulta3 = "SELECT usuarios.telefono FROM citas 
                                                  INNER JOIN usuarios ON citas.id_usuario = usuarios.id_usuario
                                                  WHERE citas.id_cita = $fila[id_cita]";
                            $result3 = mysqli_query($conexion, $consulta3);
                            while ($fila3 = mysqli_fetch_array($result3)) {
                              echo $fila3["telefono"];
                            } ?></td>
                        <td><?php $consulta2 = "SELECT moto_models.nombre FROM citas 
                                                  INNER JOIN motos ON citas.id_moto = motos.id_moto
                                                  INNER JOIN moto_models on motos.modelo = moto_models.id_model WHERE citas.id_cita = $fila[id_cita]";
                            $result2 = mysqli_query($conexion, $consulta2);
                            while ($fila2 = mysqli_fetch_array($result2)) {
                              echo $fila2["nombre"];
                            }
                            ?></td>
                        <td><?php echo $fila["comentarios"]; ?></td>
                        <td><?php echo $fila["fecha"]; ?></td>
                        <td><?php echo "<span class='fas fa-minus-circle' title='No realizada' style='color:red'></span>"; ?></td>
                        <td>
                          <a class="btn btn-outline-warning noFocus" href="#" title="Cambiar estado de cita" onclick="cambiarEstadoCita('<?php echo $fila["id_cita"]; ?>');"><i class='fas fa-edit'></i></a>
                          <a class="btn btn-danger noFocus" title="Borrar Cita" style="cursor: pointer;" onclick="borrarCita('<?php echo $fila["id_cita"]; ?>');"><i class="fas fa-calendar-times" style="color: white"></i></a>
                        </td>
                      </tr>
                    <?php }; ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive" id="citasTerminadas" style="display: none">
                <table class="table citas" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Modelo Moto</th>
                      <th>A realizar</th>
                      <th>Fecha</th>
                      <th>Completada</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta = "SELECT `id_cita`, `id_usuario`, `id_moto`, `fecha`, `comentarios`, `completada` FROM citas WHERE completada = 1";
                    $result = mysqli_query($conexion, $consulta);
                    while ($fila = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td><?php $consulta2 = "SELECT usuarios.email FROM citas 
                                                  INNER JOIN usuarios ON citas.id_usuario = usuarios.id_usuario
                                                  WHERE citas.id_cita = $fila[id_cita]";
                            $result2 = mysqli_query($conexion, $consulta2);
                            while ($fila2 = mysqli_fetch_array($result2)) {
                              echo $fila2["email"];
                            } ?></td>
                        <td><?php $consulta3 = "SELECT usuarios.telefono FROM citas 
                                                  INNER JOIN usuarios ON citas.id_usuario = usuarios.id_usuario
                                                  WHERE citas.id_cita = $fila[id_cita]";
                            $result3 = mysqli_query($conexion, $consulta3);
                            while ($fila3 = mysqli_fetch_array($result3)) {
                              echo $fila3["telefono"];
                            } ?></td>
                        <td><?php $consulta4 = "SELECT moto_models.nombre FROM citas 
                                                  INNER JOIN motos ON citas.id_moto = motos.id_moto
                                                  INNER JOIN moto_models on motos.modelo = moto_models.id_model WHERE citas.id_cita = $fila[id_cita]";
                            $result4 = mysqli_query($conexion, $consulta4);
                            while ($fila4 = mysqli_fetch_array($result4)) {
                              echo $fila4["nombre"];
                            }
                            ?></td>
                        <td><?php echo $fila["comentarios"]; ?></td>
                        <td><?php echo $fila["fecha"]; ?></td>
                        <td><?php echo "<span class='fas fa-check-circle' title='Realizada' style='color:green'></span>"; ?></td>
                        <td>
                          <a class="btn btn-outline-warning noFocus" href="#" title="Cambiar estado de cita" onclick="cambiarEstadoCita('<?php echo $fila["id_cita"]; ?>');"><i class='fas fa-edit'></i></a>
                          <a class="btn btn-danger noFocus" title="Borrar Cita" onclick="borrarCita('<?php echo $fila["id_cita"]; ?>');"><i class="fas fa-calendar-times" style="color: white"></i></a>
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

  <!--Delete Cita Modal-->
  <div class="modal fade" id="borrarCitaModal" tabindex="-1" role="dialog" aria-labelledby="borrarCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="borrarCitaTitle">Borrar Cita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 18px">
          Estas seguro que quieres borrar esta cita? <br>
          Esta acción no puede deshacerse.
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger" id="submitBorrar" name="submit">Borrar</button>
        </div>
      </div>
    </div>
  </div>

  <!--Cita Realizada Modal-->
  <div class="modal fade" id="cambiarEstadoCitaModal" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cambiarEstadoCitaTitle">Cambiar el estado de esta cita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 18px">
          Quieres cambiar el estado de "Completado" de esta cita?
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="submitRealizada" name="submit">Aceptar</button>
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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- Plugins para la página -->
  <script src="../../js/sidebar-admin.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.citas').DataTable({
        "order": [
          [4, 'asc'],
          [0, 'desc']
        ]
      });

      $('#verTerminadas').change(
        function() {
          if (this.checked) {
            $("#citasPendientes").css("display", "none");
            $("#citasTerminadas").css("display", "");
          } else {
            $("#citasPendientes").css("display", "");
            $("#citasTerminadas").css("display", "none");
          }
        }
      );
    });

    function borrarCita(id) {
      $('#borrarCitaModal').modal();
      $('#submitBorrar').click(function(e) {
        e.preventDefault();
        data = {
          "id": id
        };

        $.ajax({
          url: "borrarCitaTaller.php",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {
          if (echo == "exito") {
            alert("Cita borrada con éxito");
            window.location.replace("citas.php")
          } else if (echo == "error") {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      });
    };

    function cambiarEstadoCita(id) {
      $('#cambiarEstadoCitaModal').modal();
      $('#submitRealizada').click(function(e) {
        e.preventDefault();
        data = {
          "id": id
        };

        $.ajax({
          url: "citaTerminada.php",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {
          if (echo == "exito") {
            alert("Estado cambiado");
            window.location.replace("citas.php")
          } else if (echo == "error") {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      });
    };
  </script>

</body>

</html>