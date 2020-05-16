<?php
require_once('../recursos/conexionBD.php');

$id = $_GET['id'];

if ($id != 0) {
    $consulta = "SELECT imagen FROM productos WHERE id_producto = '$id'";
    $result = mysqli_query($conexion, $consulta);
    $datos = mysqli_fetch_array($result);

    $imagen = $datos['imagen']; // Datos binarios de la imagen.
    echo $imagen;
}
