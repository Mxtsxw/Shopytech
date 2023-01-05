<?php
require_once('views/view.php');
class ControllerValidation
{
    private $_view;
    private $_productsManager;

    public function __construct($url)
    {
        if (isset($url) && count($url)>2)
        {
            throw new Exception('Page introuvable');
        }
        elseif (count($url)==2){

            if ($url[1] == "payment") {
                $this->_view = new View('payment');
                
            } elseif ($url[1] == "confirmed") {
                $this->_view = new View('OrderConfirmed');
            }
            else {
                throw new Exception('Page introuvable');
            }
        }
        else
        {
            $this->_view = new View('OrderDetail');
        }
        $this->_view->generate(array(
            "total" => $this->cartAmount()
        ));
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