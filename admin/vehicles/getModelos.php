<?php
require_once('../recursos/conexionBD.php');

$fabricante = $_POST['fabricante'];

if (isset($_GET['action']) and $_GET['action'] == "exist") {
    /* Selecciona los modelos existentes que hay en los vehiculos creados */
    $consulta = "SELECT distinct moto_models.nombre, moto_models.id_model FROM motos 
    INNER JOIN moto_models ON motos.modelo = moto_models.id_model
    WHERE (moto_models.fabricante = '$fabricante') AND (moto_models.is_active = 1)
    ORDER BY nombre";
} else {
    /* Selecciona todos los modelos introducidas en la tabla moto_models */
    $consulta = "SELECT id_model,nombre FROM moto_models WHERE (fabricante = '$fabricante') AND (is_active = 1)
    ORDER BY nombre";
}

$resultado = mysqli_query($conexion, $consulta);
echo '<option value="0">Seleccionar modelo...</option>';

while ($fila = mysqli_fetch_array($resultado)) {
    echo '<option value="' . $fila["id_model"] . '">' . $fila["nombre"] . '</option>';
}
