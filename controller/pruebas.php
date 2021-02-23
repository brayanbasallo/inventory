<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

include('../model/Request.php');
$obj_request = new Request;
$today = strtotime(date("y-m-d"));
/* $fecha_caducidad = strtotime(date("y-m-d", strtotime($today . "+ 1 days"))); */
$fecha_caducidad = strtotime(date("2021-03-13"));
if ($today < $fecha_caducidad) {
    echo $today . "hoy";
} else {
    echo $fecha_caducidad . "futuro";
}
