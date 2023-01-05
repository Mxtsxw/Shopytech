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

        else if (!(isset($_SESSION['cart'])) || empty($_SESSION['cart']))
        {
            header('Location: ' . ROOT .'/cart');
            exit();
        }

        elseif (count($url)==2){

            if ($url[1] == "payment") {
                $this->_view = new View('payment');
                $this->_view->generate(array(
                    "total" => $this->cartAmount()
                ));
            } elseif ($url[1] == "confirmed" && $_SESSION['status'] == 1) {
                $this->_view = new View('OrderConfirmed');
                $this->_view->generate(array());
                unset($_SESSION['cart']);
                $_SESSION['status'] = 0;
            }
            else {
                throw new Exception('Page introuvable');
            }
        }
        else
        {
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