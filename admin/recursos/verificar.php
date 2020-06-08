<?php
require_once('conexionBD.php');

// Obtenemos los datos del formulario de acceso
$usuario = $_POST["email"];
$contrasenna = $_POST["contrasenna"];

$action = $_GET['action'];

// Filtro anti-XSS
$usuario = htmlspecialchars(mysqli_real_escape_string($conexion, $usuario));
$contrasenna = htmlspecialchars(mysqli_real_escape_string($conexion, $contrasenna));

// Codificamos la contraseña con sha1
$contrasenna = sha1($contrasenna);

// Buscamos la información del usuario en la BD
$consulta = "SELECT `id_usuario`, `email`, `password`, `nombre`, `is_admin` FROM `usuarios` WHERE email='$usuario'";

// Obtenemos los resultados
$resultado = mysqli_query($conexion, $consulta);
$datos = mysqli_fetch_array($resultado);

// Guardamos los resultados del nombre de usuario
// y de la contraseña de la base de datos
$userBD = $datos['email'];
$passwordBD = $datos['password'];
$is_admin = $datos['is_admin'];

if ($action == "cliente") {
    // Comprobamos si los datos son correctos
    if ($userBD == $usuario and $passwordBD == $contrasenna) {
        session_start();
        if (!isset($datos['nombre'])) {
            $_SESSION['usuario'] = $datos['email'];
        } else {
            $_SESSION['usuario'] = $datos['nombre'];
        }
        $_SESSION['id_usuario'] = $datos['id_usuario'];
        if ($is_admin == true) {
            $_SESSION['estado'] = 'Administrador';
        } else {
            $_SESSION['estado'] = 'Cliente';
        }
        /* Sesión iniciada */

        // Si los datos no son correctos, o están vacíos, muestra un error
    } else if ($userBD != $usuario || $usuario == "" || $contrasenna == "" || $passwordBD != $contrasenna) {
        die('Datos Incorrectos');
    } else {
        die('Error');
    }
} else if ($action == "admin") {
    // Comprobamos si los datos son correctos
    if ($userBD == $usuario and $passwordBD == $contrasenna and $is_admin == true) {
        session_start();
        $_SESSION['usuario'] = $datos['nombre'];
        $_SESSION['estado'] = 'Administrador';
        /* Sesión iniciada */

        // Si los datos no son correctos, o están vacíos, muestra un error
    } else if ($userBD != $usuario || $usuario == "" || $contrasenna == "" || $passwordBD != $contrasenna) {
        die('Datos Incorrectos');
    } else if ($is_admin == false) {
        die('Sin permiso de administrador');
    } else {
        die('Error');
    }
}
