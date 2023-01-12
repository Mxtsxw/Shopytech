<?php
require_once('views/view.php');

class ControllerValidation
{
    private $_view;
    private $_productsManager;
    private $_orderItemsManager;
    private $_deliveryAdressesManager;

    /**
     * Route : Validation
     * URL : /validation
     * URL : /validation/detail
     * URL : /validation/payment    accessible uniquement si le statut de la commande en cours est à 1
     * URL : /validation/confirmed  accessible uniquement si le statut de la commande en cours est à 2
     * URL : /validation/confirmed?download : URI pour télécharger la facture
     * @param array $url
     * @throws Exception
     */
    public function __construct($url)
    {
        $this->_productsManager = new ProductsManager();
        $this->_orderItemsManager = new OrderItemsManager();
        $this->_deliveryAdressesManager = new DeliveryAddressesManager();

        // 1) Vérifie la validité de l'url
        if (isset($url) && count($url)>2)
        {
            throw new Exception('Page introuvable');
        }

        // 2) Vérifie si le panier est vide et redirige vers la page panier
        else if (!(isset($_SESSION['cart'])) || empty($_SESSION['cart']))
        {
            // Exception pour la page de confirmation
            if ((count($url) != 2) || $url[1] != "confirmed")
            {
                header('Location: ' . ROOT .'/cart');
                exit();
            }
        }

        if (count($url) == 2){
            switch ($url[1]) {
                case "payment":
                    if ($_SESSION['status'] == 1) { $this->viewValidationPayment(); }
                    else { header('Location: ' . ROOT .'/validation'); exit(); }
                    break;
                case "confirmed":
                    if ($_SESSION['status'] == 2) {$this->viewValidationConfirmed();}
                    else { header('Location: ' . ROOT .'/validation/payment'); $_SESSION['status']=0; exit(); }
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
        $totalTVA = $this->cartAmount()*1.05;

        // 4) Charge les données
        $data['total'] = $total;
        $data['totalTVA'] = $totalTVA;

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
        $this->_view = new View('Payment');

        // 2) Initialisation des données envoyées à la vue
        $data = array();

        // 3) Récupère les données pour la vue
        $total = $this->cartAmount();
        $totalTVA = $this->cartAmount()*1.05;

        // 4) Charge les données
        $data['total'] = $total;
        $data['totalTVA'] = $totalTVA;

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
        $deliveryAddress = unserialize($_SESSION['deliveryAddress']);   // Récupère l'objet DeliveryAddresses
        $oderObject = unserialize($_SESSION['orderObject']);            // Récupère l'objet Orders
        $itemsList = $this->orderItemsList($oderObject);                // Récupère la liste des articles de la commande        

        // 4) Télécharge la facture
        if (isset($_REQUEST['download'])) {
            $this->donwloadFacture($deliveryAddress, $oderObject, $itemsList);
        }
        
        // 5) Génère la vue
        $this->_view->generate($data);

    }

    /** 
     * Retourne le montant total du panier
     * @return double
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
     * Retourne la liste des articles de la commande
     * @param Orders $order
     * @return array[orderItems]
     */
    private function orderItemsList(Orders $order)
    {
        $this->_orderItemsManager = new OrderItemsManager();

        $itemsList = $this->_orderItemsManager->getOrderItemsByOrderId($order->id());

        return $itemsList;
    }

    /**
     * Fonction génération et téléchargement de la facture (PDF)
     * @param DeliveryAddresses $deliveiryAddress   :   L'adresse de livraison
     * @param Orders $order                         :   La commande
     * @param array[orderItems] $items              :   Les articles de la commande
     * @return void
     */
    public function donwloadFacture(DeliveryAddresses $deliveryAddress, Orders $order, array $items){
        require_once('./static/lib/fpdf/invoicePDF.php');

        $pdf = invoice($deliveryAddress, $order, $items);

        $pdf->Output('D', 'facture.pdf');
    }
}