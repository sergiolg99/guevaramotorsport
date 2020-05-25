<?php
require_once('../recursos/conexionBD.php');

$buscarModelo = "SELECT nombre FROM moto_models WHERE nombre = '$_POST[nombre]' ";
$resultado = $conexion->query($buscarModelo);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    $query = "INSERT INTO `moto_models`(`nombre`, `fabricante`) VALUES ('$_POST[nombre]', '$_POST[fabricante]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die('error');
    }
}
