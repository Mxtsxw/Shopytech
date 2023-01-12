<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/orders.php');
require_once('../Models/OrdersManager.php');


if (isset($_POST['ValidOrderStatus']))
{
    // Modification des informations de la comande
    if (isset($_POST['idOrder']))
    {    
        $ordermanager = new OrdersManager();

        // Update the product information in the database
        $ordermanager->updateOrderStatus($_POST['idOrder'], 10);

        header('Location: ../dashboard/orders');
        exit();
    }
}

if (isset($_POST['RefuseOrderStatus']))
{
    // Modification des informations de la comande
    if (isset($_POST['idOrder']))
    {    
        $ordermanager = new OrdersManager();

        // Update the product information in the database
        $ordermanager->updateOrderStatus($_POST['idOrder'], -1);

        header('Location: ../dashboard/orders');
        exit();
    }
}

$_SESSION['error_message'] = "Une erreur est survenue";
header('Location: ../dashboard/orders/update?id='.$_POST['idOrder']);
exit();

