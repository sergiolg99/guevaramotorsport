<?php
require_once('../recursos/conexionBD.php');

if (isset($_POST['is_active'])) {
    $active = $_POST['is_active'];
} else {
    $active = 0;
}

$updateVehiculo = "UPDATE `motos` SET modelo='$_POST[modelo]', cilindrada='$_POST[cilindrada]', is_active='$active' 
WHERE id_moto='$_GET[id]'";

if ($conexion->query($updateVehiculo) === TRUE) {
    die('exito');
} else {
    die();
}
