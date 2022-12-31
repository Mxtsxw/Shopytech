<?php
session_start();

// Check if page is request with post
if (isset($_POST['submit'])) {

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

// Redirect to the cart page
header('Location: ../cart');
exit();
?>