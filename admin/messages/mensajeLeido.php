<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$buscaMensaje = "SELECT `id_mensaje`, `leido` FROM `mensajes` WHERE id_mensaje='$id'";
$resultado = mysqli_query($conexion, $buscaMensaje);
$datos = mysqli_fetch_array($resultado);

if ($datos['leido'] == 0) {
    $mensajeLeido = "UPDATE `mensajes` SET leido=1 WHERE id_mensaje='$id'";
} else {
    $mensajeLeido = "UPDATE `mensajes` SET leido=0 WHERE id_mensaje='$id'";
}

if ($conexion->query($mensajeLeido) === TRUE) {
    die('exito');
} else {
    die('error');
}
