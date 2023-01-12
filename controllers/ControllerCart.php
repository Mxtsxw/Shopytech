<?php
require_once('views/view.php');

class ControllerCart
{
    private $_view;
    private $_productsManager;

    /**
     * Route : Panier
     * URL : /cart
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }

        // 2) Paramètre la vue
        $this->_view = new View('Cart');

        // 3) Initialisation des données envoyées à la vue
        $data = array();

        // 4) Récupère les informations nécessaires
        $items = $this->getCartItems();
        $total = $this->cartAmount();
        $totalTVA = $this->cartAmount()*1.05;

        // 5) Charge les données
        $data['items'] = $items;
        $data['total'] = $total;
        $data['totalTVA'] = $totalTVA;
        
            
        // 6) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Récupère le montant total du panier
     * @return double : montant total
     */
    private function cartAmount()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $product = $this->_productsManager->getProductById($id);
            $total += $product->price() * $quantity;
        }
        return $total;
    }

    /**
     * Récupère les articles du panier
     * @return array[CartItem]
     */
    private function getCartItems()
    {
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
        return $items;
    }
}