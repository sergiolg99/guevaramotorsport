<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$anularPedido = "DELETE FROM `ventas` WHERE `id_venta`=$id";


if ($conexion->query($anularPedido) === TRUE) {
    die('exito');
} else {
    die('error');
}
