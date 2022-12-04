<?php
require_once('views/view.php');
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
        $this->products();
    }
    
    private function products()
    {
        $this->_articleManager = new ArticleManager;
        $products = $this-> _articleManager->getArticle();

        $this->_view = new View('Accueil');
        $this->_view->generate(array('article' => $products));
    }
}