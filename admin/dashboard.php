<?php
require_once('recursos/conexionBD.php');
session_start();

/* Grupo de consultas para mostrar la información requerida en las pestañas de informacion rapida */
$consulta = $conexion->query("SELECT 'id_usuario' FROM usuarios");
$cuentaUsuarios = $consulta->num_rows;

$consulta = $conexion->query("SELECT 'id' FROM motos_usuarios");
$cuentaMotos = $consulta->num_rows;

$consulta = $conexion->query("SELECT 'id_producto' FROM productos");
$cuentaProductos = $consulta->num_rows;

$consulta = $conexion->query("SELECT 'id_cita' FROM citas WHERE completada = 0");
$cuentaCitas = $consulta->num_rows;

$consulta = $conexion->query("SELECT 'id_venta' FROM ventas WHERE completada = 0");
$cuentaVentas = $consulta->num_rows;

$consulta = $conexion->query("SELECT 'id_mensaje' FROM mensajes WHERE leido = 0");
$cuentaMensajes = $consulta->num_rows;

// Comprobamos si el usario está logueado
// Si no lo está, se le redirecciona al login
// Si lo está, definimos el botón de cerrar sesión y la duración de la sesión
if (!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Administrador') {
	header('Location: administrar.php');
} else {
	$estado = $_SESSION['estado'];
	require('recursos/sesiones.php');
	$usuario = $_SESSION['usuario'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="../recursos/imagenes/logo.png" />
	<title>Guevara MotorSport - Admin</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<!-- CSS para la parte administrador -->
	<link href="../css/sidebar-admin.css" rel="stylesheet">
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<div class="navbar-nav" style="height: 95%">
				<hr class="sidebar-divider my-0">
				<li class="nav-item active">
					<a class="nav-link" href="dashboard.php">
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
							<a class="collapse-item" href="users/usuarios.php">Usuarios</a>
							<a class="collapse-item" href="users/usuarios_vehiculos.php">Vehículos</a>
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="vehicles/vehiculos.php">
						<i class="fas fa-motorcycle"></i>
						<span>Modelos Vehículos</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="products/productos.php">
						<i class="fas fa-shopping-cart"></i>
						<span>Productos en venta</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="tasks/citas.php">
						<i class="fas fa-wrench"></i>
						<span>Citas Taller</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="sales/pedidos.php">
						<i class="fas fa-coins"></i>
						<span>Pedidos</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="messages/mensajes.php">
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
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
					<div class="row">

						<!-- Contador Vehículos -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nº de Motos asociadas a Usuarios</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaMotos) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-motorcycle fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Contador Usuarios -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nº de Usuarios Registrados</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaUsuarios) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-users fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Contador Productos -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nº de Productos en Venta</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaProductos) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Contador Citas Pendientes -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Citas Pendientes</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaCitas) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-wrench fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">

						<!-- Contador Pedidos Pendientes -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pedidos Pendientes</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaVentas) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-coins fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Contador Mensajes Pendientes -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mensajes sin leer</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800"><?php print($cuentaMensajes) ?></div>
										</div>
										<div class="col-auto">
											<i class="fas fa-comment-alt fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
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
					<a class="btn btn-primary" href="recursos/salir.php">Cerrar Sesión</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap y jQuery JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- JS para la parte administrado r-->
	<script src="../js/sidebar-admin.min.js"></script>

</body>

</html>