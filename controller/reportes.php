<?php
session_start();
include_once('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER["REQUEST_METHOD"];
$month = date('m');
$fecha = $_GET['fecha'];
$usuario = $_GET['user'];
$sql = "SELECT * FROM facturas INNER JOIN usuarios ON usuarios.documento = facturas.id_usuario";

switch ($fecha) {
    case 'hoy':
        $day = date('d');
        $sql .= " where MONTH(fecha) = $month AND DAY(fecha) = $day ";
        break;
    case 'mes':
        $sql .= " where MONTH(fecha) = $month ";
        break;
    default:
        $sql .= "";
        # code...
        break;
}
switch ($usuario) {
    case 'todos':
        # code...
        $user = '';
        break;
    default:
        # code...
        if ($fecha != 'mes' && $fecha != 'hoy') {
            $sql .= " WHERE id_usuario = $usuario";
        } else {
            $sql .= " AND id_usuario = $usuario";
        }
        break;
}

$facturas = $obj_request->get_data($sql);
$usuarios = $obj_request->get_all_table_data('usuarios', 'nombre');

$page = 'reportes';
include('../view/layout.php');
