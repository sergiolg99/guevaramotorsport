<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$borrarMensaje = "DELETE FROM `mensajes` WHERE `id_mensaje`=$id";


if ($conexion->query($borrarMensaje) === TRUE) {
    die('exito');
} else {
    die('error');
}
