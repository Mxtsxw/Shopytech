<?php
require_once('views/View.php');

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try
        {
            //chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            $url='';

            //Le controller est inclus selon l'action de l'utilisateur
            if (isset($GET['url']))
            {
                //récupère tous les para de l'url de manière séparé
                $url=explode('/', filter_var($GET['url'], 
                FILTER_SANITIZE_URL));

                //on récup le premier paramètre de l'url
                $controller = ucfirst(strtolower ($url [0])); //première lettre maj le reste min
                $controllerClass = "Controller".$controller; //par exemple ControllerAccueil
                $controllerFile = "controllers/".$controllerClass.".php"; //dans le dossier controllers

                //vérification si le fichier existe
                if (file_exists($controllerFile))
                {
                    require_once($controllerFile);
                    $this->_ctrl= new $controllerClass ($url);
                }
                else
                    {throw new Exception('Page introuvable');}
            }
            else 
            {
                //pas d'url donc chargement page d'accueil
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }


        }
        //gestion des erreurs
        catch (Exception $e)
        {
            $errorMSG = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMSG));
        }
    }
}