<?php
require_once('../recursos/conexionBD.php');

$modelo = $_POST['modelo'];

$query = "SELECT id_moto,cilindrada FROM motos 
WHERE (modelo = '$modelo') AND (is_active = 1)
ORDER BY cilindrada";

$result = mysqli_query($conexion, $query);
echo '<option value="0">Seleccionar cilindrada...</option>';

while ($fila = mysqli_fetch_array($result)) {
    echo '<option value="' . $fila["id_moto"] . '">' . $fila["cilindrada"] . '</option>';
}
