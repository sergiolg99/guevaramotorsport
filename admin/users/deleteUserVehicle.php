<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$borrarRelacion = "DELETE FROM `motos_usuarios` WHERE `id_motosUsuarios` = $id";

if ($conexion->query($borrarRelacion) === TRUE) {
    die('exito');
} else {
    die('error');
}
