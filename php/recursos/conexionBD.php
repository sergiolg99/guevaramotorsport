<?php
// Carga la configuración 
$config = parse_ini_file('../../configBD.ini');

// Conexión con los datos del 'configBD.ini' 
$conexion = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);

// Si la conexión falla, aparece el error 
if($conexion === false) { 
    echo 'Ha habido un error <br>'.mysqli_connect_error(); 
}