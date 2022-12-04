<?php
class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }

    // Génère et affiche la vue
    public function generate($data)
    {
        // Partie spécifique de la vue
        $content = $this->generateFile($this->_file, $data);

        // Génère la vue complète à partir du template
        $rendering = $this->generateFile('views/template.php', array('t' => $this->_t, 'content' => $content));

        // Affiche la vue sur le navigateur
        echo $rendering;
    }   

    // Génère/Affiche les vue et renvoie le résultat produit
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);

            ob_start();

            require $file;
            
            // Retourne la partie de la vue générée
            return ob_get_clean();
        }
        else
        {
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}