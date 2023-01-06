<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/DeliveryAddresses.php');

// Si toutes les variables requis sont passé en POST
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['add1']) && isset($_POST['add2']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['phone'])) {
    
    // Vérifie que les variables ne sont pas vides
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['add1']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['phone'])) {
       
        // Vérifie que l'email est valide (du côté du serveur)
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            // Vérifie que le code postal est valide (du côté du serveur)
            if (preg_match('#^[0-9]{5}$#', $_POST['zip'])) {

                // Vérifie que le numéro de téléphone est valide (du côté du serveur)
                if (preg_match('#^[0-9]{10}$#', $_POST['phone'])) {
                    
                    // Met en place variable de session status pour le formulaire
                    $_SESSION['status'] = 1;

                    // Créer un nouvel objet DeliveryAddresses
                    $deliveryAddress = new DeliveryAddresses([
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'email' => $_POST['email'],
                        'add1' => $_POST['add1'],
                        'add2' => $_POST['add2'],
                        'city' => $_POST['city'],
                        'postcode' => $_POST['zip'],
                        'phone' => $_POST['phone']
                    ]);

                    // Met en place variable de session pour l'objet DeliveryAddresses
                    $_SESSION['deliveryAddress'] = serialize($deliveryAddress);

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

// Redirection vers la page de validation
header('Location: ../validation/payment');
?>

