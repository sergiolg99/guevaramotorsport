<?php
require_once('../recursos/conexionBD.php');

$id = $_GET['id'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if ($password1 != "" && $password1 === $password2) {
    $password = sha1($password1);

    $changePassword = "UPDATE `usuarios` SET password='$password' WHERE id_usuario='$id'";

    if ($conexion->query($changePassword) === TRUE) {
        die('exito');
    } else {
        die('error');
    }
}
