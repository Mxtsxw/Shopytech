<?php 

class CategoriesManager extends Model
{
    /**
     * Récupère toutes les catégories
     * @return array
     * @throws Exception
     */
    public function getCategories() 
    {
        // Nom de la table ; objet créé
        return $this->getAll('categories','Categories'); 
    }

    /** 
     * Récupère une catégorie par son ID
     * @param int $id
     * @return Categories
     * @throws Exception
     */
    public function getCategoryById($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM categories WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new Categories($data);
    }

    /**
     * Récupère l'ID de la dernière catégorie ajoutée
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('categories');
    }
}