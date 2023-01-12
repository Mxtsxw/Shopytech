<?php
require_once('views/view.php');

class ControllerCommand
{
    private $_view;
    private $_ordersManager;

    public function __construct($url)
    {
        $this->_ordersManager = new OrdersManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        
        // 2) Paramètre la vue
        $this->_view = new View('Command');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $orders = $this->_ordersManager->getOrders();

        // 5) Charge les données
        $data['orders'] = $orders;

        // 6) Génère la vue
        $this->_view->generate($data);
    }
}