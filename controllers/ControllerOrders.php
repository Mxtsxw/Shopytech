<?php
require_once('views/view.php');

class ControllerOrders
{
    private $_view;
    private $_ordersManager;

    /**
     * Route : Orders
     * URL : /orders
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_ordersManager = new OrdersManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }

        if (!(isset($_SESSION['username'])))
        {
            header('Location: ' . ROOT .'/login');
            exit();
        }

        // 2) Vérifie si l'utilisateur est connecté ou non

        // 3) Paramètre la vue
        $this->_view = new View('orders');

        // 4) Initialisation des données envoyées à la vue
        $data = array();

        // 5) Récupère les informations nécessaires
        $customer = unserialize($_SESSION['customerObject']);
        $orders = $this->getOrders($customer);

        // 6) Charge les données
        $data['customer'] = $customer;
        $data['orders'] = $orders;

        // 7) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Récupère les commandes du client
     * @param Customers $customer
     * @return array[Orders]
     */
    private function getOrders(Customers $customer)
    {
        $orders = $this->_ordersManager->getOrdersByCustomerId($customer->id());
        return $orders;
    }
}