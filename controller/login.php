<?php

/**
 * @author brayan basallo soto
 */
include_once "../model/Admin.php";
$obj_admin = new Admin;
$method = $_SERVER['REQUEST_METHOD'];
session_start();
/* var_dump($_SESSION['usuario']); */
if ($method === "POST") {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $exit = $obj_admin->login($usuario, $password);
} elseif ($method === "GET" && isset($_GET['exit'])) {
    # code...
    $exit = $obj_admin->sign_out();
}

include "../view/login.php";
