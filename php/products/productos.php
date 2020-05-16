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

        <!-- Nav Item - Charts -->
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
      <div id="content" style="max-height: 100%">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Productos</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lista de Productos en venta</li>
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
          <!-- DataTable -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <a class="btn btn-primary noFocus" href="newProduct.php" role="button"><i class="fas fa-plus"></i> Añadir Producto</a>
                <br><br>
                <table class="table" id="products" width="100%" cellspacing="0" style="max-height: 100%">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Imagen</th>
                      <th>Precio</th>
                      <th>Stock</th>
                      <th>Active</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consulta = "SELECT `id_producto`, `nombre`, `precio`, `descripcion`, `stock`, `is_active` FROM productos";
                    $result = mysqli_query($conexion, $consulta);
                    while ($fila = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td><?php echo $fila["nombre"]; ?></td>
                        <td><?php echo $fila["descripcion"]; ?></td>
                        <td><img src="obtenerImagen.php?id=<?php echo $fila["id_producto"]; ?>" width="80" height="80" id="imagenProducto" /></td>
                        <td><?php echo $fila["precio"] . " €"; ?></td>
                        <td><?php
                            if ($fila['stock'] > 0) {
                              echo $fila['stock'];
                            } else {
                              echo "<span class='fas fa-exclamation-circle' style='color:red';></span>";
                            }
                            ?></td>
                        <td><?php
                            if ($fila['is_active'] == 1) {
                              echo "<span class='fas fa-check-circle' style='color:green';></span>";
                            } else {
                              echo "<span class='fas fa-minus-circle' style='color:red';></span>";
                            }
                            ?>
                        </td>
                        <td>
                          <a class="btn btn-outline-warning noFocus" href="editProduct.php?id=<?php echo $fila["id_producto"]; ?>" role="button"><i class="fas fa-edit"></i></a>
                          <a class="btn btn-danger noFocus" onclick="borrarProducto('<?php echo $fila["id_producto"]; ?>');"><i class="fas fa-trash-alt" style="color: white"></i></a>
                        </td>
                      </tr>
                    <?php }; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!--Delete Product Modal-->
  <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProductModal">Borrar Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Estas seguro que quieres borrar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger" id="submit" name="submit">Borrar Producto</button>
        </div>
      </div>
    </div>
  </div>
  <!--Delete Product Modal-->

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
  <!-- Page level plugins -->
  <script src="../../js/sidebar-admin.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.4/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#products').DataTable();
    });

    function borrarProducto(id) {
      $('#deleteProductModal').modal();
      $('#submit').click(function(e) {
        e.preventDefault();
        data = {
          "id_producto": id
        };

        $.ajax({
          url: "deleteProduct.php",
          type: "POST",
          dataType: "HTML",
          data: data,
          cache: false,

        }).done(function(echo) {

          if (echo == "exito") {
            alert("Producto borrado con éxito");
            window.location.replace("productos.php")
          } else if (echo == "error") {
            alert("Ha habido algún error, compruebe los datos y vuelva a intentarlo");
          }
        });
      });
    };
  </script>

</body>

</html>