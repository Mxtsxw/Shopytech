<?php 
session_start();
require_once("../Models/Model.php");
require_once("../Models/DeliveryAddresses.php");
require_once("../Models/DeliveryAddressesManager.php");
require_once("../Models/Orders.php");
require_once("../Models/OrdersManager.php");
require_once("../models/OrderItems.php");
require_once("../models/OrderItemsManager.php");

// Si le formulaire est soumis
if(isset($_POST['paymentMethod']))
{
    // Vérifie que la variable existe
    if(isset($_POST['method']))
    {
        switch($_POST['method'])
        {
            case 'cheque':
                $method = 'cheque';
                break;
            case 'paypal':
                $_SESSION['error_message'] = "La méthode de paiement par Paypal n'est pas encore disponible";
                header('Location: ../validation/payment');
                exit();
            default:
                $method = 'cheque';
                break;
        }
    }


    if (isset($_SESSION['deliveryAddress'])) {

        // 0) Récupère les objets de la session
        $deliveryAddress = unserialize($_SESSION['deliveryAddress']);
        
        // 1) Ajouter l'adresse de livraison à la base de données
        $deliveryAddressManager = new DeliveryAddressesManager();
        $deliveryAddressId = $deliveryAddressManager->addDeliveryAddress($deliveryAddress);

        // 3) Créer un objet commande
        $order = new Orders([
            'id' => -1,
            'customer_id' => isset($_SESSION['customerId']) ?? -1,
            'registered' => isset($_SESSION['username']) ? 1 : 0,
            'delivery_add_id' => $deliveryAddressId,
            'payment_type' => $method,
            'date' => date('Y-m-d H:i:s'),
            'status' => 2,
            'session' => session_id(),
            'total' => (int) $_POST['total']
        ]);

        // 3) Ajouter la commande à la base de données
        $ordersManager = new OrdersManager();
        $orderId = $ordersManager->addOrder($order);

        // 4) Ajouter chaque article commandé à la base de données
        $orderItemsManager = new OrderItemsManager();

        foreach ($_SESSION['cart'] as $key => $value) {
            $orderItemsManager->addOrderItem(new OrderItems([
                'order_id' => $orderId,
                'product_id' => $key,
                'quantity' => $value,
            ]));
        }

        $_SESSION['status'] = 2;
        $_SESSION['cart'] = array(); 
    }

    // Redirection à la page de remerciement
    header('Location: ../validation/confirmed');
    exit();
}


?>