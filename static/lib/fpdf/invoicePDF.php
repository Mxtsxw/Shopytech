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
    $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
    $pdf->AddPage();
    $pdf->addSociete( "MaSociete",
                    "MonAdresse\n" .
                    "75000 PARIS\n".
                    "R.C.S. PARIS B 000 000 007\n" .
                    "Capital : 18000 " . EURO );
    $pdf->fact_dev( "Devis ", "TEMPO" );
    $pdf->temporaire( "Devis temporaire" );
    $pdf->addDate( "03/12/2003");
    $pdf->addClient("CL01");
    $pdf->addPageNumber("1");
    $pdf->addClientAdresse("Ste\nM. XXXX\n3�me �tage\n33, rue d'ailleurs\n75000 PARIS");
    $pdf->addReglement("Ch�que � r�ception de facture");
    $pdf->addEcheance("03/12/2003");
    $pdf->addNumTVA("FR888777666");
    $pdf->addReference("Devis ... du ....");
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
    $line = array( "REFERENCE"    => "REF1",
                "DESIGNATION"  => "Carte M�re MSI 6378\n" .
                                    "Processeur AMD 1Ghz\n" .
                                    "128Mo SDRAM, 30 Go Disque, CD-ROM, Floppy, Carte vid�o",
                "QUANTITE"     => "1",
                "P.U. HT"      => "600.00",
                "MONTANT H.T." => "600.00",
                "TVA"          => "1" );
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    $line = array( "REFERENCE"    => "REF2",
                "DESIGNATION"  => "C�ble RS232",
                "QUANTITE"     => "1",
                "P.U. HT"      => "10.00",
                "MONTANT H.T." => "60.00",
                "TVA"          => "1" );
    $size = $pdf->addLine( $y, $line );
    $y   += $size + 2;

    $pdf->addCadreTVAs();
            
    // invoice = array( "px_unit" => value,
    //                  "qte"     => qte,
    //                  "tva"     => code_tva );
    // tab_tva = array( "1"       => 19.6,
    //                  "2"       => 5.5, ... );
    // params  = array( "RemiseGlobale" => [0|1],
    //                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
    //                      "remise"         => value,     // {montant de la remise}
    //                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
    //                  "FraisPort"     => [0|1],
    //                      "portTTC"        => value,     // montant des frais de ports TTC
    //                                                     // par defaut la TVA = 19.6 %
    //                      "portHT"         => value,     // montant des frais de ports HT
    //                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
    //                  "AccompteExige" => [0|1],
    //                      "accompte"         => value    // montant de l'acompte (TTC)
    //                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
    //                  "Remarque" => "texte"              // texte
    $tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                        array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
    $tab_tva = array( "1"       => 19.6,
                    "2"       => 5.5);
    $params  = array( "RemiseGlobale" => 1,
                        "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                        "remise"         => 0,       // {montant de la remise}
                        "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                    "FraisPort"     => 1,
                        "portTTC"        => 10,      // montant des frais de ports TTC
                                                    // par defaut la TVA = 19.6 %
                        "portHT"         => 0,       // montant des frais de ports HT
                        "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                    "AccompteExige" => 1,
                        "accompte"         => 0,     // montant de l'acompte (TTC)
                        "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                    "Remarque" => "Avec un acompte, svp..." );

    $pdf->addTVAs( $params, $tab_tva, $tot_prods);
    $pdf->addCadreEurosFrancs();
    
    return $pdf;
}

/**
 * Génère un PDF de test
 * @return FPDF
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

    return $pdf;
}

?>
