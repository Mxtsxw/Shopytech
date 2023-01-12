<?php
require_once('views/view.php');

class ControllerRegister
{
    private $_view;

    /**
     * Route : Register
     * URL : /register
     * Accessible uniquement si l'utilisateur n'est pas connecté
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>2)
        {
            throw new Exception('Page introuvable');
        }

        // 2) Vérifie si l'utilisateur est connecté et redirgie vers l'accueil
        if (isset($_SESSION['username']))
        {
            header('Location: '. ROOT .'/');
        }

        // 3) Paramètre la vue
        if (count($url) == 2)
        {
            switch ($url[1]) {
                case "confirm":
                    
                    $this->_view = new View('RegisterConfirm');
                    break;
                case "create":
                    if (!isset($_SESSION['createdCustomer'])) 
                    {
                        throw new Exception('Page introuvable');
                    }
                    $this->_view = new View('RegisterCreate');
                    break;
                default:
                    throw new Exception('Page introuvable');
            }
        }

        else {
            $this->_view = new View('Register');
        }

        // 4) Initialisation des données envoyées à la vue
        $data = array();

        // 5) Récupère les informations nécessaires

        // 6) Charge les données

        // 7) Génère la vue
        $this->_view->generate($data);
    }
}