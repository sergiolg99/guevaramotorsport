<?php
require_once('../recursos/conexionBD.php');

$email = $_POST['email'];
if (!isset($_POST['is_admin'])) 
$_POST['is_admin'] = 0;

$buscarUsuario = "SELECT * FROM usuarios WHERE email = '$email' ";
$resultado = $conexion->query($buscarUsuario);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {

    $query = "INSERT INTO usuarios (email, password, nombre, apellidos, direccion, localidad, provincia, cp, dni, is_admin) 
        VALUES ('$email', '$_POST[password]', '$_POST[nombre]', '$_POST[apellidos]', '$_POST[direccion]', '$_POST[localidad]', 
        '$_POST[provincia]', '$_POST[cp]', '$_POST[dni]', '$_POST[is_admin]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
};
