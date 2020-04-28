<?php
if (isset($_POST['email'])) {

    $email_to = "info@guevaramotorsport.com";
    $email_subject = "Contacto desde el sitio web";

    // Aquí se deberían validar los datos ingresados por el usuario
    if (!isset($_POST['nombre']) || !isset($_POST['email']) || !isset($_POST['mensaje'])) {
        die();
    }

    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: " . $_POST['nombre'] . "\n";
    $email_message .= "E-mail: " . $_POST['email'] . "\n";
    $email_message .= "Mensaje: " . $_POST['mensaje'] . "\n\n";


    // Ahora se envía el e-mail usando la función mail() de PHP
    $headers = 'De: '.$email_from."\r\n" . 'Reply-To: '.$email_from."\r\n" . 'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
}