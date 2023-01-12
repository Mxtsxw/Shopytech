<?php
require_once('views/view.php');

class ControllerAccueil
{
    private $_view;
    private $_productsManager;

    /**
     * Route : Accueil
     * URL : '/' | '/accueil' | 'index.php' 
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }

        // 2) Paramètre la vue
        $this->_view = new View('Accueil');

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
     * @return array[Products]
     */
    private function products()
    {
        $products = $this->_productsManager->getProducts();
        return $products;
    }
}