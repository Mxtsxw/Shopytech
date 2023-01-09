<?php
session_start();
// Importation des modules nécessaires
require_once('../models/Model.php');
require_once('../models/Logins.php');
require_once('../models/LoginsManager.php');
require_once('../models/Customers.php');
require_once('../models/CustomersManager.php');
require_once('../Models/Model.php');
require_once('../Models/DeliveryAddresses.php');

// Si toutes les variables requises sont passées en POST
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['add1']) && isset($_POST['add2']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['phone'])) {
    
    // Vérifie que les variables ne sont pas vides
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['add1']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['phone'])) {
       
        // Vérifie que l'email est valide (du côté du serveur)
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            // Vérifie que le code postal est valide (du côté du serveur)
            if (preg_match('#^[0-9]{5}$#', $_POST['zip'])) {

                // Vérifie que le numéro de téléphone est valide (du côté du serveur)
                if (preg_match('#^[0-9]{10}$#', $_POST['phone'])) {
                    
                    // Met a jour le statut de la commande
                    $_SESSION['status'] = 1;

                    // Créer un nouvel objet DeliveryAddresses
                    $deliveryAddress = new DeliveryAddresses([
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'add1' => $_POST['add1'],
                        'add2' => $_POST['add2'],
                        'city' => $_POST['city'],
                        'postcode' => $_POST['zip'],
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email']
                    ]);

                    // Stocke l'objet DeliveryAddresses dans la session
                    $_SESSION['deliveryAddress'] = serialize($deliveryAddress);

                    // On ordonne la création d'un compte
                    if (isset($_POST['create-account']))
                    {
                        $newCustomer = new Customers(array(
                            "forname" => $deliveryAddress->firstname(),
                            "surname" => $deliveryAddress->lastname(),
                            "add1" => $deliveryAddress->add1(),
                            "add2" => $deliveryAddress->add2(),
                            "add3" => $deliveryAddress->city(),
                            "postcode" => $deliveryAddress->postcode(),
                            "email" => $deliveryAddress->email(),
                            "phone" => $deliveryAddress->phone(),
                            "registered" => 1
                        ));

                        $_SESSION['redirect'] = "validation/payment";
                        $_SESSION['createdCustomer'] = serialize($newCustomer);

                        header('Location: ../register/create');
                        exit();
                    }
                }
            }
        }
    }
}
else 
{
    // Redirection avec un message d'erreur
    $_SESSION['error_message'] = "Une erreur est survenue lors de la validation du formulaire, veuillez réessayer";
    header('Location: ../validation');
}

// Redirection à la page de paiement (étape suivante)
header('Location: ../validation/payment');
exit();
?>

