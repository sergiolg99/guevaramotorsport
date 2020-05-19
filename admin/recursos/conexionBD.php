<?php
// Carga la configuración 
$usuario = "sergio";
$contrasena = "desarrolloweb";
$servidor = "localhost";
$bd = "guevaramotorsport";

// Conexión a la Base de Datos 
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $bd);

// Si la conexión falla, aparece el error 
if($conexion === false) { 
    echo 'Ha habido un error <br>'.mysqli_connect_error(); 
}