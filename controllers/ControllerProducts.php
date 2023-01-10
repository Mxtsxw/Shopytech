<?php
require_once('views/view.php');

class ControllerProducts
{
    private $_productsManager; 
    private $_categoriesManager;
    private $_view;

    /**
     * Route : Produits
     * URL : /product?id=<id>
     * L'ID de produit doit être passé en Query String 
     * URL Query String : id
     * @param string $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();
        $this->_categoriesManager = new CategoriesManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1) throw new Exception('Page introuvable');
        if (!(isset($_GET['id']))) throw new Exception('Product ID not specified');

        // 2) Paramètre la vue
        $this->_view = new View('Products');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $product = $this->product($_GET['id']);
        $category = ucfirst($this->_categoriesManager->getCategoryById($product->catId())->name());

        // 5) Charge les données
        $data['product'] = $product;
        $data['category'] = $category;
        
        // 6) Génère la vue
        $this->_view->generate($data);
    }
    
    /**
     * Récupère un article
     * @param int $id : ID de l'article
     * @return Product
     */
    private function product($id)
    {
        $product = $this->_productsManager->getProductById($id);
        return $product;
    }
}
