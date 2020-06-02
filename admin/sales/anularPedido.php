<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$anularPedido = "DELETE FROM `ventas` WHERE `id_venta`=$id";

if ($conexion->query($anularPedido) === TRUE) {
    /* Al borrar un pedido, se borra tambien los productos que tuviese relacionados */
    $borrarRelacion = "DELETE FROM `venta_productos` WHERE `id_venta`=$id";

    if ($conexion->query($borrarRelacion) === TRUE) {
        die('exito');
    }
} else {
    die('error');
}
