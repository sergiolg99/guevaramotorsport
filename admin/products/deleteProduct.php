<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_producto'];
$borrarProducto = "DELETE FROM `productos` WHERE `id_producto` = $id";


if ($conexion->query($borrarProducto) === TRUE) {
    die('exito');
} else {
    die('error');
}
