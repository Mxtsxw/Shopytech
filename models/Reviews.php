<?php
class Reviews
{
    // Les attributs de la classe Reviews
    private $_idProduct;
    private $_nameUser;
    private $_photoUser;
    private $_stars;
    private $_title;
    private $_description;

    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // "hydratation" → pour chaque champs passé dans le tableau $data, on vérifie si un setter existe et on l'appelle
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    // -- Setters --
    public function setId_product($idProduct)
    {
        $this ->_idProduct = (int) $idProduct;
    }

    public function setName_user($nameUser)
    {
        $this ->_nameUser = (string) $nameUser;
    }

    public function setPhoto_user($photoUser)
    {
        $this->_photoUser = (string) $photoUser;
    }

    public function setStars($stars)
    {
        $this ->_stars = (int) $stars;
    }

    public function setTitle($title)
    {
        $this->_title = (string) $title;
    }

    public function setDescription($description)
    {
        $this->_description = (string) $description;
    }

    // -- Getters --
    public function idProduct()
    {
        return $this->_idProduct;
    }

    public function nameUser()
    {
        return $this->_nameUser;
    }
    
    public function photoUser()
    {
        return $this->_photoUser;
    }

    public function stars()
    {
        return $this->_stars;
    }

    public function title()
    {
        return $this->_title;
    }

    public function description()
    {
        return $this->_description;
    }
}