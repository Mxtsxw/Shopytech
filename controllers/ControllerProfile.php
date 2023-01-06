<?php
require_once('views/view.php');

class ControllerProfile
{
    private $_customerManager;
    private $_view;

    /**
     * Route : Profile
     * URL : /profile
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

        // 2) Vérifie si l'utilisateur est connecté et redirgie vers la page de connexion
        if (!(isset($_SESSION['username'])))
        {
            header('Location: ' . ROOT .'/login');
            exit();
        }

        // 3) Paramètre la vue
        $this->_view = new View('profile');

        // 4) Initialisation des données envoyées à la vue
        $data = array();

        // 5) Récupère les informations nécessaires
        $customer = unserialize($_SESSION['customerObject']);

        // 6) Charge les données
        $data['customer'] = $customer;

        // 7) Génère la vue
        $this->_view->generate($data);
    }
}
