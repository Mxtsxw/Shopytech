<?php

require_once('invoice.php');

/**
 * Fonction génération et téléchargement de la facture (PDF)
 * @param DeliveryAddresses $deliveiryAddress   :   L'adresse de livraison
 * @param Orders $order                         :   La commande
 * @param array[orderItems] $items              :   Les articles de la commande
 * @return PDF_Invoice                          :   La facture PDF générée par la librairie FPDF
 */
function invoice(DeliveryAddresses $deliveryAddress, Orders $order, array $items)
{
    $productsManager = new ProductsManager();

    $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );

    $pdf->AddPage();

    $pdf->addSociete( 
        "Shopytech",
        "15 Bd André Latarjet\n" .
        "69100 Villeurbanne\n".
        "R.C.S. PARIS B 000 000 007\n" .
        "Capital : 18000€"
    );

    $pdf->fact_dev( "Facture", "XXXX" );
    
    // $pdf->temporaire( "Facture" );
    $orderDate = date('d-m-Y', strtotime($order->date()));
    $dateEcheance = date('d-m-Y', strtotime($orderDate. ' + 10 days'));
    $pdf->addDate($orderDate);
    $pdf->addClient("CL".$order->customerId());
    $pdf->addPageNumber("1");
    $pdf->addClientAdresse("M. ".$deliveryAddress->firstname(). " " . $deliveryAddress->lastname() . "\n" . $deliveryAddress->add1() ."\n". $deliveryAddress->add2()."\n" . $deliveryAddress->postcode() . " " . $deliveryAddress->city());
    $pdf->addReglement("Chèque à réception de facture");
    $pdf->addEcheance($dateEcheance);
    $pdf->addNumTVA("FR888777666");
    $pdf->addReference("Facture de la commande n°".$order->id());
    
    $cols=array( "REFERENCE"    => 23,
                "DESIGNATION"  => 78,
                "QUANTITE"     => 22,
                "P.U. HT"      => 26,
                "MONTANT H.T." => 30,
                "TVA"          => 11 );
    $pdf->addCols( $cols);

    $cols=array( "REFERENCE"    => "L",
                "DESIGNATION"  => "L",
                "QUANTITE"     => "C",
                "P.U. HT"      => "R",
                "MONTANT H.T." => "R",
                "TVA"          => "C" );
    $pdf->addLineFormat( $cols);
    $pdf->addLineFormat($cols);

    $y    = 109;

    $tot_prods = array();
    $tab_tva = array();

    $i = 1;
    foreach($items as $item)
    {
        $product = $productsManager->getProductById($item->productId());
        $line = array( "REFERENCE"    => "REF".$item->id(),
                "DESIGNATION"  => $product->name(),
                "QUANTITE"     => $item->quantity(),
                "P.U. HT"      => $product->price(),
                "MONTANT H.T." => $product->price() * $item->quantity(),           
                "TVA"          => "1" );
        $size = $pdf->addLine( $y, $line );
        $y   += $size + 2;

        $tot_prods[] = array( "px_unit" => $product->price(), "qte" => $item->quantity(), "tva" => $i); 
        $tab_tva[$i] = 5.5; // TAUX TVA A DEFINIR ICI
        $i++;
    }

    $pdf->addCadreTVAs();

    $params  = array( 
        "RemiseGlobale" => 0,
        "remise_tva"     => 0,          // {la remise s'applique sur ce code TVA}
        "remise"         => 0,          // {montant de la remise}
        "remise_percent" => 0,         // {pourcentage de remise sur ce montant de TVA}
        "FraisPort"     => 0,
        "portTTC"        => 0,         // montant des frais de ports TTC
                                        // par defaut la TVA = 19.6 %
        "portHT"         => 0,          // montant des frais de ports HT
        "portTVA"        => 0,          // valeur de la TVA a appliquer sur le montant HT
        "AccompteExige" => 0,
        "accompte"         => 0,        // montant de l'acompte (TTC)
        "accompte_percent" => 0,        // pourcentage d'acompte (TTC)
        "Remarque" => "" 
    );

    $pdf->addTVAs( $params, $tab_tva, $tot_prods);
    $pdf->addCadreEurosFrancs();
    
    return $pdf;
}

/**
 * Génère un PDF de test
 * @return void
 */
function defaultPDF()
{
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

    $pdf->output();
}

?>
