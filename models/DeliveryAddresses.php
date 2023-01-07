<?php
class DeliveryAddresses
{
    // Les attributs de la classe DeliveryAdrresses
    private $_id;
    private $_firstname;
    private $_lastname;
    private $_add1;
    private $_add2;
    private $_city;
    private $_postcode;
    private $_phone;
    private $_email;

    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // // "hydratation" → pour chaque champs passé dans le tableau $data, on vérifie si un setter existe et on l'appelle
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
        $this ->_id = (int) $id;
    }

    public function setFirstname($firstname)
    {
        $this ->_firstname = (string) $firstname;
    }

    public function setLastname($lastname)
    {
        $this ->_lastname = (string) $lastname;
    }

    public function setAdd1($add1)
    {
        $this->_add1 =  (string) $add1;
    }

    public function setAdd2($add2)
    {
        if(is_string($add2))            // add2 et facultatif
            $this->_add2 =  $add2;
    }


    public function setCity($city)
    {
        $this ->_city = (string) $city;
    }

    public function setPostcode($postcode)
    {
        if ($postcode > 0) 
            $this ->_postcode = (int) $postcode;
    }

    public function setPhone($phone)
    {
        $this ->_phone = $phone;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
    }

    // -- Getters --
    public function id()
    {
        return $this->_id;
    }

    public function firstname()
    {
        return $this->_firstname;
    }

    public function lastname()
    {
        return $this->_lastname;
    }

    public function add1()
    {
        return $this->_add1;
    }
    
    public function add2()
    {
        return $this->_add2;
    }

    public function city()
    {
        return $this->_city;
    }

    public function postcode()
    {
        return $this->_postcode;
    } 

    public function phone()
    {
        return $this->_phone;
    }

    public function email()
    {
        return $this->_email;
    }
}