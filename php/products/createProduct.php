<?php
require_once('../recursos/conexionBD.php');

$nombre = $_POST['nombre'];
if (!isset($_POST['is_active'])) 
$_POST['is_active'] = 0;

$buscarProducto = "SELECT 'nombre' FROM productos WHERE nombre = '$nombre'";
$resultado = $conexion->query($buscarProducto);
$existe = mysqli_num_rows($resultado);

if ($existe == 1) {
    die('existe');
} else {
    if (!isset($_FILES["imagen"])) {
        die('errorImagen');
    } else {
        // Verificamos si el tipo de archivo es un tipo de imagen permitido.
        // y que el tamaño del archivo no exceda los 16MB
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_kb = 16384;
    
        if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {
    
            // Archivo temporal
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
    
            // Tipo de archivo
            $tipo = $_FILES['imagen']['type'];
            
            //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
            $data = file_get_contents($imagen_temporal);
    
            // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
            $data = $conexion->real_escape_string($data);
    
            // Insertamos en la base de datos.
            $query = "INSERT INTO `productos`(`nombre`, `precio`, `descripcion`, `stock`, `imagen`, `is_active`) 
                        VALUES ('$_POST[nombre]', '$_POST[precio]', '$_POST[descripcion]', '$_POST[stock]', '$data', '$_POST[is_active]')";

            if ($conexion->query($query) === TRUE) {
                die('exito');
            } else {
                die();
            }
        }
        else {
            die('formato');
        }
    }
};
