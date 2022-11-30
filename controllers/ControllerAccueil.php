<?php
class ControllerAccueil
{
    private $articleManager; //ce seras un nv instance de la classe ArticleManager
    private $_view;

    public function __construct($url)
    {
        //un seul para autorisé sur page d'accueil
        if (isset($url) && count ($url)>1)
        {
            throw new Exception('Page introuvable');
        }
        else
        $this->articles();
    }
    
    private function articles()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this-> _articleManager->getArticles();

        require_once('views/viewAccueil.php')
    }
}