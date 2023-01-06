<?php
session_start();    // Démarre la session
$_SESSION['status'] ?? $_SESSION['status'] = 0;

require_once('./config.php');

// Inclusion du fichier Router.php
require_once('./controllers/Router.php');

$router = new Router();     // Instanciation de la classe router
$router->routeReq();        // Request la route correspondante

// Fonctionnement :
// 1) .htaccess transforme www.shopytech/<...>  en www.shopytech/index.php?url=<...> 
// 2) index.php appelle le fichier Router.php
// 3) En fonction du paramètre URL le bon controlleur est appelé (Si aucun paramètre n'est passé : Accueil)
// 4) Le controlleur se charge d'appeller la classe View avec en paramètre le nom de la vue correspondante
// 5) View génère la bonne vue à l'aide des fichiers view*Action*


?>