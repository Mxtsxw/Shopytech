<?php
//les méthodes commune aux autres classes
abstract class Model
{
    private static $_bdd; //var de connexion base de donnée

    //instancie la connexion à la BDD
    private static function setBdd() //si la connexion n'existe pas alors on feras appel à cette fonction là
    {
        self::$_bdd = new PDO('mysql:host=localhost; dbname=miniblog;charset=utf8',
        'root','root'); //identifiant et mdp 
        //miniblog est le nom de la base de donnée, le changer si nécessaire
        self::$_bdd->setAttribute(PDO::ATTR_ERRMode, PDO::ERRMODE_WARNING);
        //on précise les erreurs
    }

    //récupère la connexion à la BDD
    protected function getBdd()
    {
        //vérification et maj de la connexion
        if (self::$bdd == null)
            self::setBdd();
        return self::$bdd;
    }

    //Méthode pour récupérer toutes les données d'une table
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELCT * FROM ' .$table. ' ORDER BY id desc');
        $req ->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var; //var contient mtn tout les objets
        $req->closeCursor();
    }
}   
