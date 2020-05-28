<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$buscaCita = "SELECT `id_cita`, `completada` FROM `citas` WHERE id_cita='$id'";
$resultado = mysqli_query($conexion, $buscaCita);
$datos = mysqli_fetch_array($resultado);

if ($datos['completada'] == 0) {
    $citaTerminada = "UPDATE `citas` SET completada=1 WHERE id_cita='$id'";
} else {
    $citaTerminada = "UPDATE `citas` SET completada=0 WHERE id_cita='$id'";
}

if ($conexion->query($citaTerminada) === TRUE) {
    die('exito');
} else {
    die('error');
}
