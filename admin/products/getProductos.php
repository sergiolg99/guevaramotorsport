<?php
require_once('../recursos/conexionBD.php');

$consulta = "SELECT `id_producto`, `nombre`, `precio`, `descripcion`, `stock`, `is_active` FROM `productos` WHERE is_active = 1";
$resultado = mysqli_query($conexion, $consulta);

$datos = [];

// Guardamos en un array bidimensional todos los datos de la consulta
$i = 0;

while ($fila = $resultado->fetch_assoc()) {
    $datos[$i] = $fila;
    $i++;
}

echo json_encode($datos);