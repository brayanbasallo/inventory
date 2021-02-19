<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include_once('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];
$sql = "SELECT *, DATEDIFF(fecha_vencimiento,NOW()) dias_restantes
FROM productos 
WHERE fecha_vencimiento IS NOT NULL AND DATE_SUB(fecha_vencimiento,INTERVAL 10 DAY) <= CURDATE() AND stock > 0 ORDER BY dias_restantes";


if ($method == "POST" && isset($_POST['delete'])) {
    include('../model/Delete.php');
    $obj_delete = new Delete;
    $id = $_GET['id'];
    $obj_delete->deleteProduct($id);
}

$alertas = $obj_request->get_data($sql);

$page = 'alerts';
include_once('../view/layout.php');
