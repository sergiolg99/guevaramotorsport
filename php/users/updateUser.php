<?php
require_once('../recursos/conexionBD.php');

$id = $_GET['id_usuario'];

$admin = $_POST['is_admin'];
if ($admin == "on") {
    $admin = 1;
} else {
    $admin = 0;
}

$updateUsuario = "UPDATE `usuarios` SET `email`= $_POST[email], `password`= $_POST[password], `nombre`= $_POST[nombre], 
`apellidos`= $_POST[apellidos], `direccion`= $_POST[direccion], `localidad`= $_POST[localidad], `provincia`= $_POST[provincia], 
`cp`= $_POST[cp], `dni`= $_POST[dni], `is_admin`= $admin WHERE id_usuario = '$id' ";

if ($conexion->query($updateUsuario) === TRUE) {
    die('exito');
} else {
    die();
}
