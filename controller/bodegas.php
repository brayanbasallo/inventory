<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    include('../model/Inserts.php');
    $obj_inserts = new Inserts;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $obj_inserts->agregarBodega($nombre, $descripcion);
}

$bodegas = $obj_request->get_all_table_data('categorias', 'nombre');
$admin = 'bodegas';
$page = 'administrar';
include('../view/layout.php');
