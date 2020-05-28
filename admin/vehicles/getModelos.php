<?php
require_once('../recursos/conexionBD.php');

$fabricante = $_POST['fabricante'];

$query = "SELECT id_model,nombre FROM moto_models WHERE (fabricante = '$fabricante') AND (is_active = 1)
ORDER BY nombre";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar modelo...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id_model"] . '">' . $fila["nombre"] . '</option>';
}
