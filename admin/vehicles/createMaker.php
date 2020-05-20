<?php
require_once('../recursos/conexionBD.php');


$buscarMarca = "SELECT nombre FROM moto_makers WHERE nombre = '$_POST[nombre]' ";
$resultado = $conexion->query($buscarMarca);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    $query = "INSERT INTO `moto_makers`(`nombre`) VALUES ('$_POST[nombre]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die('error');
    }
}