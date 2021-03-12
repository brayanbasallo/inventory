<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include('../model/Request.php');
$_SESSION['usuario'][0]['id_cargo'] == 1 || $_SESSION['usuario'][0]['id_cargo'] == 3 ? '' : header('Location: caja.php'); //verifica que el usuario logueado tenga permisos para entrar
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    include('../model/Inserts.php');
    $obj_Inserts = new Inserts;
    /* var_dump($_POST); */
    $id_producto = $_POST['id_producto'];
    $stock = $_POST['stock'];
    $nombre = $_POST['nombre'];
    $precio_unitario = $_POST['precio_unitario'];
    $id_categoria = $_POST['id_categoria'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $exit = $obj_Inserts->agregarProducto($id_producto, $stock, $nombre, $precio_unitario, $id_categoria, $fecha_vencimiento);
}


$bodegas = $obj_request->get_all_table_data('categorias', 'nombre');
$productos = $obj_request->get_all_table_data('productos', 'nombre');
$admin = 'productos';
$page = 'administrar';
include('../view/layout.php');
