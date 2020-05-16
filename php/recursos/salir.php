<?php
session_start();
require_once('conexionBD.php');

//Des-establecemos todas las sesiones
unset($_SESSION);

//Destruimos las sesiones
session_destroy();

//Cerramos la conexión con la base de datos
mysqli_close($conexion);

//Redireccionamos a el index
header("Location: ../");
die();
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Cerrando sesión...</title>
</head>

<body>
</body>

</html>