<?php
class Customers
{
    // Les attributs de l'article
    private $_id;
    private $_forename;
    private $_surname;
    private $_add1;
    private $_add2;
    private $_add3; //WTF? pk ya 3 adresses et ya que la 3ème qui est utilisée? autres compléments adresses? mais pk 3?
    private $_postcode;
    private $_phone;
    private $_email;
    private $_registered; //doit vouloir signifier nombre de fois que le customer s'est connecté

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
    public function setSurname($surname)
    {
        if(is_string($surname)) //username est un string
        $this ->_surname = $surname;
    }
    public function setForename($forename)
    {
        if(is_string($forename)) //username est un string
        $this ->_forename = $forename;
    }

    public function setId($id)
    {
        $id=(int) $id;
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    public function seRegistered($registered)
    {
        $id=(int) $registered; //on vérifie juste si int
        $this ->_registered = $registered;
    }

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

    public function setAdd3($add3)
    {
        if(is_string($add3))
        $this->_add3 =  $add3;
    }

    

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function postcode()
    {
        return $this->_postcode;
    }
    public function surname()
    {
        return $this->_surname;
    }
    public function forename()
    {
        return $this->_forename;
    }
    public function phone()
    {
        return $this->_phone;
    }
    public function email()
    {
        return $this->_email;
    }
    public function registered()
    {
        return $this->_registered;
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
}