<?php
require_once('views/view.php');

class ControllerCatalog
{
    private $_productsManager; 
    private $_categoriesManager;
    private $_view;

    /**
     * Route : Catalogue
     * URL : /catalog
     * URL Query String - category<id>: La catégorie à afficher
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
        if (isset($_REQUEST['varco']) && $_REQUEST['varco'] == 'burger')
        {
            // Easter Egg
            $this->_view = new View('Playground');
        }
        else
        { 
            $this->_view = new View('Catalog');
        }

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        if (!(isset($_GET['category'])) || empty($_GET['category']))
        {
            $products = $this->products();
        } 
        else 
        {
            $catName = htmlspecialchars(urldecode($_GET['category']));
            $products = $this->productsByCategoryName($catName);
        }

        // 5) Charge les données
        $data['products'] = $products;
        $data['categories'] = $this->categories();
        $data['activeCategory'] = $catName ?? 'Tous nos produits';
        
        // 6) Génère la vue
        $this->_view->generate($data);
    }

    
    /**
     * Récupère la liste des articles
     * @return array[Product]
     */
    private function products()
    {
        $this->_productsManager = new ProductsManager();

        $products = $this->_productsManager->getProducts();

        return $products;
    }

    /**
     * Récupère la liste des articles d'une catégorie via son nom
     * @param $name : Nom de la catégorie
     * @return array[Product]
     */
    private function productsByCategoryName($name)
    {
        $this->_productsManager = new ProductsManager();

        $products = $this->_productsManager->getProductsByCategoryName($name);

        return $products;
    }

    /**
     * Récupère la liste des catégories
     * @return array[Category]
     */
    private function categories()
    {
        $this->_categoriesManager = new CategoriesManager();

        $categories = $this->_categoriesManager->getCategories();

        return $categories;
    }
}

