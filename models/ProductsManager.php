<?php

class ProductsManager extends Model
{
    // Récupère tous les products présent dans la BDD
    public function getProducts() 
    {
        // "products" est le nom de la table, Products est un l'objet qui sera créé
        return $this->getAll('products','Products'); 
    }

    public function getProductsByCategory($id){
        $objects = []; // Variable contenant l'ensemble des objets

        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE catId='. $id . ' ORDER BY id');
        $req ->execute();

        // Ajout des objets résultant de la requête dans la liste
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new $Products($data);
        }
        $req->closeCursor();

        // $objects contient maintenant tout les objets
        return $objects; 
    }

    public function getProductById($id){

        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE Id='. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");                // lève une exception
        }

        // Retourne le résultat
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new Products($data);
    }
}