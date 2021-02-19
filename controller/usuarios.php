<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    if (isset($_POST['new'])) {
        include('../model/Inserts.php');
        $obj_Inserts = new Inserts;
        $documento = $_POST['documento'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $id_cargo = $_POST['cargo'];
        $password = $_POST['password'];
        $nuevo_usuario = $obj_Inserts->agregarUsuario($documento, $usuario, $nombre, $password, $id_cargo);
    }
    if (isset($_POST['delete'])) {
        include('../model/Delete.php');
        $obj_delete = new Delete;
        $tabla = 'usuarios';
        $campo = 'documento';
        $documento = $_GET['documento'];
        $obj_delete->delete($tabla, $campo, $documento);
    }
}



$usuarios = $obj_request->get_all_table_data('usuarios', 'nombre');
$cargos = $obj_request->get_all_table_data('cargos', 'nombre_cargo');
$admin = 'usuarios';
$page = 'administrar';
include('../view/layout.php');
