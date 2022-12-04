<?php
// ArticleManager même nom que le fichier pour l'autoload
class ArticleManager extends Model
{
    // Récupère tous les articles présent dans la BDD
    public function getArticles() 
    {
        // Products est la table, Article est un objet
        return $this->getAll('products','Article'); 
    }
}