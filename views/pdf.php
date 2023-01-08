<?php
//fonction génération et download du pdf facture
function getFacture($nomClient,$adrClient,$article,$qte,$prix_unit){ //inclure les info de la facture
    require_once('fpdf.php');
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
    $pdf -> MultiCell (0,5,'M.'.$nomClient.'
    Adresse du client : '. $adrClient.'
    Code postal Ville,0,1');

    //for all articles in panier
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(200,200,200);
    $pdf->Cell(40,10,$article,1,0,'C',true);
    $pdf->Cell(40,10,$qte,1,0,'C',true);
    $pdf->Cell(40,10,$prix_unit,1,0,'C',true);
    //fin for
    $pdf->Cell(40,10,'Total',1,1,'C',true);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,'Produit 1',1,0,'L');
    $pdf->Cell(40,10,'2',1,0,'C');
    $pdf->Cell(40,10,'10€',1,0,'C');
    $pdf->Cell(40,10,'20€',1,1,'C');
    //download le pdf
    $pdf->Output('facture.pdf','D');
}
//getfacture()