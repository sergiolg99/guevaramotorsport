<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_usuario'];
$borrarUsuario = "DELETE FROM `usuarios` WHERE `id_usuario` = $id";
$resultado = $conexion->query($borrarUsuario);

if ($conexion->query($query) === TRUE) {
    die('exito');
} else {
    die('error');
}
