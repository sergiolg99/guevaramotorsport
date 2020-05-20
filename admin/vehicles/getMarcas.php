<?php
require_once('../recursos/conexionBD.php');

$query = "SELECT id,nombre FROM moto_makers WHERE is_active = 1 ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar fabricante...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
}
