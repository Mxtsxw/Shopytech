<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/Products.php');
require_once('../Models/ProductsManager.php');


if (isset($_POST['updateQuantity']))
{
    // Modification des informations du produits
    if (isset($_POST['quantityProduct']) && isset($_POST['idProduct']))
    {
        if ($_POST['quantityProduct'] >= 0){
            // create a new product object
            $productmanager = new productsManager();

            // Update the product information in the database
            $productmanager->updateProductQuantity($_POST['idProduct'],$_POST['quantityProduct']);

            header('Location: ../dashboard/products');
            exit();
        }
    }
}

$_SESSION['error_message'] = "Vous avez entré une valeur incorrecte";
header('Location: ../dashboard/products/update?id='.$_POST['idProduct']);
exit();