<?php
// Constante de l'application
define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define('ROOT', dirname($_SERVER["PHP_SELF"]));
?>