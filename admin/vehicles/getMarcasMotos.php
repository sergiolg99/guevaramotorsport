<?php
require_once('../recursos/conexionBD.php');

$query = "SELECT distinct moto_makers.nombre, moto_makers.id FROM motos 
INNER JOIN moto_models on motos.modelo = moto_models.id
INNER JOIN moto_makers on moto_models.fabricante = moto_makers.id ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar fabricante...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
}
