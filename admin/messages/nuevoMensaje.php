<?php
require_once('../recursos/conexionBD.php');

$fecha = date("Y-m-d H:i:s");

if ($_POST['tipoUser'] == "cliente") {
    $query = "INSERT INTO `mensajes`(`id_usuario`, `asunto`, `fecha`, `mensaje`)
     VALUES ('$_POST[id_usuario]', '$_POST[asunto]', '$fecha', '$_POST[mensaje]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
} else if ($_POST['tipoUser'] == "visitante") {
    $buscarUsuario = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$_POST[email]') AND (registrado = '1')";
    $result = $conexion->query($buscarUsuario);
    $existe = mysqli_num_rows($result);

    if ($existe == 1) {
        die('existe');
    } else {
        $buscarUsuario2 = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$_POST[email]') AND (registrado = '0')";
        $resultado = $conexion->query($buscarUsuario2);
        $existe2 = mysqli_num_rows($resultado);

        if ($existe2 == 1) {
            $consulta3 = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$_POST[email]'";
            $resultado2 = mysqli_query($conexion, $consulta3);
            $fila2 = mysqli_fetch_array($resultado2);

            $query2 = "INSERT INTO `mensajes`(`id_usuario`, `asunto`, `fecha`, `mensaje`) 
            VALUES ('$fila2[id_usuario]', '$_POST[asunto]', '$fecha', '$_POST[mensaje]')";
        } else {
            $query3 = "INSERT INTO `usuarios`(`email`, `nombre`, `telefono`, `registrado`) VALUES ('$_POST[email]', '$_POST[nombre]', '$_POST[telefono]', '0')";

            if ($conexion->query($query3) === TRUE) {
                $consulta3 = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$_POST[email]'";
                $resultado3 = mysqli_query($conexion, $consulta3);
                $fila2 = mysqli_fetch_array($resultado3);

                $query2 = "INSERT INTO `mensajes`(`id_usuario`, `asunto`, `fecha`, `mensaje`) 
                VALUES ('$fila2[id_usuario]', '$_POST[asunto]', '$fecha', '$_POST[mensaje]')";
            }
        }

        if ($conexion->query($query2) === TRUE) {
            die('exito');
        } else {
            die();
        }
    }
}
