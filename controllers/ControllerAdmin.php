<?php
require_once('views/view.php');
class ControllerAdmin
{
    private $_view;

    public function __construct($url)
    {
        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        
        // 2) Paramètre la vue
        $this->_view = new View('Admin');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        
        // 5) Charge les données

        // 6) Génère la vue
        $this->_view->generate($data);
    }
}
