<?php
require_once('../recursos/conexionBD.php');

if (isset($_POST['is_admin'])) {
    $admin = $_POST['is_admin'];
} else {
    $admin = 0;
}

$updateUsuario = "UPDATE `usuarios` SET email='$_POST[email]', nombre='$_POST[nombre]', 
        apellidos='$_POST[apellidos]', direccion='$_POST[direccion]', localidad='$_POST[localidad]', provincia='$_POST[provincia]', 
        cp='$_POST[cp]', telefono='$_POST[telefono]', is_admin=$admin WHERE id_usuario='$_GET[id]'";

if ($conexion->query($updateUsuario) === TRUE) {
    die('exito');
} else {
    die();
}
