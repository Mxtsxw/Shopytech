<?php
class Reviews
{
    // Les attributs de l'article
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
    // hydratation → vérificiationd des champs et attributions des variables
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    //setters
    public function setNameUser($nameUser)
    {
        if(is_string($nameUser)) //nameUser est un string
        $this ->_nameUser = $nameUser;
    }

    public function setIdProduct($idProduct)
    {
        $idProduct=(int) $idProduct;
        if ($idProduct > 0) 
        $this ->_idProduct = $idProduct;
    }

    public function setStars($stars)
    {
        $stars=(int) $stars;
        if ($stars > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_stars = $stars;
    }

    public function setPhotoUser($photoUser)
    {
        if(is_string($photoUser)) //photoUser est un string
        $this->_photoUser =  $photoUser;
    }

    public function setTitle($title)
    {
        if(is_string($title)) //title est un string
        $this->_title =  $title;
    }

    public function setDescription($description)
    {
        if(is_string($description)) //description est un string
        $this->_description =  $description;
    }

    //getters
    public function idProduct()
    {
        return $this->_idProduct;
    }
    public function customerId()
    {
        return $this->_customerId;
    }
    public function nameUser()
    {
        return $this->_nameUser;
    }
    public function description()
    {
        return $this->_description;
    }
    public function title()
    {
        return $this->_title;
    }
    public function stars()
    {
        return $this->_stars;
    }
    public function photoUser()
    {
        return $this->_photoUser;
    }
}