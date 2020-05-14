<?php
require_once('../recursos/conexionBD.php');

$email = $_POST['email'];
$admin = $_POST['is_admin'];
if ($admin == true) {
    $admin = 1;
}

$buscarUsuario = "SELECT * FROM usuarios WHERE email = '$email' ";
$resultado = $conexion->query($buscarUsuario);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    $direccionCompleta = $_POST['direccion'] . ", " . $_POST['localidad'] . ", " . $_POST['provincia'] . ", " . $_POST['CP'];

    $query = "INSERT INTO usuarios (email, password, nombre, apellidos, direccion, dni, is_admin) 
        VALUES ('$email', '$_POST[password]', '$_POST[nombre]', '$_POST[apellidos]', '$direccionCompleta', '$_POST[dni]', '$admin')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
};
