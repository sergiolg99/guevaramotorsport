<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_usuario'];
$borrarUsuario = "DELETE FROM `usuarios` WHERE `id_usuario` = $id";


if ($conexion->query($borrarUsuario) === TRUE) {
    die('exito');
} else {
    die('error');
}