<?php
class OrderItems
{
    // Les attributs de la classe OrderItems
    private $_id;
    private $_orderId;
    private $_productId;
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
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
            $this ->_id = (int) $id;
    }

    public function setOrder_id($orderId)
    {
        if ($orderId > 0)
            $this ->_orderId = (int) $orderId;
    }

    public function setProduct_id($productId)
    {
        if ($productId > 0)
            $this ->_productId = (int) $productId;
    }

    public function setQuantity($quantity)
    {
        if ($quantity > 0)
            $this ->_quantity = (int) $quantity;
    }

    // -- Getters --
    public function id()
    {
        return $this->_id;
    }

    public function orderId()
    {
        return $this->_orderId;
    }

    public function productId()
    {
        return $this->_productId;
    }
    
    public function quantity()
    {
        return $this->_quantity;
    }
}