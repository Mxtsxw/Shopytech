<?php 

class CategoriesManager extends Model
{
    public function getCategories() 
    {
        // Nom de la table ; objet créé
        return $this->getAll('categories','Categories'); 
    }
}