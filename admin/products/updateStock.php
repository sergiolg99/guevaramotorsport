<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_producto'];
$action = $_POST['action'];

$buscaStock = "SELECT `stock` FROM `productos` WHERE id_producto = $id";
$result = mysqli_query($conexion, $buscaStock);
$datos = mysqli_fetch_array($result);

$stockMas = $datos['stock'] +1;
$stockMenos = $datos['stock'] -1;

if ($action == "mas") {
    $updateStock = "UPDATE `productos` SET stock='$stockMas' WHERE id_producto='$id'";
} else if ($action == "menos") {
    $updateStock = "UPDATE `productos` SET stock='$stockMenos' WHERE id_producto='$id'";
}

if ($conexion->query($updateStock) === TRUE) {
    die('exito');
} else {
    die();
}
