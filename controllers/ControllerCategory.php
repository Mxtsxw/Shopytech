<?php
require_once('views/view.php');
class ControllerCategory
{
    private $_productsManager; //ce seras un nv instance de la classe ProductsManager
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count(array($url))>2) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Récupère les informations nécessaires
            $products = $this->products();

            // Paramètre la vue pour les categories
            $this->_view = new View('Category');
            // Envoie à la vue les données [products] pour la génération de la page pour les categories
            $this->_view->generate(array('products' => $products));
        }
    }
    
    // Retourn les produits
    private function products()
    {
        $this->_productsManager = new ProductsManager();

        // Récupère la liste des articles
        $products = $this->_productsManager->getProducts();

        return $products;
    }
}

