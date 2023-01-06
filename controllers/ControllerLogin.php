<?php
require_once('views/view.php');
class ControllerLogin
{
    private $_view;

    /**
     * Route : Connexion
     * URL : /login
     * Accessible uniquement aux utilisateurs non connectés
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) 
        {
            throw new Exception('Page introuvable');
        }

        // 2) Vérifie si l'utilisateur est connecté et redirgie vers l'accueil
        if (isset($_SESSION['username']))
        {
            // Redirection vers la page d'accueil
            header('Location: '. ROOT .'/index.php');
            exit();
        }

        // 3) Paramètre la vue
        $this->_view = new View('Login');

        // 4) Initialisation des données envoyées à la vue
        $data = array();
        
        // 5) Récupère les informations nécessaires
        
        // 6) Charge les données
        
        // 7) Génère la vue
        $this->_view->generate($data);
    }
}