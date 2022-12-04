<?php
require_once('views/View.php');

class Router
{
    private $_ctrl;     // Le Controlleur correspondante 
    private $_view;     // La Vue correspondante

    public function routeReq()
    {
        try
        {
            // Chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            $url='';

            // Le controller est inclus selon l'action de l'utilisateur
            if (isset($GET['url']))
            {
                // Récupère tous les paramètes URL de manière séparée
                $url = explode('/', filter_var($GET['url'], FILTER_SANITIZE_URL));

                // On récupère le premier paramètre de l'URL
                $controller = ucfirst(strtolower($url[0]));                 // première lettre majuscule le reste minuscule eg. ControllerAccueil
                $controllerClass = "Controller".$controller;                // récupère le nom du controlleur
                $controllerFile = "controllers/".$controllerClass.".php";   // récupère le fichier correspondant
                
                // Vérification de l'existence du fichier
                if (file_exists($controllerFile))
                {
                    // Fait appelle au controlleur correspondant avec les paramètres de l'URL
                    require_once($controllerFile);
                    $this->_ctrl= new $controllerClass($url);
                }
                else 
                {
                    throw new Exception('Page introuvable');
                }
            }
            else 
            {
                // URL non défini → chargement de la page d'accueil
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        // Gestion des erreurs
        catch (Exception $e)
        {
            $errorMSG = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMSG));
        }
    }
}