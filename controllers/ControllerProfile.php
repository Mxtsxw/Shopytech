<?php
require_once('views/view.php');
class ControllerProfile
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }
        else if (!(isset($_SESSION['username'])))
        {
            header('Location: ' . ROOT .'/login');
            exit();
        }
        else
        {
            // Paramètre la vue pour les categories
            $this->_view = new View('profile');
            $this->_view->generate(array());
        }
    }
    
}
