<?php
// ProductsManager même nom que le fichier pour l'autoload
class ProductsManager extends Model
{
    // Récupère tous les products présent dans la BDD
    public function getProducts() 
    {
        // products est la table, Products est un objet
        return $this->getAll('products','Products'); 
    }
}