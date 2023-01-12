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
     * @return array[Products]
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
        $req->bindValue(':cat_id', $product->catId(), PDO::PARAM_INT);
        $req->bindValue(':name', $product->name(), PDO::PARAM_STR);
        $req->bindValue(':description', $product->description(), PDO::PARAM_STR);
        $req->bindValue(':image', $product->image(), PDO::PARAM_STR);
        $req->bindValue(':price', $product->price(), PDO::PARAM_STR);
        $req->bindValue(':quantity', $product->quantity(), PDO::PARAM_INT);
        $req->execute();
        
        $req->closeCursor();

        return $this->lastInsertedId();
    }

    /**
     * Met à jour les stocks du produit dans la base de données
     * @param int $id : L'ID du produit
     * @param int $quantity : La quantité à mettre à jour
     * @return void
     */
    public function updateProductQuantity(int $id, int $quantity){
        $req = $this->getBdd()->prepare('UPDATE products SET quantity = :quantity WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * Récupère l'ID du dernier produit ajouté
     * @return int 
     */
    public function lastInsertedId(){
        return $this->getLastInsertedId('products');
    }

}