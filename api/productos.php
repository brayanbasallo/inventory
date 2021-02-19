<?php

/**
 * @author brayan basallo soto
 * este archivo se encargara de devolver los productos en formato json
 */
header("Content-Type: application/json; charset=UTF-8");
require('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    include('../model/Delete.php');
    $obj_delete = new Delete;
    $id_producto = $_GET['id_producto'];
    $exit = $obj_delete->deleteProduct($id_producto);
    echo json_encode(['response' => $exit]);
} else {
    if ($method == "GET" && $_GET['categoria'] != '') {
        $categoria = $_GET['categoria'];
        $sql = "SELECT * FROM productos WHERE id_categoria = $categoria";
        /* echo $sql . '<br>'; */
        $exit = $obj_request->get_data($sql);
        if (count($exit) > 0) {
            echo json_encode($exit);
        } else {
            echo json_encode(['response' => 'No hay datos en esta categoria']);
        }
    } else {
        echo json_encode(['response' => 'Se requiere el id de la categoria']);
    }
}
