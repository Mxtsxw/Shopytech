<?php
define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define('ROOT', dirname($_SERVER["PHP_SELF"]));

// Charge le fichier Router.php
require_once('./controllers/Router.php');

$router = new Router();     // Instancie de la classe router
$router->routeReq();        // Request la route correspondante

// Fonctionnement :
// 1) .htaccess transforme www.shopytech/<...>  en www.shopytech/index.php?url=<...> 
// 2) index.php appelle le fichier Router.php
// 3) En fonction du paramètre URL le bon controlleur est appelé (Si aucun paramètre n'est passé : Accueil)
// 4) Le controlleur se charge d'appeller la classe View avec en paramètre le nom de la vue à appeler 
// 5) View génère la bonne vue à l'aide des fichiers view*Action*