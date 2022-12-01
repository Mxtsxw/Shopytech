<?php
class Article
{
    //les attributs de l'article
    private $_id;
    private $_title;
    private $_content;
    private $_date;

    //constructeur
    private function __construct(array $data)
    {
        $this->hydrate($data);
    }

    //hydratation
    public function hydrate (array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    //setters
    public function setId($id)
    {
        $id=(int) $id;

        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    public function setTitle($title)
    {
        if(is_string($title)) //title est un string
        $this->_title = $title;
    }

    public function setContent($content)
    {
        if(is_string($content)) //content est un string
        $this->_content =  $content;
    }

    private function setDate($date)
    {
        $this->_date = $date;
    }

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function title()
    {
        return $this->_title;
    }
    public function content()
    {
        return $this->_content;
    }
    public function date()
    {
        return $this->_date;
    }

}