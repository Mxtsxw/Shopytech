<?php
require_once('views/view.php');
class ControllerPayment
{
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url)>1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            // Paramètre la vue pour les categories
            $this->_view = new View('Payment');
            $this->_view->generate(array());
        }
    }
}
