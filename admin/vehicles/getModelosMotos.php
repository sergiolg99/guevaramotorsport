<?php
require_once('../recursos/conexionBD.php');

$fabricante = $_POST['fabricante'];

/* Selecciona los modelos existentes que hay en los vehiculos creados */
$query = "SELECT distinct moto_models.nombre, moto_models.id_model FROM motos 
INNER JOIN moto_models ON motos.modelo = moto_models.id_model
WHERE (moto_models.fabricante = '$fabricante') AND (moto_models.is_active = 1)
ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar modelo...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id_model"] . '">' . $fila["nombre"] . '</option>';
}
