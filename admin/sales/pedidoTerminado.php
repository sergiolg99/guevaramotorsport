<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$buscaPedido = "SELECT `id_venta`, `completada` FROM `ventas` WHERE id_venta='$id'";
$resultado = mysqli_query($conexion, $buscaPedido);
$datos = mysqli_fetch_array($resultado);

if ($datos['completada'] == 0) {
    $pedidoTerminado = "UPDATE `ventas` SET completada=1 WHERE id_venta='$id'";
} else {
    $pedidoTerminado = "UPDATE `ventas` SET completada=0 WHERE id_venta='$id'";
}

if ($conexion->query($pedidoTerminado) === TRUE) {
    die('exito');
} else {
    die('error');
}
