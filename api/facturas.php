<?php

/**
 * @author brayan basallo soto
 * este archivo se encargara de devolver los categorias en formato json
 */
header("Content-Type: application/json; charset=UTF-8");
require('../model/Request.php');
$obj_request = new Request;
$id = $_GET['id'];
if ($id != '') {
    $sql = "SELECT detalle_ventas.id_factura, productos.nombre as nombre_producto, detalle_ventas.cantidad_productos, detalle_ventas.cantidad_productos * productos.precio_unitario as total,
    facturas.descuento, categorias.nombre, usuarios.nombre as vendedor FROM detalle_ventas
    INNER JOIN productos
    ON detalle_ventas.id_producto = productos.id_producto
    INNER JOIN  facturas
    ON facturas.id_factura = detalle_ventas.id_factura
    INNER JOIN categorias
    ON categorias.id = productos.id_categoria
    INNER JOIN usuarios
    ON facturas.id_usuario = usuarios.documento WHERE facturas.id_factura = '$id'";
    $detalles = $obj_request->get_data($sql);
    echo json_encode($detalles);
} else {
    $sql = "SELECT * FROM listar_facturas;";
    $facturas = $obj_request->get_data($sql);
    echo json_encode($facturas);
}
