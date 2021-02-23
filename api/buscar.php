<?php

/**
 * @author brayan basallo soto
 * este archivo se encargara de devolver los categorias en formato json
 */

header("Content-Type: application/json; charset=UTF-8");
require('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];

if ($method = "GET") {
    $buscar = $_GET['buscar'];
    $sql = "SELECT * FROM ( SELECT * FROM productos WHERE id_producto = '$buscar' OR LOWER(nombre) LIKE'%$buscar%' )AS tb
    WHERE tb.stock > 0 AND tb.estado != 0 LIMIT 30;";
    /* echo $sql . '<br>'; */
    $exit = $obj_request->get_data($sql);
    if (count($exit) == 0) {
        echo json_encode(['status' => 'No se encontro este producto']);
    } else {
        echo json_encode(['status' => 200, 'products' => $exit]);
    }
} else {
    echo json_encode(['status' => 'Se requiere el id de la categoria']);
}
