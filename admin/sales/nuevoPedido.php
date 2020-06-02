<?php
require_once('../recursos/conexionBD.php');
session_start();

$data = json_decode(stripslashes($_POST['data']));
$id_usuario = $_SESSION['id_usuario'];
$total = $_POST['total'];
$fecha = date("Y-m-d H:i:s");

$query = "INSERT INTO `ventas`(`id_usuario`, `fecha`, `precio_total`) VALUES ('$id_usuario', '$fecha', '$total')";

if ($conexion->query($query) === TRUE) {

    /* Seleccionamos el id_venta de la venta recien creada */
    $consulta = "SELECT `id_venta` FROM `ventas` WHERE (id_usuario = '$id_usuario') AND (fecha = '$fecha')";
    $resultado = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_array($resultado);

    /* Por cada producto en el carrito */
    foreach ($data as $producto) {
        /* Seleccionamos el stock actual de dicho producto */
        $buscaStock = "SELECT `stock` FROM `productos` WHERE id_producto = $producto";
        $resultado1 = mysqli_query($conexion, $buscaStock);
        $datos = mysqli_fetch_array($resultado1);

        // Le restamos 1
        $stockMenos = $datos['stock'] - 1;
        $updateStock = "UPDATE `productos` SET stock='$stockMenos' WHERE id_producto='$producto'";
        $conexion->query($updateStock);

        /* Seleccionamos el id del producto en el que estamos */
        $buscaProducto = "SELECT `id_producto` FROM `venta_productos` WHERE (id_producto = $producto) AND (id_venta = $fila[id_venta])";
        $resultado2 = $conexion->query($buscaProducto);
        $existe = mysqli_num_rows($resultado2);
        if ($existe == 1) {

            /* Si el producto se encuentra en la tabla venta_productos relacionado con la venta actual */
            /* Seleccionamos la cantidad de veces que se repite */
            $buscaCantidad = "SELECT `cantidad` FROM `venta_productos` WHERE (id_producto = $producto) AND (id_venta = $fila[id_venta])";
            $resultado3 = mysqli_query($conexion, $buscaCantidad);
            $fila2 = mysqli_fetch_array($resultado3);

            // Le sumamos 1
            $sumaCantidad = $fila2['cantidad'] + 1;
            $masCantidad = "UPDATE `venta_productos` SET `cantidad`= '$sumaCantidad' WHERE (id_producto = $producto) AND (id_venta = $fila[id_venta])";
            $conexion->query($masCantidad);
        } else {
            /* Si no se encuentra en la tabla venta_productos relacionado con el id de la venta actual */
            /* Lo introducimos con una cantidad de 1 */
            $query2 = "INSERT INTO `venta_productos`(`id_venta`, `id_producto`, `cantidad`) VALUES ('$fila[id_venta]', '$producto', '1')";
            $conexion->query($query2);
        }
    }

    die('exito');
} else {
    die();
}
