<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$fich_JSON = file_get_contents("https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/");
$datos_JSON = json_decode($fich_JSON, TRUE);

$datos = [];
$j = 0;

for ($i = 0; $i < count($datos_JSON["ListaEESSPrecio"]); $i++) {
    if (substr($datos_JSON["ListaEESSPrecio"][$i]["C.P."], 0,2) == "34") {
        $datos[$j]["direccion"] = $datos_JSON["ListaEESSPrecio"][$i]["Dirección"];
        if (empty($datos_JSON["ListaEESSPrecio"][$i]["Precio Gasoleo A"])) {
            $datos[$j]["precio_gasoleo"] = "Sin datos";
        } else {
            $datos[$j]["precio_gasoleo"] = $datos_JSON["ListaEESSPrecio"][$i]["Precio Gasoleo A"];
        }
        if (empty( $datos_JSON["ListaEESSPrecio"][$i]["Precio Gasolina 95 Protección"])) {
            $datos[$j]["precio_gasolina95"] = "Sin datos";
        } else {
            $datos[$j]["precio_gasolina95"] = $datos_JSON["ListaEESSPrecio"][$i]["Precio Gasolina 95 Protección"];
        }
        if (empty($datos_JSON["ListaEESSPrecio"][$i]["Precio Gasolina 98"])) {
            $datos[$j]["precio_gasolina98"] = "Sin datos";
        } else {
            $datos[$j]["precio_gasolina98"] = $datos_JSON["ListaEESSPrecio"][$i]["Precio Gasolina 98"];
        }
        if (empty($datos_JSON["ListaEESSPrecio"][$i]["Rótulo"])) {
            $datos[$j]["rotulo"] = "Sin datos";
        } else {
            $datos[$j]["rotulo"] = $datos_JSON["ListaEESSPrecio"][$i]["Rótulo"];
        }
        
        $j++;
    }
}

echo json_encode($datos);
