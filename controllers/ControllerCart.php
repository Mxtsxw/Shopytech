<?php
require_once('views/view.php');
class ControllerCart
{
    private $_productsManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->_productsManager = new ProductsManager();
            $items = array();
            
            if (isset($_SESSION['cart'])) 
            {
                foreach ($_SESSION['cart'] as $id => $quantity)
                {
                    $product = $this->_productsManager->getProductById($id);
                    array_push($items, new CartItem($product->id(), $quantity, $product));
                }
            } else {
                $_SESSION['cart'] = array();
            }

            // Paramètre la vue pour les categories
            $this->_view = new View('Cart');
            // Envoie à la vue les données [products] pour la génération de la page pour les categories
            $this->_view->generate(array(
                'items' => $items,
                'total' => $this->cartAmount()
            ));
        }
    }

    private function cartAmount()
    {
        $this->_productsManager = new ProductsManager();

        $total = 0;

        foreach ($_SESSION['cart'] as $id => $quantity) {
            $product = $this->_productsManager->getProductById($id);
            $total += $product->price() * $quantity;
        }
        
        return $total;
    }
}