<?php
require_once('conexionBD.php');

//Obtenemos los datos del formulario de acceso
$usuario = $_POST["email"];
$contrasenna = $_POST["contrasenna"];

//Filtro anti-XSS
$usuario = htmlspecialchars(mysqli_real_escape_string($conexion, $usuario));
$contrasenna = htmlspecialchars(mysqli_real_escape_string($conexion, $contrasenna));


//Escribimos la consulta necesaria
$consulta = "SELECT * FROM `usuarios` WHERE email='$usuario'";

//Obtenemos los resultados
$resultado = mysqli_query($conexion, $consulta);
$datos = mysqli_fetch_array($resultado);

//Guardamos los resultados del nombre de usuario
//y de la contraseña de la base de datos
$userBD = $datos['email'];
$passwordBD = $datos['password'];
$is_admin = $datos['is_admin'];

//Comprobamos si los datos son correctos
if ($userBD == $usuario and $passwordBD == $contrasenna and $is_admin == true) {

    session_start();
    $_SESSION['usuario'] = $datos['nombre'];
    $_SESSION['estado'] = 'Autenticado';

    /* Sesión iniciada */

    //Si los datos no son correctos, o están vacíos, muestra un error
} else if ($userBD != $usuario || $usuario == "" || $contrasenna == "" || $passwordBD != $contrasenna) {
    die('Datos Incorrectos');
} else if ($is_admin == false) {
    die('Sin permiso de administrador');
} else {
    die('Error');
}
