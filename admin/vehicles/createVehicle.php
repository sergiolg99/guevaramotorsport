<?php
require_once('../recursos/conexionBD.php');

$buscarMoto = "SELECT `id_moto` FROM motos WHERE (modelo = '$_POST[modelo]') AND (cilindrada = '$_POST[cilindrada]')";
$resultado = $conexion->query($buscarMoto);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    $query = "INSERT INTO `motos`(`modelo`, `cilindrada`) VALUES ($_POST[modelo], $_POST[cilindrada])";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
}
