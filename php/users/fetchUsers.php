<?php
require_once('../recursos/conexionBD.php');
header('Content-Type: application/json');
session_start();

// Indicamos nuestra query
$consulta = $conexion->query("SELECT * FROM usuarios");

// Si la consulta está mal formulada, saltará error
if (!$consulta) {
    die("Error en la consulta SQL");
}

// Recorremos las filas del resultado de la query y lo metemos en un array
while ($sql = $consulta->fetch_assoc()) {
    $sqlArray["data"][] = $sql;
}

$mostrarJSON = true; // true: mostrará los datos JSON en php | false: guardará el fichero json en un fichero .json 
if ($mostrarJSON) {
    echo json_encode($sqlArray);
} else {
    $usuarios = "../../../JSON/usuarios.json";
    $data = json_encode($sqlArray);

    // Ojo, deberemos de tener creada la carpeta 'json'
    if ($fp = fopen($usuarios, "w")) {
        fwrite($fp, $data);
    }
    fclose($fp);
}
