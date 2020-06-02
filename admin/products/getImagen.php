<?php
require_once('../recursos/conexionBD.php');

$id = $_GET['id'];

if ($id != 0) {
    $consulta = "SELECT imagen FROM productos WHERE id_producto = '$id'";
    $resultado = mysqli_query($conexion, $consulta);
    $datos = mysqli_fetch_array($resultado);

    $imagen = $datos['imagen']; // Datos binarios de la imagen.
    echo $imagen;
}
