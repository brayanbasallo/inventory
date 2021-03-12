<?php

/**
 * @author brayan basallo soto
 * controlado de bodegas-categorias
 */
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$_SESSION['usuario'][0]['id_cargo'] == 1 || $_SESSION['usuario'][0]['id_cargo'] == 3 ? '' : header('Location: caja.php'); //verifica que el usuario logueado tenga permisos para entrar
include('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
    if (isset($_POST['new'])) {

        include('../model/Inserts.php');
        $obj_inserts = new Inserts;
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        if ($nombre != "") {
            $obj_inserts->agregarBodega($nombre, $descripcion);
        }
    }
    if (isset($_POST['delete'])) {
        include('../model/Delete.php');
        $obj_delete = new Delete;
        $tabla = 'categorias';
        $campo = 'id';
        $documento = $_GET['id'];
        $obj_delete->delete($tabla, $campo, $documento);
    }
}

$bodegas = $obj_request->get_all_table_data('categorias', 'nombre');
$admin = 'bodegas';
$page = 'administrar';
include('../view/layout.php');
