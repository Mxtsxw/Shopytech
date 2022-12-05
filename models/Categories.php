<?php
class Categories
{
    // Les attributs de l'article
    private $_id;
    private $_name;

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
    public function setName($name)
    {
        if(is_string($name)) //userName est un string
        $this ->_name = $name;
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
    public function name()
    {
        return $this->_userName;
    }
}