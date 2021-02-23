<?php
session_start();
include_once('../model/Admin.php');
$obj_admin = new Admin;
$obj_admin->verificar_login();
$page = 'facturas';
include_once('../view/layout.php');
