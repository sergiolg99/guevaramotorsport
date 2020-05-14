<?php
require_once('../recursos/conexionBD.php');

$id = $_POST['id_moto'];
$borrarVehiculo = "DELETE FROM `motos` WHERE `id_moto` = $id";


if ($conexion->query($borrarVehiculo) === TRUE) {
    die('exito');
} else {
    die('error');
}
