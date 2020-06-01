<?php
require_once('../recursos/conexionBD.php');

/* Selecciona las marcas existentes que hay en los vehiculos creados */
$query = "SELECT distinct moto_makers.nombre, moto_makers.id_maker FROM motos 
INNER JOIN moto_models on motos.modelo = moto_models.id_model
INNER JOIN moto_makers on moto_models.fabricante = moto_makers.id_maker 
WHERE moto_makers.is_active = 1 ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar fabricante...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id_maker"] . '">' . $fila["nombre"] . '</option>';
}
