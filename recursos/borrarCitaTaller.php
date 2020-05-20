<?php
require_once('../admin/recursos/conexionBD.php');

$id = $_POST['id'];
$borrarCitaTaller = "DELETE FROM `reparaciones` WHERE `id` = $id";


if ($conexion->query($borrarCitaTaller) === TRUE) {
    die('exito');
} else {
    die('error');
}
