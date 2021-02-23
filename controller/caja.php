<?php
session_start();
include_once "../model/Admin.php";
$obj_admin = new Admin;

/* $obj_admin->verificar_login(); */

$page = 'caja';
include_once('../view/layout.php');
