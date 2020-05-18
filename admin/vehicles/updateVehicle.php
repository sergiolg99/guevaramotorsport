<?php
require_once('../recursos/conexionBD.php');

$updateVehicle = "UPDATE `motos` SET modelo='$_POST[modelo]',
cilindrada='$_POST[cilindrada]' WHERE id_moto='$_GET[id]'";

if ($conexion->query($updateVehicle) === TRUE) {
    die('exito');
} else {
    die();
}
