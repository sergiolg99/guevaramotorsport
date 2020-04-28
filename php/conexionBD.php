<?php

$conexion = new mysqli ('localhost', 'root', '', 'guevaramotorsport');
$consulta = "SELECT * FROM usuarios";

$resultado = $conexion->query($consulta);

// Crea una tabla para mostrar los datos ***************************************
print "<table border='1'>";

    print "<th> Código </th>";
    print "<th> Email </th>";
    print "<th> Contrasenna </th>";
    print "<th> Nombre </th>";
    print "<th> Direccion </th>";
    
    while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
        print "<tr>";
            print "<td>".$fila['Id_user']."</td>";
            
            print "<td>".$fila['email']."</td>";
            
            print "<td>".$fila['password']."</td>";
            
            print "<td>".$fila['nombre']."</td>";

            print "<td>".$fila['direccion']."</td>";
        print "</tr>";
    }
print "</table>";

$resultado->free();
