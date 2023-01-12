<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/Products.php');
require_once('../Models/ProductsManager.php');


if (isset($_POST['updateQuanity']))
{
    // Modification des informations du produits
    if (isset($_POST['quantityProduct']) && isset($_POST['idProduct']))
    {

        //reset var
        if(isset($_SESSION['qprod-error'])){$_SESSION['qprod-error']=NULL;}

        if ($_POST['quantityProduct']>=0){
        // create a new product object
        $productmanager = new productsManager();

        // Update the product information in the database
        $productmanager->updateProductQuantity($_POST['idProduct'],$_POST['quantityProduct']);
        }
        else 
        {
            $_SESSION['qprod-error']="vous avez rentré une valeur incorrecte";
            header('Location: ../pageadmin?='.$_POST['idProduct']);
            exit();
        }
    }
}

header('Location: ../admin');
exit();
