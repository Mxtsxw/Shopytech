<?php
require_once('views/view.php');

class ControllerPageadmin
{
    private $_view;
    private $_productsManager;

    /**
     * Route : Produits
     * URL : /Pageadmin?id=<id>
     * L'ID de produit doit être passé en Query String 
     * URL Query String : id
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) {
            throw new Exception('Page introuvable');
        }
        if (!(isset($_GET['id']))) throw new Exception('Order ID not specified');

        // 2) Paramètre la vue
        $this->_view = new View('Pageadmin');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $product = $this->product($_GET['id']);

        // 5) Charge les données
        $data['product'] = $product;
        
        // 6) Génère la vue
        $this->_view->generate($data);
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
}