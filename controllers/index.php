<?php
define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

//chercher le fichier
require_once('controllers/Router.php'); //enlever controllers?

$router = new Router(); //instance de la classe router
$router->routeReq();