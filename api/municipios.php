<?php

header("Content-Type: application/json; charset=UTF-8");
require('../model/Request.php');
$obj_request = new Request;
$method = $_SERVER['REQUEST_METHOD'];

if ($method = "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM geo_municipio WHERE id_dept = $id ORDER BY nombre_mcpio";
    $exit = $obj_request->get_data($sql);
    echo json_encode($exit);
} else {
    echo json_encode(['response' => 'Se requiere el id de la categoria']);
}
