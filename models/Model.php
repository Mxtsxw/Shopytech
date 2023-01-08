<?php

/**
 * Classe Model qui contient les méthodes de connexion à la BDD et de récupération des données de base
 */
abstract class Model
{
    private static $_bdd; // Variable de connexion à la base de données

    /**
     * Instancie la connexion à la base de données
     * Fonction appelé lorsque la connexion n'existe pas
     * @return void
     */
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    /**
     * Récupère la connexion à la base de données
     */
    protected function getBdd()
    {
        // Vérification et MAJ de la connexion
        if (self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
    }

    /**
     * Récupère tous les objets d'une table
     * @param string $table Nom de la table à récupérer
     * @param string $obj Nom de l'objet à créer
     */
    protected function getAll($table, $obj)
    {
        $objects = []; // Variable contenant l'ensemble des objets

        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY id');
        $req ->execute();

        // Ajout des objets résultant de la requête dans la liste
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new $obj($data);
        }
        $req->closeCursor();

        // Retourne la liste des objets
        return $objects; 
    }

    /**
     * Récupère l'ID du dernier objet inséré dans la base de données
     * @param string $table Nom de la table sur laquelle executer la requête
     * @return int
     */
    protected function getLastInsertedId($table)
    {
        $req = $this->getBdd()->prepare('SELECT max(id) FROM ' .$table);
        $req ->execute();
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $data['max(id)'];
    }

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
}   
