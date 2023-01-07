<?php
class Admin
{
    // Les attributs de la classe Admin
    private $_id;
    private $_username;
    private $_password;

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
        $this ->_id = (int) $id;
    }

    public function setUsername($username)
    {
        $this ->_username = (string) $username;
    }

    public function setPassword($password)
    {
        $this->_password =  (string) $password;
    }

    // -- Getters --
    public function id()
    {
        return $this->_id;
    }
    public function username()
    {
        return $this->_username;
    }
    public function password()
    {
        return $this->_password;
    }
}