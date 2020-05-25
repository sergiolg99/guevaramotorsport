<?php
require_once('./recursos/conexionBD.php');

$fecha = date("Y-m-d H:i:s");

$consulta = "INSERT INTO `mensajes`(`nombre`, `email`, `telefono`, `asunto`, `mensaje`, `fecha`) 
VALUES ('$_POST[nombre]', '$_POST[email]', '$_POST[telefono]', '$_POST[asunto]' , '$_POST[mensaje]', '$fecha')";

if ($conexion->query($consulta) === TRUE) {
    die('exito');
} else {
    die();
}
