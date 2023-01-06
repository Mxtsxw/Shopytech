<?php

/**
 * Classe Model qui contient les méthodes de connexion à la BDD et de récupération des données de base
 */
abstract class Model
{
    private static $_bdd;       // Variable de connexion à la base de données

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
}   
