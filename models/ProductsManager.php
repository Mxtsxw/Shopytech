<?php

class ProductsManager extends Model
{
    /**
     * Récupère tous les produits
     * @return array
     */
    public function getProducts() 
    {
        return $this->getAll('products','Products'); 
    }

    /**
     * Récupère tous les produits d'une catégorie via son ID
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getProductsByCategory($id){
        $objects = [];

        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE cat_id='. $id . ' ORDER BY id');
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid category ID");                // lève une exception
        }

        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new Products($data);
        }

        $req->closeCursor();

        return $objects; 
    }

    /**
     * Récupère un produit par son ID
     * @param int $id
     * @return Products
     * @throws Exception
     */
    public function getProductById($id){

        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE Id='. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetch(PDO::FETCH_ASSOC);
        $req -> closeCursor();
        return new Products($data);
    }

    /**
     * Récupère un produit par son nom
     * @param string $name Le nom du produit
     * @return Products
     * @throws Exception
     */
    public function getProductsByName($name){
        $objects = [];

        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE name LIKE "%'. $name . '%" ORDER BY id');
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid product name");                // lève une exception
        }

        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new Products($data);
        }
        $req->closeCursor();

        return $objects; 
    }

    /**
     * Récupère tous les produits d'une catégorie via son nom
     * @param string $name Le nom de la catégorie
     * @return array
     * @throws Exception
     */
    public function getProductsByCategoryName($name){
        $objects = [];

        $req = $this->getBdd()->prepare('SELECT * FROM PRODUCTS WHERE cat_id IN (SELECT id FROM categories WHERE name LIKE "%'. $name . '%") ORDER BY id');
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unknown category" . " " . $name);
        }

        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new Products($data);
        }
        $req->closeCursor();

        return $objects; 
    }

    /**
     * Ajoute un produit dans la base de données
     * @param Products $product
     * @return int L'ID du produit ajouté
     */
    public function addProduct(Products $product){
        $req = $this->getBdd()->prepare('INSERT INTO products (cat_id, name, description, image, price, quantity) VALUES (:cat_id, :name, :description, :image, :price, :quantity)');
        $req->bindValue(':cat_id', $product->getCat_id(), PDO::PARAM_INT);
        $req->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $req->bindValue(':description', $product->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':image', $product->getImage(), PDO::PARAM_STR);
        $req->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $req->bindValue(':quantity', $product->getQuantity(), PDO::PARAM_INT);
        $req->execute();
        
        $req->closeCursor();

        return $this->getLastInsertedId('products');
    }

}