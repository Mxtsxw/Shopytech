<?php
require_once('views/view.php');
class ControllerLogin
{
    private $_view;

    public function __construct($url)
    {
        // Un seul paramètre autorisé pour la page d'accueil
        if (isset($url) && count(array($url))>1) // -- INFO : Source d'erreur à vérfiier
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Paramètre la vue pour la connexion
            $this->_view = new View('Login');
            $this->_view->generate(array());
        }
    }
}