<?php
require_once('views/view.php');

class ControllerAdmin
{
    private $_productsManager;
    private $_view;

    /**
     * Route : Accueil
     * URL : '/' | '/accueil' | 'index.php' 
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

        // 2) Paramètre la vue
        $this->_view = new View('Admin');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $products = $this->products();

        // 5) Charge les données
        $data['products'] = $products;

        // 6) Génère la vue
        $this->_view->generate($data);
    }
    
    /**
     * Récupère la liste des articles
     */
    private function products()
    {
        $this->_productsManager = new ProductsManager();

        $products = $this->_productsManager->getProducts();

        return $products;
    }
}
