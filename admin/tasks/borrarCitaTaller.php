<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id'];
$borrarCitaTaller = "DELETE FROM `citas` WHERE `id_cita` = $id";

if ($conexion->query($borrarCitaTaller) === TRUE) {
    die('exito');
} else {
    die('error');
}
