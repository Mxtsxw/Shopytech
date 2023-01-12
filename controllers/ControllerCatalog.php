<?php
require_once('views/view.php');

class ControllerCatalog
{
    private $_view;
    private $_productsManager; 
    private $_categoriesManager;

    /**
     * Route : Catalogue
     * URL : /catalog
     * URL Query String - category<id>: La catégorie à afficher
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();
        $this->_categoriesManager = new CategoriesManager();

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
     * @return array[Products]
     */
    private function products()
    {
        $products = $this->_productsManager->getProducts();
        return $products;
    }

    /**
     * Récupère la liste des articles d'une catégorie via son nom
     * @param $name : Nom de la catégorie
     * @return array[Products]
     */
    private function productsByCategoryName($name)
    {
        $products = $this->_productsManager->getProductsByCategoryName($name);
        return $products;
    }

    /**
     * Récupère la liste des catégories
     * @return array[Categories]
     */
    private function categories()
    {
        $categories = $this->_categoriesManager->getCategories();
        return $categories;
    }
}

