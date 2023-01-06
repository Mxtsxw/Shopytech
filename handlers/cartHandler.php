<?php
session_start();

// Ajout du produit au panier
if (isset($_POST['add'])) {

    // Vérifie que les variables existent
    if (isset($_POST['productId']) && isset($_POST['productQuantity']))
    {
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$_POST['productId']])) {
            // If the product is already in the cart, add the quantity
            $_SESSION['cart'][$_POST['productId']] += $_POST['productQuantity'];
        } else {
            // If the product is not in the cart, add it
            $_SESSION['cart'][$_POST['productId']] = $_POST['productQuantity'];
        }
    }
}

// Supprimer le produit du panier
if (isset($_POST['delete'])) {
    // Vérifie que les variables existent
    if (isset($_POST['productId']))
    {
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$_POST['productId']])) {
            // If the product is already in the cart, add the quantity
            unset($_SESSION['cart'][$_POST['productId']]);
        }
    }
}

// Redirect to the cart page
header('Location: ../cart');
exit();
?>