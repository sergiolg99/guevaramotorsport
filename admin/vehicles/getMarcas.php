<?php
require_once('../recursos/conexionBD.php');

/* Selecciona todas las marcas introducidas en la tabla moto_makers */
$query = "SELECT id_maker,nombre FROM moto_makers WHERE is_active = 1 ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar fabricante...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id_maker"] . '">' . $fila["nombre"] . '</option>';
}
