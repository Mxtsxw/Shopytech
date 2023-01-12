<?php
require_once('views/view.php');

class ControllerPagecommande
{
    private $_ordersManager;
    private $_view;

    /**
     * Route : Produits
     * URL : /pagecommand?id=<id>
     * L'ID de l'order doit être passé en Query String 
     * URL Query String : id
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_ordersManager = new OrdersManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) throw new Exception('Page introuvable');
        if (!(isset($_GET['id']))) throw new Exception('Order ID not specified');

        // 2) Paramètre la vue
        $this->_view = new View('Pagecommande');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $order = $this->order($_GET['id']);

        // 5) Charge les données
        $data['order'] = $order;
        
        // 6) Génère la vue
        $this->_view->generate($data);
    }
    
    /**
     * Récupère une commande
     * @param int $id : ID de la commande
     * @return Orders
     */
    private function order($id)
    {
        $order = $this->_ordersManager->getOrderById($id);
        return $order;
    }
}