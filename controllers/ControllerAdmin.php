<?php
require_once('views/view.php');
class ControllerAdmin
{
    private $_view;

    public function __construct($url)
    {
        // Un seul paramètre autorisé pour la page d'accueil
        if (isset($url) && count($url)>1) // -- INFO : Source d'erreur à vérifier
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Paramètre la vue pour les admins
            $this->_view = new View('Admin');
            $this->_view->generate(array());
        }
    }
}
