<?php
class Logins
{
    // Les attributs de l'article
    private $_id;
    private $_customerId;
    private $_userName;
    private $_password;

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
    public function setUserName($userName)
    {
        if(is_string($userName)) //userName est un string
        $this ->_userName = $userName;
    }

    public function setId($id)
    {
        $id=(int) $id;
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    public function setCustomerId($customerId)
    {
        $customerId=(int) $customerId;
        if ($customerId > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_customerId = $customerId;
    }

    public function setPassword($password)
    {
        if(is_string($password)) //password est un string
        $this->_password =  $password;
    }

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function customerId()
    {
        return $this->_customerId;
    }
    public function userName()
    {
        return $this->_userName;
    }
    public function password()
    {
        return $this->_password;
    }

    //méthode pour ajouter un utilisateur
    public function addUser($id,$customerId,$userName,$password) 
    {
        //mise à jour base de donnée
        $pdo= new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');
        $stmt = $pdo -> prepare('INSERT INTO Logins(id, customerId, userName, mdp) VALUES (?, ?, ?, ?)');
        $stmt->execute([$id,$customerId,$userName,$password]);
    }
}