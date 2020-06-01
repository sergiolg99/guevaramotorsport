<?php
require_once('../recursos/conexionBD.php');

$fecha = date("Y-m-d H:i:s");

/* Si el mensaje lo manda un usuario registrado */
if ($_POST['tipoUser'] == "cliente") {
    $query = "INSERT INTO `mensajes`(`id_usuario`, `asunto`, `fecha`, `mensaje`)
     VALUES ('$_POST[id_usuario]', '$_POST[asunto]', '$fecha', '$_POST[mensaje]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }

} else if ($_POST['tipoUser'] == "visitante") {
    /* Si el mensaje lo manda un usuario NO registrado */ 
    /* Buscamos si el correo introducido pertenece a un usuario registrado */
    $buscarUsuario = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$_POST[email]') AND (registrado = '1')";
    $result = $conexion->query($buscarUsuario);
    $existe = mysqli_num_rows($result);

    /* Si pertenece a un usuario registrado se le pide que inicie sesión primero */
    if ($existe == 1) {
        die('existe');
    } else {
        /* Buscamos si el correo introducido pertenece a un usuario NO registrado */
        $buscarUsuario2 = "SELECT 'id_usuario' FROM usuarios WHERE (email = '$_POST[email]') AND (registrado = '0')";
        $resultado = $conexion->query($buscarUsuario2);
        $existe2 = mysqli_num_rows($resultado);

        /* Si existe, seleccionamos el id de dicho usuario */
        if ($existe2 == 1) {
            $consulta3 = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$_POST[email]'";
            $resultado2 = mysqli_query($conexion, $consulta3);
            $fila2 = mysqli_fetch_array($resultado2);

            /* Creamos el mensaje y lo asociamos al usuario */
            $query2 = "INSERT INTO `mensajes`(`id_usuario`, `asunto`, `fecha`, `mensaje`) 
            VALUES ('$fila2[id_usuario]', '$_POST[asunto]', '$fecha', '$_POST[mensaje]')";

        } else {
            /* Si no existe usuario con ese email, creamos un usuario nuevo con los datos pasados en el formulario */
            $query3 = "INSERT INTO `usuarios`(`email`, `nombre`, `telefono`, `registrado`) VALUES ('$_POST[email]', '$_POST[nombre]', '$_POST[telefono]', '0')";

            if ($conexion->query($query3) === TRUE) {
                /* Seleccionamos el id del usuario recien creado */
                $consulta3 = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$_POST[email]'";
                $resultado3 = mysqli_query($conexion, $consulta3);
                $fila2 = mysqli_fetch_array($resultado3);

                /* Creamos el mensaje y lo asociamos al usuario recien creado */
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
