<?php
require_once('views/view.php');
class ControllerProducts
{
    private $_productsManager; 
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }
        else if (!(isset($_GET['id'])))
        {
            throw new Exception('Product ID not specified');
        }
        else
        {
            $id = $_GET['id'];  # ID passé en Query String
            try{
                $product = $this->product($id);
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }

            // Paramètre la vue pour les categories
            $this->_view = new View('Products');
            $this->_view->generate(array('product' => $product));
        }
    }
    
    // Retourn les produits
    private function product($id)
    {
        $this->_productsManager = new ProductsManager();

        // Récupère la liste des articles
        $product = $this->_productsManager->getProductById($id);
        return $product;
    }
}
