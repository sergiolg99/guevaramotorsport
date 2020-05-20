<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$buscaCita = "SELECT `id`, `completada` FROM `citas` WHERE id='$id'";
$resultado = mysqli_query($conexion, $buscaCita);
$datos = mysqli_fetch_array($resultado);

if ($datos['completada'] == 0) {
    $citaTerminada = "UPDATE `citas` SET completada=1 WHERE id='$id'";
} else {
    $citaTerminada = "UPDATE `citas` SET completada=0 WHERE id='$id'";
}

if ($conexion->query($citaTerminada) === TRUE) {
    die('exito');
} else {
    die('error');
}
