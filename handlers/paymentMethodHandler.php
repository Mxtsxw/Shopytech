<?php 
session_start();
require_once("../Models/Model.php");
require_once("../Models/DeliveryAddresses.php");
// require_once("../Models/DeliveryAddressesManager.php");
require_once("../Models/Orders.php");
// require_once("../Models/OrdersManager.php");

// Si le formulaire est soumis
if(isset($_POST['paymentMethod']))
{
    // Vérifie que la variable existe
    if(isset($_POST['method']))
    {
        // Méthode de paiement par chèque
        if($_POST['method'] == 'cheque')
        {
            $method = 'cheque';
            $_SESSION['status'] = 1;
        }
        // Méthode de paiement par Paypal
        else if($_POST['method'] == 'paypal')
        {
            // redirect with session variable error
            $_SESSION['error_message'] = "La méthode de paiement par Paypal n'est pas encore disponible";
            header('Location: ../validation/payment');
            exit();
        }
    }
    else
    {
        // Par défaut la méthode de paiement est par chèque
        $method = 'cheque';
    }

    if (isset($_SESSION['deliveryAddress'])) {
        $deliveryAddress = unserialize($_SESSION['deliveryAddress']);
        
        // Ajouter la commande à la base de données

        // 1- Ajout de l'adresse de livraison
        // $deliveryAddressManager = new DeliveryAddressesManager();
        // $deliveryAdressId = $deliveryAddressManager->addDeliveryAddress($deliveryAddress);

        // 2- Ajout de la commande
        var_dump($_SESSION);
        $order = new Orders([
            'id' => -1,
            'customer_id' => $_SESSION['customerId'],
            'registered' => isset($_SESSION['connected']) ? 1 : 0,
            'delivery_address_id' => $deliveryAdressId,
            'payment_type' => $method,
            'date' => date('Y-m-d H:i:s'),
            'status' => 2,
            'session' => session_id(),
            'total' => (int) $_POST['total']
        ]);

        var_dump($order);
    }
}

// // Redirection
// header('Location: ../validation/confirmed');
// exit();
    

?>