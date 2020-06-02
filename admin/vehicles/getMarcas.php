<?php
require_once('../recursos/conexionBD.php');

if (isset($_GET['action']) and $_GET['action'] == "exist") {
    /* Selecciona las marcas existentes que hay en los vehiculos creados */
    $consulta = "SELECT distinct moto_makers.nombre, moto_makers.id_maker FROM motos 
    INNER JOIN moto_models on motos.modelo = moto_models.id_model
    INNER JOIN moto_makers on moto_models.fabricante = moto_makers.id_maker 
    WHERE moto_makers.is_active = 1 ORDER BY nombre";
} else {
    /* Selecciona todas las marcas introducidas en la tabla moto_makers */
    $consulta = "SELECT id_maker,nombre FROM moto_makers WHERE is_active = 1 ORDER BY nombre";
}

$resultado = mysqli_query($conexion, $consulta);
echo '<option value="0">Seleccionar fabricante...</option>';

while ($fila = mysqli_fetch_array($resultado)) {
    echo '<option value="' . $fila["id_maker"] . '">' . $fila["nombre"] . '</option>';
}
