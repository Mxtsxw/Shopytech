<?php
require_once('views/view.php');

class ControllerDashboard
{
    private $_view;
    private $_productsManager;
    private $_ordersManager;

    /**
     * Route : Dashboard
     * URL : /dashboard
     * URL : /dashboard/orders
     * URL : /dashboard/products
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();
        $this->_ordersManager = new OrdersManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>4)
        {
            throw new Exception('Page introuvable');
        }

        if (!(isset($_SESSION['admin'])))
        {
            throw new Exception('Page introuvable');
        }

        // 2) Paramètre la vue

        if (count($url) == 2){
            switch ($url[1]) {
                case "orders":
                    $this->ordersDashboard();
                    break;
                case "products":
                    $this->productsDashboard();
                    break;
                default:
                    throw new Exception('Page introuvable');
            }
        }

        else if (count($url) == 3){
            if ($url[2] == "update" && isset($_GET["id"]))
            {
                switch ($url[1]) {
                    case "orders":
                        $this->orderUpdateDashboard();
                        break;
                    case "products":
                        $this->productUpdateDashboard();
                        break;
                    default:
                        throw new Exception('Page introuvable');
                }
            }
            else 
            {
                throw new Exception('Page introuvable');

            }
        } 
        else {
            $this->ordersDashboard();
        }
    }
    
    /**
     * Récupère la liste des articles
     * @return array[Products]
     */
    private function products()
    {
        $products = $this->_productsManager->getProducts();
        return $products;
    }

    /**
     * Récupère un produit
     * @param int $id : ID de la commande
     * @return Products
     */
    private function product($id)
    {
        $product = $this->_productsManager->getProductById($id);
        return $product;
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

    /**
     * Génère le tableau de bord des produits
     * @return void
     */
    private function productsDashboard()
    {
        // 2) Paramètre la vue
        $this->_view = new View('DashboardProducts');

        // 3) Initialisation des données 
        $data = array();

        // 4) Récupère les informations nécessaires
        $products = $this->products();
        $orders = $this->_ordersManager->getOrders();

        // 5) Charge les données
        $data['products'] = $products;
        $data['orders'] = $orders;

        // 6) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Génère le tableau de bord des commandes
     * @return void
     */
    private function ordersDashboard()
    {
        // 2) Paramètre la vue
        $this->_view = new View('DashboardOrders');

        // 3) Initialisation des données 
        $data = array();

        // 4) Récupère les informations nécessaires
        $orders = $this->_ordersManager->getOrders();

        // 5) Charge les données
        $data['orders'] = $orders;

        // 6) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Génère la page de mise à jour d'un produit
     * @return void
     */
    private function orderUpdateDashboard()
    {
        // 2) Paramètre la vue
        $this->_view = new View('DashboardOrderUpdate');

        // 3) Initialisation des données 
        $data = array();

        // 4) Récupère les informations nécessaires
        $order = $this->order($_GET['id']);

        // 5) Charge les données
        $data['order'] = $order;

        // 6) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Génère la page de mise à jour d'un produit
     */
    private function productUpdateDashboard()
    {
        // 2) Paramètre la vue
        $this->_view = new View('DashboardProductUpdate');

        // 3) Initialisation des données 
        $data = array();

        // 4) Récupère les informations nécessaires
        $product = $this->product($_GET['id']);

        // 5) Charge les données
        $data['product'] = $product;

        // 6) Génère la vue
        $this->_view->generate($data);
    }
}
