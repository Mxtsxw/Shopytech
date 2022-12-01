<?php
//ArticleManager même nom que le fichier pour l'autoload
class ArticleManager extends Model
{
    public function getArticle() //récupère tous nos articles
    {
        $this->getBdd();
        //products est la table, Article est un objet
        return $this->getAll('products','Article'); 
    }
}