<?php
require_once('../recursos/conexionBD.php');
/* ini_set( 'display_errors', 1 ); */

if ($_POST['tipoUser'] == "cliente") {

    $query = "INSERT INTO `citas`(`id_usuario`, `id_moto`, `fecha`, `comentarios`)
            VALUES ('$_POST[id_usuario]', '$_POST[moto]', '$_POST[fecha]', '$_POST[comentarios]')";

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

            $query2 = "INSERT INTO `citas`(`id_usuario`, `id_moto`, `fecha`, `comentarios`) 
                VALUES ('$fila2[id_usuario]', '$_POST[moto]', '$_POST[fecha]', '$_POST[comentarios]')";

        } else {
            $query3 = "INSERT INTO `usuarios`(`email`, `nombre`, `telefono`, `registrado`) VALUES ('$_POST[email]', '$_POST[nombre]', '$_POST[telefono]', '0')";

            if ($conexion->query($query3) === TRUE) {
                $consulta3 = "SELECT `id_usuario` FROM `usuarios` WHERE email = '$_POST[email]'";
                $resultado3 = mysqli_query($conexion, $consulta3);
                $fila2 = mysqli_fetch_array($resultado3);

                $query2 = "INSERT INTO `citas`(`id_usuario`, `id_moto`, `fecha`, `comentarios`) 
                VALUES ('$fila2[id_usuario]', '$_POST[moto]', '$_POST[fecha]', '$_POST[comentarios]')";
            }
        }

        if ($conexion->query($query2) === TRUE) {
            die('exito');
        } else {
            die();
        }
    }
}
 /* $email_from = "sergioladrondeguevara@hotmail.com";
    $email_to = $_POST['email'];
    $email_subject = "Cita taller Guevara MotorSport";

    $email_message = "Detalles de la cita:\n\n";
    $email_message .= "Nombre: " . $_POST['nombre'] . "\n";
    $email_message .= "E-mail: " . $_POST['email'] . "\n";
    $email_message .= "Dia y hora de la cita: " . $_POST['fecha'] . "\n";
    $email_message .= "Comentarios: " . $_POST['comentarios'] . "\n\n";

    $headers = 'De: ' . $email_from;

    mail($email_to, $email_subject, $email_message, $headers); */