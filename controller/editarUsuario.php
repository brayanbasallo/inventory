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
    $document = $_GET['id'];
    $password = $_POST['password'];
    $sql = "UPDATE usuarios SET nombre = '$name', password = '$password' WHERE documento = '$document'";
    $exit = $obj_admin->guardar($sql);
    if ($exit) {
        header('Location: usuarios.php');
    }
}
$sql = "SELECT * FROM usuarios WHERE documento  = $id";
$usuario = $obj_request->get_data($sql);
$cargos = $obj_request->get_all_table_data('cargos', 'nombre_cargo');
$admin = 'editarUsuario';
$page = 'administrar';
include('../view/layout.php');
