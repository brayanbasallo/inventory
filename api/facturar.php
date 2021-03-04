<?php
header("Content-Type: application/json; charset=UTF-8");
include('../model/Admin.php');
session_start();
$obj_admin = new Admin;
$data = file_get_contents('php://input');
$data = json_decode($data);

$total = $data->total;
$factura = 'Fra' . strtotime(date("d-m-Y H:i:00", time()));
$id_usuario = $_SESSION['usuario'][0]['documento'];
$descuento = $data->descuento;
$productos = $data->productos;

$sql = "INSERT INTO facturas(id_factura,descuento,id_usuario,fecha,saldo_total) VALUES('$factura','$descuento','$id_usuario',NOW(),'$total')";
$exit = $obj_admin->guardar($sql);
if ($exit) {

    foreach ($productos as $product) {
        $total_producto = $product->cantidad * $product->precio_unitario;
        $sql = "INSERT INTO detalle_ventas(id_factura,id_producto,cantidad_productos,valor_total) VALUES('$factura','$product->id_producto','$product->cantidad','$total_producto')";
        $exit = $obj_admin->guardar($sql);
        $stock = $product->stock -  $product->cantidad;
        $sql = "UPDATE productos SET stock = $stock  WHERE id_producto = $product->id_producto";
        $obj_admin->guardar($sql);
    }
} else {
    echo json_encode(['response' => 'No se pudo crear la factura', 'status' => 500]);
}
if ($exit) {
    echo json_encode(['response' => 'Se ha guardado correctamente', 'status' => 200]);
} else {
    echo json_encode(['response' => 'No se ingresaron los productos', 'status' => 500]);
}
