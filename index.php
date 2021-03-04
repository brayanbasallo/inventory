<?php

/**
 * @author brayan basallo soto 
 * email: basallo17@gmaiil.com
 * date: 04-03-2021 
 * version: 1.0 
 * contact: https://github.com/brayanbasallo
 * repository: https://github.com/brayanbasallo/inventory
 */
if (file_exists('install')) {
    header("Location: install");
} else {
    header("Location: controller/login.php");
}
