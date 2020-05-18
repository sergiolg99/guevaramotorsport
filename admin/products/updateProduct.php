<?php
require_once('../recursos/conexionBD.php');

$id = $_GET['id'];

if (!isset($_POST['is_active'])) {
    $_POST['is_active'] = 0;
}

if (!isset($_FILES["imagen"])) {
    die('errorImagen');
} else {
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384;

    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {

        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $tipo = $_FILES['imagen']['type'];
        $data = file_get_contents($imagen_temporal);
        $data = $conexion->real_escape_string($data);

        // Insertamos en la base de datos.
        $updateProducto = "UPDATE `productos` SET nombre='$_POST[nombre]', precio='$_POST[precio]', descripcion='$_POST[descripcion]',
        stock='$_POST[stock]', imagen='$data', is_active='$_POST[is_active]' WHERE id_producto='$id'";

        if ($conexion->query($updateProducto) === TRUE) {
            die('exito');
        } else {
            die();
        }
    } else {
        die('formato');
    }
}
