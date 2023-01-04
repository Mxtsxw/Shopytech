<?php
class Products
{
    // Les attributs de l'article
    private $_id;
    private $_catId;
    private $_name;
    private $_description;
    private $_image;
    private $_price;
    private $_quantity;

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
    public function setQuantity($quantity)
    {
        $quantity=(int) $quantity; //quantity peut tomber à 0
        $this ->_quantity = $quantity;
    }

    public function setImage($image)
    {
        if(is_string($image)) //image est un string dans la bd
        $this ->_image = $image;
    }

    public function setPrice($price)
    {
        $price=(float) $price;
        if ($price > 0) //le prix est forcément supérieur à 0, rien n'est gratuit ! 
        $this ->_price = $price;
    }

    public function setId($id)
    {
        $id=(int) $id;

        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    public function setName($name)
    {
        if(is_string($name)) //name est un string
        $this->_name = $name;
    }

    public function setDescription($description)
    {
        if(is_string($description)) //description est un string
        $this->_description =  $description;
    }

    public function setCatId($catId)
    {
        $catId=(int) $catId;

        if ($catId > 0) //l'attribut est un int et doit être sup à 0
        $this ->_catId = $catId;
    }

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function name()
    {
        return $this->_name;
    }
    public function description()
    {
        return $this->_description;
    }
    public function catId()
    {
        return $this->_catId;
    }
    public function quantity()
    {
        return $this->_quantity;
    }
    public function price()
    {
        return $this->_price;
    }
    public function image()
    {
        return $this->_image;
    }
}
