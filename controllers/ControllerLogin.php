<?php
require_once('views/view.php');
class ControllerLogin
{
    private $_view;

    public function __construct($url)
    {
        // Un seul paramètre autorisé pour la page d'accueil
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérfiier
        {
            throw new Exception('Page introuvable');
        }
        elseif (isset($_SESSION['username']))
        {
            // redirection vers la page de certification de connexion
            //header('Location: '. ROOT .'/Welcom');
            //redirection vers la page d'accueil
            header('Location: '. ROOT .'/index.php');
        }
        else
        {
            // Paramètre la vue pour la connexion
            $this->_view = new View('Login');
            $this->_view->generate(array());
        }
    }
}