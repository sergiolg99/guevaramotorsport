<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_usuario'];
$borrarUsuario = "DELETE FROM `usuarios` WHERE `id_usuario` = $id";

if ($conexion->query($borrarUsuario) === TRUE) {
    $borrarRelacion = "DELETE FROM `motos_usuarios` WHERE `id_usuario` = $id";

    if ($conexion->query($borrarRelacion) === TRUE) {
        die('exito');
    }
} else {
    die('error');
}
