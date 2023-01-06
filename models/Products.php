<?php
class Products
{
    // Les attributs de la classe Products
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
    public function setId($id)
    {
        if ($id > 0)
            $this ->_id = (int) $id;
    }

    public function setName($name)
    {
        $this->_name = (string) $name;
    }

    public function setCat_id($catId)
    {
        if ($catId > 0)
            $this ->_catId = (int) $catId;
    }

    public function setDescription($description)
    {
        $this->_description = (string) $description;
    }    

    public function setImage($image)
    {
        $this ->_image = (string) $image;
    }

    public function setPrice($price)
    {
        if ($price > 0) 
            $this ->_price = (double)$price;
    }

    public function setQuantity($quantity)
    {
        $this ->_quantity = (int) $quantity;
    }
    
    // -- Getters --
    public function id()
    {
        return $this->_id;
    }

    public function name()
    {
        return $this->_name;
    }

    public function catId()
    {
        return $this->_catId;
    }

    public function description()
    {
        return $this->_description;
    }

    public function image()
    {
        return $this->_image;
    }

    public function price()
    {
        return $this->_price;
    }

    public function quantity()
    {
        return $this->_quantity;
    }
}
