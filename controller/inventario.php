<?php
session_start();
include_once('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER["REQUEST_METHOD"];
$bodegas = $obj_request->get_all_table_data('categorias', 'nombre');
$page = 'inventario';
include_once('../view/layout.php');
