<?php
require_once('../recursos/conexionBD.php');

$usuario = $_POST['usuario']; 
$moto = $_POST['moto'];
$year = $_POST['year'];
$matricula = strtoupper($_POST['matricula']);

$buscarMatricula = "SELECT matricula FROM motos_usuarios WHERE matricula = '$matricula' ";
$resultado = $conexion->query($buscarMatricula);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {

    $query = "INSERT INTO motos_usuarios (id_usuario, id_moto, matricula, year) VALUES ('$usuario', '$moto', '$matricula', '$year')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die('error');
    }
};
