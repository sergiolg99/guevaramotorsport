<?php
require_once('../recursos/conexionBD.php');

if (!isset($_POST['is_admin'])) {
    $_POST['is_admin'] = 0;
}

$updateUsuario = "UPDATE `usuarios` SET `email`= $_POST[email], `password`= $_POST[password], `nombre`= $_POST[nombre], 
`apellidos`= $_POST[apellidos], `direccion`= $_POST[direccion], `localidad`= $_POST[localidad], `provincia`= $_POST[provincia], 
`cp`= $_POST[cp], `dni`= $_POST[dni], `is_admin`= $_POST[is_admin] WHERE id_usuario = '$_GET[id_usuario]' ";

if ($conexion->query($updateUsuario) == TRUE) {
    die('exito');
} else {
    die();
}
