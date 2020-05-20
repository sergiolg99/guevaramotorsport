<?php
require_once('../admin/recursos/conexionBD.php');

$id = $_POST['id'];

$citaTerminada = "UPDATE `reparaciones` SET completada=1 WHERE id='$id'";

if ($conexion->query($citaTerminada) === TRUE) {
    die('exito');
} else {
    die('error');
}