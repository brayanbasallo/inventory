<?php
session_start();
include_once "../model/Admin.php";
$obj_admin = new Admin;

$page = 'productos';
include_once('../view/layout.php');
