<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/orders.php');
require_once('../Models/OrdersManager.php');


// Modification des informations de la comande
if (isset($_POST['statusCommand'])&&isset($_POST['idOrder']))
{    
    $ordermanager = new OrdersManager();
    
    if(isset($_SESSION['erreur-modif-status-order'])){$_SESSION['erreur-modif-status-order']=NULL;}

    // Update the product information in the database
    echo $_POST['idOrder'];
    if ($_POST['statusCommand']==10) {$ordermanager->updateOrderStatus($_POST['idOrder'],10);} // validée
    elseif ($_POST['statusCommand']==2) {$ordermanager->updateOrderStatus($_POST['idOrder'],2);} // en cours
    elseif ($_POST['statusCommand']==3) {$ordermanager->updateOrderStatus($_POST['idOrder'],3);} //paypal
    elseif ($_POST['statusCommand']==127) {$ordermanager->updateOrderStatus($_POST['idOrder'],127);} //refusée
    else{$_SESSION['erreur-modif-status-order']="Valeur inconnue";
        header('Location: ../pagecommande?id='.$_POST['idOrder']);
        exit();}
}

header('Location: ../command');
exit();
