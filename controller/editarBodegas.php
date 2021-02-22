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
    $description = $_POST['description'];
    $id = $_GET['id'];
    $sql = "UPDATE categorias SET nombre = '$name', descripcion = '$description' WHERE id = '$id'";
    $exit = $obj_admin->guardar($sql);
    if ($exit) {
        header('Location: bodegas.php');
    }
}
$sql = "SELECT * FROM categorias WHERE id  = $id";
$bodega = $obj_request->get_data($sql);
$admin = 'editarBodegas';
$page = 'administrar';
include('../view/layout.php');
