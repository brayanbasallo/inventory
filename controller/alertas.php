<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
include_once('../model/Request.php');
$obj_request = new Request;

$page = 'alerts';
include_once('../view/layout.php');
