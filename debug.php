<?php

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

$customerManager = new CustomersManager();
$customer = $customerManager->getCustomerById(2);
$orderManager = new OrdersManager();
$order = $orderManager->getOrderById(70);
$orderItemsManager = new OrderItemsManager();
$items = $orderItemsManager->getOrderItemsByOrderId(70);
$productsManager = new ProductsManager();

require_once('./static/lib/fpdf/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf ->SetFont('Arial','B',16);
    //contenu du pdf
    $pdf->Cell(0,10,'Facture',0,1,'C'); //ajout d'un titre (multicell ajuste auto, cell tronque sur une seule ligne, write écrit texte position courante texte tronqué si dépasse)
    $pdf -> SetFont('Arial','', 12);
    $pdf->MultiCell(0,5,'Entreprise SA
    Adresse de l\'entreprise
    Code postal Ville
    Téléphone : 01 02 03 04 05
    Email : contact@entreprise.com',0,1);
    $pdf -> MultiCell (0,5,'M.'.'
    Adresse du client : '.'
    Code postal Ville,0,1');

    //for all articles in panier
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(200,200,200);
    $pdf->Cell(40,10,"dsjkq",1,0,'C',true);
    $pdf->Cell(40,10,3,1,0,'C',true);
    $pdf->Cell(40,10,4.5,1,0,'C',true);
    //fin for
    $pdf->Cell(40,10,'Total',1,1,'C',true);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,'Produit 1',1,0,'L');
    $pdf->Cell(40,10,'2',1,0,'C');
    $pdf->Cell(40,10,'10€',1,0,'C');
    $pdf->Cell(40,10,'20€',1,1,'C');

        // Téléchargement du PDF
        $pdf->Output('facture.pdf','D');
?>

<div>
    <h1>LOG DEBUG</h1>
</div>