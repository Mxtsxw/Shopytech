<?php
session_start();
require_once('models/Model.php');
require_once('models/Customers.php');
require_once('models/CustomersManager.php');
require_once('models/DeliveryAddresses.php');
require_once('models/DeliveryAddressesManager.php');
require_once('models/Orders.php');
require_once('models/OrdersManager.php');
require_once('models/OrderItems.php');
require_once('models/OrderItemsManager.php');
require_once('models/Products.php');
require_once('models/ProductsManager.php');
require_once('static/lib/fpdf/invoicePDF.php');

$customerManager = new CustomersManager();
$orderManager = new OrdersManager();
$orderItemsManager = new OrderItemsManager();
$productsManager = new ProductsManager();

?>


<!-- 
Input mot de passe

<div class="form-group">
<label for="lastname-input">Mot de passe</label>
<input type="text" name="password" class="form-control" value="" required/>
</div>



 -->