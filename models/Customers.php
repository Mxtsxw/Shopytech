<?php
class Customers
{
    // Les attributs de la classe Customers
    private $_id;
    private $_forename;
    private $_surname;
    private $_add1;
    private $_add2;
    private $_add3;         // Correspond à la ville
    private $_postcode;
    private $_phone;
    private $_email;
    private $_registered;

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

    public function setForname($forename)
    {
        $this ->_forename = (string) $forename;
    }

    public function setSurname($surname)
    {
        if(is_string($surname)) //username est un string
        $this ->_surname = (string) $surname;
    }
    
    public function setEmail($email)
    {
        $this->_email = (string) $email;
    }

    public function setAdd1($add1)
    {
        $this->_add1 = (string) $add1;
    }

    public function setAdd2($add2)
    {
        $this->_add2 = (string) $add2;
    }

    public function setAdd3($add3)
    {
        $this->_add3 = (string) $add3;
    }

    public function setPostcode($postcode)
    {
        $this ->_postcode = (int) $postcode;
    }

    public function setPhone($phone)
    {
        $this ->_phone = $phone;
    }

    public function setRegistered($registered)
    {
        $this ->_registered = (int) $registered;
    }

    // -- Getters --
    public function id()
    {
        return $this->_id;
    }

    public function forename()
    {
        return $this->_forename;
    }

    public function surname()
    {
        return $this->_surname;
    }

    public function add1()
    {
        return $this->_add1;
    }

    public function add2()
    {
        return $this->_add2;
    }

    public function add3()
    {
        return $this->_add3;
    }

    public function postcode()
    {
        return $this->_postcode;
    }
    
    public function email()
    {
        return $this->_email;
    }

    public function phone()
    {
        return $this->_phone;
    }

    public function registered()
    {
        return $this->_registered;
    }
}