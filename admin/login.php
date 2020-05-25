<?php
session_start();
require('recursos/sesiones.php');
error_reporting(E_ALL ^ E_NOTICE);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- BootStrap y FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- CSS Propio -->
    <link rel="stylesheet" href="../css/estilos.css" />
    <link rel="icon" type="image/png" href="../recursos/imagenes/logo.png" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Guevara MotorSport - Admin</title>
</head>

<body class="fondoLisoColor">
    <div class="login-form">
        <div class="container">
            <form action="" method="post" id="acceso" class="form_admin">
                <div class="title-form">
                    <h1 class="h1_admin">Iniciar sesion</h1>
                </div>
                <br>
                <div class="form-row center">
                    <input type="text" name="email" id="email" class="input_admin noFocus" placeholder="Correo electrónico">
                </div>
                <br>
                <div class="form-row center">
                    <input type="password" name="contrasenna" id="contrasenna" class="input_admin noFocus" placeholder="Contraseña">
                </div>
                <br>
                <div class="form-row center">
                    <button type="submit" class="btn login-admin noFocus">Login</button>
                </div>
            </form>
        </div>
    </div>

    <div id="response"></div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted"><a href="../index.php">Regresar a la página principal</a></span>
        </div>
    </footer>


    <script>
        // Cuando el formulario con ID acceso se envíe...
        $("#acceso").on("submit", function(e) {
            // Evitamos que se envíe por defecto
            e.preventDefault();
            // Creamos un FormData con los datos del mismo formulario
            var formData = new FormData(document.getElementById("acceso"));

            $.ajax({
                url: "recursos/verificar.php?action=admin",
                type: "POST",
                dataType: "HTML",
                data: formData,
                // Deshabilitamos el caché
                cache: false,
                // No especificamos el contentType
                contentType: false,
                // No permitimos que los datos pasen como un objeto
                processData: false
            }).done(function(echo) {
                // Una vez que recibimos respuesta
                // comprobamos si la respuesta no es vacía
                if (echo !== "") {
                    // Si hay respuesta (error), mostramos el mensaje
                    $("#response").text(echo);
                } else {
                    // Si no hay respuesta, redirecionamos a donde sea necesario
                    // Si está vacío, recarga la página 
                    window.location.replace("");
                }
            });
        });
    </script>

</body>

</html>