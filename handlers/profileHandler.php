<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/Customers.php');
require_once('../Models/CustomersManager.php');
require_once('../Models/Logins.php');
require_once('../Models/LoginsManager.php');

if (isset($_POST['updateProfile']))
{
    // Vérifie que tous les champs sont renseignés
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['add1']) && isset($_POST['add3']) && isset($_POST['zip']))
    {
        // Créer un nouvel objet Customers
        $customer = new Customers([
            'id' => (int) $_SESSION['customerId'],
            'forname' => $_POST['firstname'],
            'surname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'add1' => $_POST['add1'],
            'add2' => isset($_POST['add2']) ? $_POST['add2'] : NULL,
            'add3' => $_POST['add3'],
            'postcode' => $_POST['zip']
        ]);

        // Créer un nouvel objet CustomersManager
        $customersManager = new CustomersManager();

        // Met à jour le client dans la base de données
        $customersManager->updateCustomer($customer);

        // Met à jour la session
        $_SESSION['customerObject'] = serialize($customer);
        
        // Met en place un message de confirmation
        $_SESSION['update_message'] = 'Votre profil a été mis à jour !';
    }
}

// Modification du mot de passe
if (isset($_POST['updatePassword']))
{
    if (isset($_POST['password']))
    {
        // create a new logins object with post information
        $user = new logins([
            'id' => unserialize($_SESSION['loginObject'])->id(),
            'customer_id' => $_SESSION['customerId'],
            'username' => $_SESSION['username'],
            'password' => $_POST['password'],
        ]);

        // create a new loginsmanager object
        $loginsManager = new loginsManager();

        // Update the user information in the database
        $loginsManager->updateLogins($user);
        
        // Mise à jour de la session
        $_SESSION['loginObject']= serialize($user);
    }
}

if (isset($_POST['confirmCustomerInfo']))
{
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['add1']) && isset($_POST['add3']) && isset($_POST['zip']))
    {
        // Créer un nouvel objet Customers
        $customer = new Customers([
            'id' => -1,
            'forname' => $_POST['firstname'],
            'surname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'add1' => $_POST['add1'],
            'add2' => isset($_POST['add2']) ? $_POST['add2'] : NULL,
            'add3' => $_POST['add3'],
            'postcode' => $_POST['zip']
        ]);

        // Créer un nouvel objet CustomersManager
        $customersManager = new CustomersManager();
        $loginsManager = new LoginsManager();

        // Met à jour le client dans la base de données
        $customersManager->updateCustomer($customer);

        // Mise à jour de la BD
        $customerId = $customersManager->addCustomer($customer);

        $user = unserialize($_SESSION['createdLogins']);
        $user->setCustomer_id($customerId);
        $userId = $loginsManager->addUser($user);

        // Supprime les variables de session pour la création
        unset($_SESSION['createdLogins']);
        unset($_SESSION['created_username']);

        // Mets à jour les variables de session
        $_SESSION['username'] = $user->username();
        $_SESSION['customerId'] = $customerId;
        $_SESSION['customerObject'] = serialize($customersManager->getCustomerbyId($customerId));
        $_SESSION['loginObject'] = serialize($user);
        $_SESSION['connected'] = true;

        $_SESSION['update_message'] = "Votre compté à été créé avec succès";
    }
}

header('Location: ../profile');
exit();

?>