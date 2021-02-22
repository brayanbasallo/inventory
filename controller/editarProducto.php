<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'];
if ($method == "POST") {
    include_once('../model/Admin.php');
    $obj_admin = new Admin;
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $precio_unitario = $_POST['precio_unitario'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id = $_GET['id'];
    $sql = "UPDATE productos SET stock = '$stock' ,nombre = '$name', precio_unitario = '$precio_unitario', fecha_vencimiento = '$fecha_vencimiento' WHERE id_producto = '$id'";
    $exit = $obj_admin->guardar($sql);
    if ($exit) {
        header('Location: productos.php');
    }
}
$sql = "SELECT * FROM productos WHERE id_producto = $id";
$product = $obj_request->get_data($sql);
$bodegas = $obj_request->get_all_table_data('categorias', 'nombre');

$admin = 'editarProducto';
$page = 'administrar';
include('../view/layout.php');
