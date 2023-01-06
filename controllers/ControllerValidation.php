<?php
require_once('views/view.php');

class ControllerValidation
{
    private $_view;
    private $_productsManager;

    /**
     * Route : Validation
     * URL : /validation
     * URL : /validation/detail
     * URL : /validation/payment
     * URL : /validation/confirmed
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>2)
        {
            throw new Exception('Page introuvable');
        }

        // 2) Vérifie si l'utilisateur est connecté et redirgie vers le panier
        else if (!(isset($_SESSION['cart'])) || empty($_SESSION['cart']))
        {
            header('Location: ' . ROOT .'/cart');
            exit();
        }


        if (count($url) == 2){
            switch ($url[1]) {
                case "payment":
                    if ($_SESSION['status'] == 1) { $this->viewValidationPayment(); }
                    else { header('Location: ' . ROOT .'/validation'); exit(); }
                    break;
                case "confirmed":
                    if ($_SESSIONS['status'] == 2) { $this->viewValidationConfirmed(); }
                    else { header('Location: ' . ROOT .'/validation/payment'); exit(); }
                    break;
                default:
                    throw new Exception('Page introuvable');
            }
        }
        else
        {
            $this->viewValidationDetail();
        }
    }

    /**
     * Génère la vue pour /validation/details
     * @return void
     */
    private function viewValidationDetail()
    {
        // 1) Paramètre la vue
        $this->_view = new View('OrderDetail');

        // 2) Initialisation des données envoyées à la vue
        $data = array();

        // 3) Récupère les données pour la vue
        $total = $this->cartAmount();

        // 4) Charge les données
        $data['total'] = $total;

        // 5) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Génère la vue pour /validation/payment
     * @return void
     */
    private function viewValidationPayment()
    {
        // 1) Paramètre la vue
        $this->_view = new View('OrderPayment');

        // 2) Initialisation des données envoyées à la vue
        $data = array();

        // 3) Récupère les données pour la vue
        $total = $this->cartAmount();

        // 4) Charge les données
        $data['total'] = $total;

        // 5) Génère la vue
        $this->_view->generate($data);
    }

    /**
     * Génère la vue pour /validation/confirmed
     * @return void
     */
    private function viewValidationConfirmed()
    {
        // 1) Paramètre la vue
        $this->_view = new View('OrderConfirmed');

        // 2) Initialisation des données envoyées à la vue
        $data = array();

        // 3) Récupère les données pour la vue
        $total = $this->cartAmount();

        // 4) Charge les données
        $data['total'] = $total;

        // 5) Génère la vue
        $this->_view->generate($data);
    }

    /** 
     * Retourne le montant total du panier
     * @return int
     */
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