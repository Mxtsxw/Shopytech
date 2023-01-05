<?php
require_once('views/view.php');
class ControllerValidation
{
    private $_view;
    private $_productsManager;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Paramètre la vue pour les categories
            $this->_view = new View('OrderDetail');
            $this->_view->generate(array(
                "total" => $this->cartAmount()
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


// .../Validation
// .../Validation/adress
// .../Validation/payment