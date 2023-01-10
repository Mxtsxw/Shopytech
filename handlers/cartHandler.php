<?php
session_start();

// Vérifie le type d'opération à effectuer 
if (isset($_POST['add'])) {
    addItem();
} else if (isset($_POST['delete'])) {
    deleteItem();
} else if (isset($_POST['update'])) {
    updateItem();
} else if (isset($_POST['empty'])) {
    emptyCart();
}

// Redirige vers la page du panier
header('Location: ../cart');
exit();


/**
 * Ajoute un produit au panier
 */
function addItem()
{
    // Vérifie que les variables existent
    if (isset($_POST['productId']) && isset($_POST['productQuantity']))
    {
        // Vérifie si le produit est déjà dans le panier
        if (isset($_SESSION['cart'][$_POST['productId']])) {
            // Si le produit est déjà dans le panier, ajoute la quantité
            $_SESSION['cart'][$_POST['productId']] = $_POST['productQuantity'];
        } else {
            // Si le produit n'est pas dans le panier, ajoute le produit
            $_SESSION['cart'][$_POST['productId']] = $_POST['productQuantity'];
        }
    }

    $_SESSION['status'] = 0;
}


/**
 * Supprime un produit du panier
 */
function deleteItem(){
    // Vérifie que les variables existent
    if (isset($_POST['productId']))
    {
        // Vérifie si le produit est déjà dans le panier
        if (isset($_SESSION['cart'][$_POST['productId']])) {
            // Supprime le produit du panier
            unset($_SESSION['cart'][$_POST['productId']]);
        }
    }
}

?>