<?php
class OrderItems
{
    // Les attributs de l'article
    private $_id;
    private $_orderId;
    private $_productId;
    private $_quantity;

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
    public function setId($id)
    {
        $id=(int) $id;
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }
    public function setOrderId($orderId)
    {
        $orderId=(int) $orderId;
        if ($orderId > 0)
        $this ->_orderId = $orderId;
    }
    public function setProductId($productId)
    {
        $productId=(int) $productId;
        if ($productId > 0)
        $this ->_productId = $productId;
    }
    public function setQuantity($quantity)
    {
        $quantity=(int) $quantity;
        if ($quantity > 0)
        $this ->_quantity = $quantity;
    }
    //getters
    public function id()
    {
        return $this->_id;
    }
    public function productId()
    {
        return $this->_productId;
    }
    public function orderId()
    {
        return $this->_orderId;
    }
    public function quantity()
    {
        return $this->_quantity;
    }
}