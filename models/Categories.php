<?php
class Categories
{
    // Les attributs de la classe Categories
    private $_id;
    private $_name;

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

    public function setName($name)
    {
        $this ->_name = (string) $name;
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
}