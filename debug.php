<?php
session_start();

require_once('models/Model.php');
require_once('models/Customers.php');
require_once('models/CustomersManager.php');
require_once('models/DeliveryAddresses.php');
require_once('models/DeliveryAddressesManager.php');
require_once('models/Orders.php');
require_once('models/OrdersManager.php');

$ordersManager = new OrdersManager();
$orders = $ordersManager->getOrdersByCustomerId(1);

var_dump($orders);


?>

<div>
    <h1>LOG DEBUG</h1>
</div>