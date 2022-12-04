<?php
// Les méthodes commune aux autres classes
abstract class Model
{
    private static $_bdd; // Variable de connexion à la base de données

    // Instanciation de la connexion à la BDD
    private static function setBdd() // Si la connexion n'existe pas alors on fera appel à cette fonction
    {
        // dbname est le nom de la base de donnée, le changer si nécessaire
        self::$_bdd = new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        // On précise les erreurs
    }

    //récupère la connexion à la BDD
    protected function getBdd()
    {
        // Vérification et MAJ de la connexion
        if (self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
    }

    // Méthode pour récupérer toutes les données d'une table
    protected function getAll($table, $obj)
    {
        $objects = []; // Variable contenant l'ensemble des objets

        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY id');
        $req ->execute();

        // Ajout des objets résultant de la requête dans la liste
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new $obj($data); // $var[] = new $obj($data);
        }
        $req->closeCursor();

        // var contient maintenant tout les objets
        return $objects; 
    }
}   
