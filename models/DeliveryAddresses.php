<?php
class DeliveryAddresses
{
    // Les attributs de l'article
    private $_id;
    private $_firstName;
    private $_lastName;
    private $_add1;// addresse livraison
    private $_add2;//complément addresse
    private $_city;
    private $_postcode;
    private $_phone;
    private $_email;

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
    public function setPostcode($postcode)
    {
        $postcode=(int) $postcode;
        if ($postcode > 0) //ATTENTION très peu de sens ici besoin de plus de sécurité (code postal)
        $this ->_postcode = $postcode;
    }

    public function setPhone($phone)
    {
        $phone=(int) $phone;
        if ($phone > 0) //ATTENTION très peu de sens ici besoin de plus de sécurité (numéro de téléphone)
        $this ->_phone = $phone;
    }

    public function setEmail($email)
    {
        if(is_string($email)) //email est un string ATTENTION vérifier @? (adresse mail)
        $this->_email =  $email;
    }

    public function setAdd1($add1)
    {
        if(is_string($add1))
        $this->_add1 =  $add1;
    }

    public function setAdd2($add2)
    {
        if(is_string($add2))
        $this->_add2 =  $add2;
    }

    public function setFirstName($firstName)
    {
        if(is_string($firstName)) //firstName est un string
        $this ->_firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        if(is_string($lastName)) //lastName est un string
        $this ->_lastName = $lastName;
    }

    public function setCity($city)
    {
        if(is_string($city)) //city est un string
        $this ->_city = $city;
    }

    public function setId($id)
    {
        $id=(int) $id;
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function phone()
    {
        return $this->_phone;
    }
    public function email()
    {
        return $this->_email;
    }
    public function lastName()
    {
        return $this->_lastName;
    }
    public function firstName()
    {
        return $this->_firstName;
    }
    public function add1()
    {
        return $this->_add1;
    }
    public function add2()
    {
        return $this->_add2;
    }
    public function postcode()
    {
        return $this->_postcode;
    }
    public function city()
    {
        return $this->_city;
    }
}