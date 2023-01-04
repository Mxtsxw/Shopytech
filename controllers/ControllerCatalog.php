<?php
require_once('views/view.php');
class ControllerCatalog
{
    private $_productsManager; 
    private $_categoriesManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Récupère les produits selon l'url
            if (!(isset($_GET['category'])))
            {
                $products = $this->products();
            } 
            else 
            {
                $catName = htmlspecialchars(urldecode($_GET['category']));
                $products = $this->productsByCategoryName($catName);
            }

            $categories= $this->categories();

            // Paramètre la vue pour les categories
            $this->_view = new View('Catalog');
            // Envoie à la vue les données [products] pour la génération de la page pour les categories
            $this->_view->generate(array('categories' => $categories, 'products' => $products));
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

    // Retourne les produits en fonction du nom
    private function productsByCategoryName($name)
    {
        $this->_productsManager = new ProductsManager();

        // Récupère la liste des articles 
        $products = $this->_productsManager->getProductsByCategoryName($name);

        return $products;
    }

    private function categories()
    {
        $this->_categoriesManager = new CategoriesManager();

        // Récupère la liste des articles
        $categories = $this->_categoriesManager->getCategories();

        return $categories;
    }
}

