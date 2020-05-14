<?php
require_once('../recursos/conexionBD.php');

$query = "INSERT INTO `motos`(`modelo`, `cilindrada`) VALUES ($_POST[modelo], $_POST[cilindrada])";

if ($conexion->query($query) === TRUE) {
    die('exito');
} else {
    die();
}
