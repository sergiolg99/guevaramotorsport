<?php
require_once('../recursos/conexionBD.php');

$email = $_POST['email'];
$password = $_POST['password'];
if (!isset($_POST['is_admin']))
    $_POST['is_admin'] = 0;

$buscarUsuario = "SELECT 'id_usuario' FROM usuarios WHERE email = '$email'";
$resultado = $conexion->query($buscarUsuario);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {

    $password = sha1($password);

    if (!isset($_GET['action'])) {
        $query = "INSERT INTO usuarios (email, password, nombre, apellidos, direccion, localidad, provincia, cp, telefono, is_admin) 
        VALUES ('$email', '$password', '$_POST[nombre]', '$_POST[apellidos]', '$_POST[direccion]', '$_POST[localidad]', 
        '$_POST[provincia]', '$_POST[cp]', '$_POST[telefono]', '$_POST[is_admin]')";
    } else if ($_GET['action'] == "cliente") {
        $query = "INSERT INTO usuarios (email, password, is_admin) 
        VALUES ('$email', '$password', '$_POST[is_admin]')";
    }

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
};