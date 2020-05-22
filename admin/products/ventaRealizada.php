<?php
require_once('../recursos/conexionBD.php');

$data = json_decode(stripslashes($_POST['data']));

foreach ($data as $producto) {
    $buscaStock = "SELECT `stock` FROM `productos` WHERE id_producto = $producto";
    $result = mysqli_query($conexion, $buscaStock);
    $datos = mysqli_fetch_array($result);

    $stockMenos = $datos['stock'] - 1;
    $updateStock = "UPDATE `productos` SET stock='$stockMenos' WHERE id_producto='$producto'";
    $resultado = mysqli_query($conexion, $updateStock);
}

die("exito");