<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$anularPedido = "DELETE FROM `ventas` WHERE `id_venta`=$id";

if ($conexion->query($anularPedido) === TRUE) {

    $borrarRelacion = "DELETE FROM `venta_productos` WHERE `id_venta`=$id";

    if ($conexion->query($borrarRelacion) === TRUE) {
        die('exito');
    }
} else {
    die('error');
}
