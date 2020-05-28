<?php
require_once('../recursos/conexionBD.php');

$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password);
if (!isset($_POST['is_admin']))
    $_POST['is_admin'] = 0;

$buscarUsuario = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$email') AND (registrado = '1')";
$resultado = $conexion->query($buscarUsuario);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    $buscarUsuario2 = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$email') AND (registrado = '0')";
    $resultado2 = $conexion->query($buscarUsuario2);
    $existe2 = mysqli_num_rows($resultado2);

    if ($existe2 == 1) {
        $consulta = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$email'";
        $resultado3 = mysqli_query($conexion, $consulta);
        $fila = mysqli_fetch_array($resultado3);

        if (!isset($_GET['action'])) {
            $query = "UPDATE `usuarios` SET `password`='$password',`nombre`='$_POST[nombre]',`apellidos`='$_POST[apellidos]',`direccion`='$_POST[direccion]',`localidad`='$_POST[localidad]',
            `provincia`='$_POST[provincia]',`cp`='$_POST[cp]',`telefono`='$_POST[telefono]',`is_admin`='$_POST[is_admin]',`registrado`='1' WHERE email = '$email'";
        } else if ($_GET['action'] == "cliente") {
            $query = "UPDATE `usuarios` SET `password`='$password',`registrado`='1' WHERE email = '$email'";
        }

        if ($conexion->query($query) === TRUE) {
            die('exito');
        } else {
            die();
        }
    } else {
        if (!isset($_GET['action'])) {
            $query = "INSERT INTO usuarios (email, password, nombre, apellidos, direccion, localidad, provincia, cp, telefono, is_admin) 
            VALUES ('$email', '$password', '$_POST[nombre]', '$_POST[apellidos]', '$_POST[direccion]', '$_POST[localidad]', 
            '$_POST[provincia]', '$_POST[cp]', '$_POST[telefono]', '$_POST[is_admin]')";
        } else if ($_GET['action'] == "cliente") {
            $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$password')";
        }

        if ($conexion->query($query) === TRUE) {
            die('exito');
        } else {
            die();
        }
    }
};
