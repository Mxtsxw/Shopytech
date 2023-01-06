<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/Customers.php');
require_once('../Models/CustomersManager.php');

if (isset($_POST['updateProfile']))
{
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['add1']) && isset($_POST['add3']) && isset($_POST['zip']))
    {
        // create a new customer object with post information
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

        // create a new customer manager object
        $customersManager = new CustomersManager();

        // Update the customer information in the database
        $customersManager->updateCustomer($customer);

        // Update the session information
        $_SESSION['customerObject'] = serialize($customer);
        
        // Send update message to the page
        $_SESSION['update_message'] = 'Votre profil a été mis à jour !';
    }
}

header('Location: ../profile');
exit();

?>