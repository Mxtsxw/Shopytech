<?php 
class CartItem
{
    private $_id;
    private $_quantity;
    private $_product;

    public function __construct($id, $quantity, $product)
    {
        $this->_id = $id;
        $this->_quantity = $quantity;
        $this->_product = $product;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function getProduct()
    {
        return $this->_product;
    }

    public function setQuantity($quantity)
    {
        $this->_quantity = $quantity;
    }
}