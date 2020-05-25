<?php
require_once('./recursos/conexionBD.php');

$consulta = "INSERT INTO `mensajes`(`nombre`, `email`, `telefono`, `asunto`, `mensaje`) 
VALUES ('$_POST[nombre]', '$_POST[email]', '$_POST[telefono]', '$_POST[asunto]' , '$_POST[mensaje]')";

if ($conexion->query($consulta) === TRUE) {
    die('exito');
} else {
    die();
}
