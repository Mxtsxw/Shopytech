<?php
session_start();

require_once('models/Model.php');
require_once('models/Customers.php');
require_once('models/CustomersManager.php');
require_once('models/DeliveryAddresses.php');
require_once('models/DeliveryAddressesManager.php');

$customersManager = new CustomersManager();
$customer = $customersManager->getCustomerById(1);

$deliveryAddressesManager = new DeliveryAddressesManager();
$deliveryAddressId = $deliveryAddressesManager->addDeliveryAddress(new DeliveryAddresses(array(
    'firstname' => 'John',
    'lastname' => 'Doe',
    'add1' => '1 rue de la paix',
    'add2' => 'Appartement 1',
    'city' => '75000 Paris',
    'postcode' => '75000',
    'email' => 'foo@bar.com',
    'phone' => '0123456789',
))); 

var_dump($deliveryAddressId);
var_dump($deliveryAddressesManager->lastInsertedId());

?>