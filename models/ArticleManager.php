<?php
//ArticleManager même nom que le fichier pour l'autoload
class ArticleManager extends Model
{
    public getArticle() //récupère tous nos articles
    {
        $this->getBdd();
        //articles est la table, Article est un objet
        return $this->getAll('articles','Article'); 
    }
}