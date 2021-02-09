<?php

/**
 * @author brayan basallo soto
 */
include_once "../model/Admin.php";
$obj_admin = new Admin;
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "POST") {
    $document = isset($_POST['document']) ? $_POST['document'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $exit = $obj_admin->login($document, $password);
} elseif ($method === "GET" && isset($_GET['exit'])) {
    # code...
    $exit = $obj_admin->sign_out();
}

include "../view/login.php";
