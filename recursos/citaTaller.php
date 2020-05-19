<?php
require_once('../admin/recursos/conexionBD.php');
/* ini_set( 'display_errors', 1 ); */

if ($_POST['tipoUser'] == "cliente") {

    $query = "INSERT INTO `reparaciones`(`id_usuario`, `id_moto`, `fecha`, `comentarios`, `nombre`, `email`, `telefono`)
            VALUES ('$_POST[id_usuario]', '$_POST[moto]', '$_POST[fecha]', '$_POST[comentarios]', '$_POST[nombre]', '$_POST[email]', '$_POST[telefono]')";

    if ($conexion->query($query) === TRUE) {
        die('exito');
    } else {
        die();
    }
} else if ($_POST['tipoUser'] == "visitante") {

    $query = "INSERT INTO `reparaciones`(`id_moto`, `fecha`, `comentarios`, `nombre`, `email`, `telefono`) 
            VALUES ('$_POST[moto]', '$_POST[fecha]', '$_POST[comentarios]', '$_POST[nombre]', '$_POST[email]', '$_POST[telefono]')";

    if ($conexion->query($query) === TRUE) {
       /*  $email_from = "sergioladrondeguevara@hotmail.com";
        $email_to = $_POST['email'];
        $email_subject = "Cita taller Guevara MotorSport";

        $email_message = "Detalles de la cita:\n\n";
        $email_message .= "Nombre: " . $_POST['nombre'] . "\n";
        $email_message .= "E-mail: " . $_POST['email'] . "\n";
        $email_message .= "Dia y hora de la cita: " . $_POST['fecha'] . "\n";
        $email_message .= "Comentarios: " . $_POST['comentarios'] . "\n\n";

        $headers = 'De: ' . $email_from;

        mail($email_to, $email_subject, $email_message, $headers); */

        die('exito');
    } else {
        die();
    }
}
