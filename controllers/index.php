<?php
//chercher le fichier
require_once('controllers/Router.php');

$router = new Router(); //instance de la classe router
$router->routeReq();